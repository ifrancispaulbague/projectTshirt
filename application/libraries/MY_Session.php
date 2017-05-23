<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Session extends CI_Session{

    private $sess_use_redis = TRUE; 
    private $redis = '';

    public function __construct($params = array()) {
        $this->CI =& get_instance();

        foreach (array('sess_encrypt_cookie', 'sess_use_database', 'sess_table_name', 'sess_expiration', 'sess_expire_on_close', 'sess_match_ip', 'sess_match_useragent', 'sess_cookie_name', 'cookie_path', 'cookie_domain', 'cookie_secure', 'sess_time_to_update', 'time_reference', 'cookie_prefix', 'encryption_key') as $key)
        {
            $this->$key = (isset($params[$key])) ? $params[$key] : $this->CI->config->item($key);
        }

        if ($this->encryption_key == '')
        {
            show_error('In order to use the Session class you are required to set an encryption key in your config file.');
        }

        $this->CI->load->helper('string');

        if ($this->sess_encrypt_cookie == TRUE)
        {
            $this->CI->load->library('encrypt');
        }

        if ($this->sess_use_redis == TRUE) {
            $this->redis = new Redis();
            $this->redis->connect($this->CI->config->item('redis_host'), $this->CI->config->item('redis_port'));
            $this->redis->setOption(Redis::OPT_PREFIX, 'sessions:'); 
        }

        $this->now = $this->_get_time();

        if ($this->sess_expiration == 0)
        {
            $this->sess_expiration = (60*60*24*365*2);
        }
        
        $this->sess_cookie_name = $this->cookie_prefix.$this->sess_cookie_name;

        if ( ! $this->sess_read()) {
            $this->sess_create();
        } else {
            $this->sess_update();
        }

        $this->_flashdata_sweep();

        $this->_flashdata_mark();

        $this->_sess_gc();

        log_message('debug', "Session routines successfully run");
    }

    function sess_read() {

        $session = array();
        $session_id = $this->CI->input->cookie($this->sess_cookie_name);
        if ($session_id === FALSE) {
            log_message('debug', 'A session cookie was not found.');
            return FALSE;
        }
        
        $session['session_id'] = $session_id;
        $session['ip_address'] = $this->CI->input->ip_address();    
        $session['user_agent'] = trim(substr($this->CI->input->user_agent(), 0, 120));  
                
        if ($this->sess_use_redis=== TRUE) {
            
            $row = json_decode($this->redis->get($session['session_id']), TRUE);
            
            if ( ! $row) {
                $this->sess_destroy();
                return FALSE;
            }

            if ($this->sess_match_ip == TRUE AND $row['ip_address']  != $session['ip_address']) {
                $this->sess_destroy();
                return FALSE;
            }

            if ($this->sess_match_useragent == TRUE AND trim($row['user_agent']) != $session['user_agent']) {
                $this->sess_destroy();
                return FALSE;
            }

            $session['last_activity'] = $row['last_activity'];
            if (isset($row['user_data']) AND $row['user_data'] != '') {
                $custom_data = $this->_unserialize($row['user_data']);

                if (is_array($custom_data)) {
                    foreach ($custom_data as $key => $val) {
                        $session[$key] = $val;
                    }
                }
            }
        }
        
        $this->userdata = $session;
        unset($session);

        return TRUE;
    }

    function sess_create() {
        $sessid = '';
        while (strlen($sessid) < 32) {
            $sessid .= mt_rand(0, mt_getrandmax());
        }

        $sessid .= $this->CI->input->ip_address();

        $this->userdata = array(
                            'session_id'    => md5(uniqid($sessid, TRUE)),
                            'ip_address'    => $this->CI->input->ip_address(),
                            'user_agent'    => substr($this->CI->input->user_agent(), 0, 120),
                            'last_activity' => $this->now,
                            'user_data'     => ''

                            );
        

        if ($this->sess_use_redis === TRUE) {
            $has_session = $this->redis->get($this->userdata['session_id']);
            if ($has_session) {
                $this->sess_create();
                return FALSE;
            }
            $this->redis->setex($this->userdata['session_id'], $this->sess_expiration, json_encode($this->userdata));
        }

        $this->_set_cookie();
    }

    function sess_update() {

        if (($this->userdata['last_activity'] + $this->sess_time_to_update) >= $this->now) {
            return;
        }

        $cookie_data = NULL;

        if ($this->CI->input->is_ajax_request()) {

            $this->userdata['last_activity'] = $this->now;

            if ($this->sess_use_redis === TRUE) {

                $cookie_data = array();
                $custom_userdata = $this->userdata;
                foreach (array('session_id','ip_address','user_agent','last_activity') as $val) {
                    unset($custom_userdata[$val]);
                    $cookie_data[$val] = $this->userdata[$val];
                }

                if (count($custom_userdata) === 0) {
                    $custom_userdata = '';
                } else {
                    if (isset($custom_userdata['user_data'])) {
                        unset($custom_userdata['user_data']);
                    }
                    $custom_userdata = $this->_serialize($custom_userdata);
                }

                $this->userdata['user_data'] = $custom_userdata;
                $this->redis->multi()
                            ->delete($this->userdata['session_id'])
                            ->setex($this->userdata['session_id'], $this->sess_expiration, json_encode($this->userdata))
                            ->exec();
            }

            return $this->_set_cookie();
        }

        $old_sessid = $this->userdata['session_id'];
        $new_sessid = '';
        while (strlen($new_sessid) < 32) {
            $new_sessid .= mt_rand(0, mt_getrandmax());
        }

        $new_sessid .= $this->CI->input->ip_address();

        $new_sessid = md5(uniqid($new_sessid, TRUE));
        
        $this->userdata['session_id'] = $new_sessid;
        $this->userdata['last_activity'] = $this->now;

        $cookie_data = array();
        $custom_userdata = $this->userdata;
        foreach (array('session_id','ip_address','user_agent','last_activity') as $val) {
            unset($custom_userdata[$val]);
            $cookie_data[$val] = $this->userdata[$val];
        }

        if (count($custom_userdata) === 0) {
            
            $custom_userdata = '';
        } else {
            if (isset($custom_userdata['user_data'])) {
                unset($custom_userdata['user_data']);
            }
            $custom_userdata = $this->_serialize($custom_userdata);
        }

        if ($this->sess_use_redis === TRUE) {
            $has_session = $this->redis->get($new_sessid);
            if ($has_session) {
                $this->sess_update();
                return FALSE;
            }
            $this->userdata['user_data'] = $custom_userdata;    
            $this->redis->setex($new_sessid, $this->sess_expiration, json_encode($this->userdata));
            $this->redis->delete($old_sessid);
        }

        $this->_set_cookie();
    }

    function sess_write() {
        if ($this->sess_use_redis === FALSE) {
            $this->_set_cookie();
            return;
        }
        $custom_userdata = $this->userdata;
        $cookie_userdata = array();

        foreach (array('session_id','ip_address','user_agent','last_activity') as $val) {
            unset($custom_userdata[$val]);
            $cookie_userdata[$val] = $this->userdata[$val];
        }

        if (count($custom_userdata) === 0) {
            $custom_userdata = '';
        } else {
            if (isset($custom_userdata['user_data'])) {
                unset($custom_userdata['user_data']);
            }
            $custom_userdata = $this->_serialize($custom_userdata);
        }
            
        $this->userdata['user_data'] = $custom_userdata;
        $this->redis->multi() 
                    ->delete($this->userdata['session_id'])
                    ->setex($this->userdata['session_id'], $this->sess_expiration, json_encode($this->userdata))
                    ->exec();

        $this->_set_cookie();
    }

    function _set_cookie($cookie_data = NULL) {
        
        $expire = ($this->sess_expire_on_close === TRUE) ? 0 : $this->sess_expiration + time();

        setcookie(
                    $this->sess_cookie_name,
                    $this->userdata['session_id'],
                    $expire,
                    $this->cookie_path,
                    $this->cookie_domain,
                    $this->cookie_secure
                );
    }

    function _sess_gc() {
        if ($this->sess_use_redis == TRUE) {
            return;
        }
    }

    function sess_destroy() {
        if ($this->sess_use_redis === TRUE AND isset($this->userdata['session_id'])) {
            
            $this->redis->delete($this->userdata['session_id']);
        }

        setcookie(
                    $this->sess_cookie_name,
                    addslashes(serialize(array())),
                    ($this->now - 31500000),
                    $this->cookie_path,
                    $this->cookie_domain,
                    0
                );
    }
}

/* End of file MY_Session.php */
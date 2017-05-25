<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Revisions
 *------------------------------------------------------------------
 * Date       | Author                 | Revisions
 *------------------------------------------------------------------
 * 2017-05-25 | Analyn R. Sosa         | Initial Draft
 *------------------------------------------------------------------
 *
 */

class Login extends MY_Controller {

    public $model  = "prize_model";
    public $module = "main";
    public $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data["err"] = array("code"=>"", "msg"=>"");
        $this->main_html("login", $data);
    }

    public function log_in()
    {
        $username    = rawurldecode($this->input->post("user"));
        $password    = rawurldecode($this->input->post("pwd"));
        $terminal_id = @$_SERVER["SSL_CLIENT_I_DN_OU"];

        $this->load->model("session_model");
        $this->load->helper("text");
            
        $params = http_build_query(array(
                        "UserId"      => $username,
                        "Password"    => $password,
                        "TerminalId"  => $terminal_id
                       ));

        $curl = curl_init(); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, LOGIN_API);

        if (curl_errno($curl)) {
            $log  = date("Y-m-d H:i:s")." :: Curl Error No: ".curl_errno($curl)." || ";
            $log .= "Curl Error: ".curl_error($curl)."\n";
            syslogs($log, "LOGIN");

            echo json_encode(array("code"=>"99", "msg"=>"Unable to connect to log in API. Please try again."));
            return;
        }

        $result = curl_exec($curl);
        if ($result === false) {
            echo json_encode(array("code"=>"99", "msg"=>"Curl Error: ".curl_error($curl)));
            return;
        }

        $res = json_decode($result);
        if(isset($res->code) && ($res->code === "0" || $res->code === "2")) {
            if ($res->userType == 3) {
                echo json_encode(array("code"=>"99", "msg"=>"You are not allowed to log-in on this site!"));
                return;
            }

            $this->session->set_userdata("emp_no", $res->userId);
            $this->session->set_userdata("cost_center", $res->branchCode);
            $this->session->set_userdata("user_type", $res->userType);

            $encrypt_second = md5($this->session->userdata("emp_no").date("s"));
            $this->session->set_userdata("rfs_session", $encrypt_second);
            $this->session_model->save_session($this->session->userdata("emp_no"), $encrypt_second, $res->userType);

            curl_close($curl);
            echo json_encode(array("code"=>"00", "msg"=>"Successfully logged in"));
            return;
        } else {
            echo json_encode(array("code"=>"99", "msg"=>$res->message));
            return;
        }
    }
}
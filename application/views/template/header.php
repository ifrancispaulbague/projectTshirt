 <header class="main-header">
    <title> <?=TITLE?> </title>  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin_lte/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin_lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin_lte/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin_lte/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin_lte/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin_lte/plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin_lte/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin_lte/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin_lte/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin_lte/icons/ionicons.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin_lte/plugins/morris/morris.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/admin_lte/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
 </header>

 <header class="main-header">
    <a href="<?php echo base_url(). "assets/";?>index2.html" class="logo">
      <span class="logo-mini"><b>P</b>TS</span>
      <span class="logo-lg"><b>PRØject </b>T-Shirt</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="<?php echo base_url(). "assets/";?>#" class="dropdown-toggle" data-toggle="dropdown">
              <?php if ($this->session->userdata("user_data") != '') {
                      $data = $this->session->userdata("user_data");
                      if ($data->user_type == 'A') { ?>
                        <img src="<?=base_url()?>assets/admin_lte/dist/img/user3-128x128.jpg" class="user-image" alt="User Image">
              <?php   } else { ?>
                        <img src="<?=base_url()?>assets/admin_lte/dist/img/avatar5.png" class="user-image" alt="User Image">
              <?php   }
                    } else { ?>
                      <img src="<?=base_url()?>assets/admin_lte/dist/img/avatar5.png" class="user-image" alt="User Image">
              <?php } ?>

              <span class="hidden-xs"> 
                <!-- login user profile -->
                <?php 
                  if ($this->session->userdata("user_data") != '') {
                    $data = $this->session->userdata("user_data");
                    if ($data->user_type == 'A') {
                      echo 'Admin '.$data->first_name.' '.$data->last_name;
                    } else {
                      echo 'User '.$data->first_name.' '.$data->last_name;
                    }
                  } else {
                    echo "User";
                  }
                ?>
              </span>

            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php if ($this->session->userdata("user_data") != '') {
                        $data = $this->session->userdata("user_data");
                        if ($data->user_type == 'A') { ?>
                          <img src="<?=base_url()?>assets/admin_lte/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                <?php   } else { ?>
                          <img src="<?=base_url()?>assets/admin_lte/dist/img/avatar5.png" class="img-circle" alt="User Image">
                <?php   }
                      } else { ?>
                        <img src="<?=base_url()?>assets/admin_lte/dist/img/avatar5.png" class="img-circle" alt="User Image">
                <?php } ?>

                <p>
                  <!-- login user profile -->
                  <?php 
                    if ($this->session->userdata("user_data") != '') {
                      $data = $this->session->userdata("user_data");
                      if ($data->user_type == 'A') {
                        echo $data->first_name.' '.$data->last_name.' - Application Developer';
                      } else {
                        echo 'User '.$data->first_name.' '.$data->last_name;
                      }
                    } else {
                      echo "User";
                    }
                  ?>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <?php if ($this->session->userdata("user_data") != '') { ?>
                  <div class="pull-right">
                    <a href="<?=base_url()?>home/index" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                <?php } else { ?>
                  <div class="pull-right">
                    <a href="<?=base_url()?>login/index" class="btn btn-default btn-flat">Sign in</a>
                  </div>
                  <div class="pull-left">
                    <a href="<?=base_url()?>login/sign_up" class="btn btn-default btn-flat">Sign Up</a>
                  </div>
                <?php } ?>
                
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="<?php echo base_url(). "assets/";?>#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
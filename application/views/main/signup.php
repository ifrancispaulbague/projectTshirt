<div class="row">
    <div class="col-xs-4"> </div>
    <div class="col-xs-4">

        <center><img src="<?=base_url()?>assets/images/login.png" height="250px" width="300px" data-toggle="tooltip" title="Digital Random Automated Winner Selection"></center>
        <div class="login-box-body">
            <p class="login-box-msg">
                Please fill out all fields.
            </p>

            <form class="form-horizontal" method="POST" action="#" id="login" name="login" enctype="multipart/form-data">
                <div class="form-group has-feedback">
                    <input required type="text" class="form-control" placeholder="Username" maxlength="10" id="user" name="user" autocomplete="off">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input required type="password" class="form-control" placeholder="Password" id="pwd1" name="pwd1">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input required type="password" class="form-control" placeholder="Password" id="pwd2" name="pwd2">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input required type="text" class="form-control" placeholder="First Name" maxlength="50" id="fname" name="fname" autocomplete="off">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input required type="text" class="form-control" placeholder="Last Name" maxlength="50" id="lname" name="lname" autocomplete="off">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <center><span class="hide" id="message" name="message"> </span></center>
                <div class="progress hide" id="bar_div">
                    <div class="progress-bar progress-bar-primary progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" id="loading_bar">
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-4"> </div>
                    <div class="col-xs-4"> </div>
                    <div class="col-xs-4">
                        <button type="button" class="btn btn-primary btn-block btn-flat" id="sign_up">Sign Up</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
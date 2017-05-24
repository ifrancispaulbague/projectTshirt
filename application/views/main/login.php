<div class="row">
    <div class="col-xs-4"> </div>
    <div class="col-xs-4">

        <div class="login-box-body">
            <p class="login-box-msg">
                <b>DRAWS</b><br>
                Enter username and password to continue
            </p>

            <form class="form-horizontal" method="POST" action="#" id="login" name="login" enctype="multipart/form-data">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Username" maxlength="10" id="user" name="user" autocomplete="off">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" id="pwd" name="pwd">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
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
                        <button type="button" class="btn btn-primary btn-block btn-flat" id="sign_in">Sign In</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
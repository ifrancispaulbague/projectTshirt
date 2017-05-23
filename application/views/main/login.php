<div class="row">
    <div class="col-xs-4"> </div>
    <div class="col-xs-4">

        <div class="login-box-body">
            <p class="login-box-msg" style="font-size:25px">
                <b>USSC RAFFLE LOG-IN</b>
            </p>

            <form class="form-horizontal" method="POST" action="<?=base_url()?>home/login" id="login" name="login" enctype="multipart/form-data">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Username" maxlength="10">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="progress">
                    <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-4"> </div>
                    <div class="col-xs-4"> </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" id="sign_in">Sign In</button>
                    </div>
                </div>
            </form>

            <!-- <div class="box box-primary">
                <div class="box-header with-border box-info">
                    <center><h3 class="box-title"><b> USSC RAFFLE LOG-IN </b></h3></center>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label class="col-sm-2 control-label">Username</label>
                            <input type="text" class="form-control col-xs-12" id="username">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-6">
                            <label class="col-sm-2 control-label">Password</label>
                            <input type="password" class="form-control col-sm-5" id="password">
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <button class="btn btn-info" id="btnDraw" name="btnDraw" type="button"> SUBMIT </button>
                    <button class="btn btn-default" id="btnCancel" name="btnCancel" type="button"> CANCEL </button>
                </div>
            </div> -->
        </div>

    </div>
</div>

<!-- ========================= -->
<!-- <div class="login-box">
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
    </div>
</div> -->
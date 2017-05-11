<!DOCTYPE html>
<html lang="en">

<!-- header -->
<head>
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
</head>  
<!-- body   -->
<body class="hold-transition skin-blue layout-top-nav">
    <?php echo $html_body; ?>
   
<div class="">
    
    <div class="content-wrapper">
    <section class="content-header">
      <h1 id="contHeader"><small></small></h1>
    </section>
<!-- content -->

      <section class="content">
            <!--script-->
            <?php echo $html_script; ?>
            <!----> 

        <div class="row">

            <div class="col-md-9">
                <div class="box box-primary">

                <div class="box-header with-border box-info">
                    <h3 class="box-title">Raffle Draw</h3>
                        <div class="box-tools">
                        </div>
                </div>

                    <div class="box-body">
                        <label class="col-sm-2 control-label">Promo Title</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="category">
                                <option value=""></option>
                                <option value="Major">-</option>
                                <option value="Minor">--</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-body" id='prize_category'>
                        <label class="col-sm-2 control-label">Prize Category</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="major">/
                                <option value=""></option>
                                <option value="Major">Major</option>
                                <option value="Minor">Minor</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-body" id='minor_prize'>
                        <label class="col-sm-2 control-label">Prize Type</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="minor">
                                <option value=""></option>
                                <option value="">Php 500</option>
                                <option value="">Php 1000</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-body" id='winners'>
                        <label class="col-sm-2 control-label">No. of Winners</label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" placeholder=".col-xs-1">
                        </div>
                    </div>

                <div class="box-footer">
                    <a href="<?=base_url()?>home/drawww" class="btn btn-info pull-left" id="btnSearch" name="btnSearch" type="button" >
                        SUBMIT
                    </a>
                </div>

                </div>
            </div>
        </div>     

        <div class="row">
                <div class="col-md-9">
                 <div class="box box-primary">
                    <div class="box-header with-border box-info">
                      <h3 class="box-title"></h3>
                      <div class="box-tools">
                      </div>
                    </div>
                <div class"box-body">
                </div>
                  
                </div>
              </div>
        </div>
      </section>
<!-- end of content -->

    </div>

</div> 
<!-- footer -->
        <?php echo $html_footer; ?>
<!-- end of footer -->
</body>

</html>
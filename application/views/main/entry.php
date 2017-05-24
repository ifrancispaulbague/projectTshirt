<?=$this->load->view("main/message", $err);?>
<?=$this->load->view("main/modal");?>
<div class="col-xs-12">

    <div class="box box-primary">
        <!-- header -->
        <div class="box-header with-border box-info">
            <h1 class="box-title">Raffle Entries</h1>
                <a href="<?=base_url()?>" class="btn btn-danger pull-right btn-xs" type="button"> Log-out </a>         
                <a href="<?=base_url()?>home/homepage" class="btn btn-info pull-right btn-xs" type="button"> Homepage </a>
        </div>

        <!-- raffle entry form -->
        <form class="form-horizontal" method="POST" action="#" id="entry_form" name="entry_form" enctype="multipart/form-data">
            <div class="box-body">
                <label class="col-sm-2 control-label">Promo Title</label>
                <div class="col-sm-4">
                    <select class="form-control" id="category">
                        <option value="0">--- SELECT ---</option>
                        <option value="upgrade">USSC PanaloWallet Upgrade</option>
                    </select>
                </div>
            </div>
            <div class="box-body">
                <label class="col-sm-2 control-label" for="filename">File</label>
                <div class="col-sm-3">
                    <input type="file" class="file" id="filename" name="filename" required>
                    <input type="text" class="hide" id="promo_desc" name="promo_desc" required>
                </div>
            </div>
        </form>

        <div class="box-footer">
          <div class="box-content col-sm-1">
            <button class="btn btn-info pull-left btn-sm" id="btnEntry" name="btnEntry" type="button" > SUBMIT </button>
          </div>
          <div class="box-content">
            <button class="btn btn-default pull-left btn-sm" id="btnCancel" name="btnCancel" type="button"> CANCEL </button>
          </div>
        </div>

    </div>
</div>
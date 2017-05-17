<?=$this->load->view("main/message", $err);?>
<div class="col-xs-12">
   
    <div class="box box-primary">
        <!-- header -->
        <div class="box-header with-border box-info">
            <h1 class="box-title">Raffle Entries</h1>
                <a href="<?=base_url()?>" class="btn btn-info pull-right btn-xs" type="button">
                    Back to Homepage
                </a>
        </div>

        <!-- raffle entry form -->
        <form class="form-horizontal" method="POST" action="#" id="entry_form" name="entry_form" enctype="multipart/form-data">
            <div class="box-body">
                <label class="col-sm-2 control-label">Promo Title</label>
                <div class="col-sm-3">
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
            <button class="btn btn-info pull-left" id="btnEntry" name="btnEntry" type="button">
                SUBMIT
            </button>
        </div>
    </div>
</div>
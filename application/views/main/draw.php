<?=$this->load->view("main/message", $err);?>
<div class="col-xs-12">

    <form class="form-horizontal" method="POST" action="#" id="draw_form" name="draw_form" enctype="multipart/form-data">
        <div class="box box-primary">
            <!-- Title Header -->
            <div class="box-header with-border box-info">
                <h3 class="box-title">Raffle Draw</h3>
                <a href="<?=base_url()?>" class="btn btn-info pull-right btn-xs" id="btnHome" name="btnHome" type="button">
                Back to Homepage
                </a>
            </div>
            <!-- End of Title Header -->
        
            <div class="box-body">
                <label class="col-sm-2 control-label">Promo Title</label>
                <div class="col-sm-4">
                    <select class="form-control" id="category" name="category">
                        <option value="0">--- SELECT ---</option>
                        <option value="upgrade">USSC PanaloWallet Upgrade</option>
                    </select>
                </div>
            </div>
            
            <!-- Content -->
            <div class="box-body" id='div_category'>
                <label class="col-sm-2 control-label">Prize Category</label>
                <div class="col-sm-4">
                    <select class="form-control" id="prize_category" name="prize_category">
                        <option value="0">--- SELECT ---</option>
                        <option value="minor">Minor</option>
                        <option value="major">Major</option>
                    </select>
                </div>
            </div>

            <div class="box-body" id='div_type'>
                <label class="col-sm-2 control-label">Prize Type</label>
                <div class="col-sm-4">
                    <select class="form-control" id="prize_type" name="prize_type">
                        <option value="0">--- SELECT ---</option>
                    </select>
                </div>
            </div>

            <div class="box-body" id='div_winners'>
                <label class="col-sm-2 control-label">No. of Winners</label>
                <div class="col-sm-4">
                    <input type="text" id="winners" name="winners" class="col-sm-5" readonly>
                </div>
            </div>
            <!-- End of Content -->

            <div class="box-footer">
                <button class="btn btn-info pull-left" id="btnDraw" name="btnDraw" type="button"> SUBMIT </button>
                <button class="btn btn-default pull-left" id="btnCancel" name="btnCancel" type="button"> CANCEL </button>
            </div>
        </div>

        <!-- Confirm Add Entries -->
        <div class="box box-primary hide" id="confirm_div">
            <div class="box-header with-border box-info">
                <h3 class="box-title">Confirm Entries</h3>
            </div>

            <div class="box-body"> 
                <div class="box-body table-responsive">   
                    <table class="table table-bordered table-hover table-striped" id="tbl_winners">
                        <thead>
                            <tr> 
                                <th style='text-align:center'><h3>PK</h3></th>
                                <th style='text-align:center'><h3>Product</h3></th>
                                <th style='text-align:center'><h3>Description</h3></th>
                                <th style='text-align:center'><h3>Transaction Date</h3></th>
                            </tr>
                        </thead>
                        <tbody id="tbody_winner">
                        <!--  -->
                        </tbody>
                    </table>
                </div>

                <div class="box-footer">
                    <button class="btn btn-info pull-left" id="btnConfirm" name="btnConfirm" type="button">
                        Confirm
                    </button>
                </div>
                
                <input type="text" id="record_id" name="record_id" class="col-sm-5 hide">
            </div>
        </div>
    </form>

</div>
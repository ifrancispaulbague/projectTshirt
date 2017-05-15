<div class="col-xs-12">

    <!-- Title Header -->
    <div class="box box-primary">
        <div class="box-header with-border box-info">
            <h3 class="box-title">Raffle Draw</h3>
                <a href="<?=base_url()?>home/" class="btn btn-info pull-right btn-xs" id="btnHome" name="btnHome" type="button" >
                Back to Homepage
                </a>
          
        </div>
    <!-- End of Title Header -->
    
        <div class="box-body">
            <label class="col-sm-2 control-label">Promo Title</label>
                <div class="col-sm-3">
                    <select class="form-control" id="category">
                        <option value=""></option>
                        <option value="upgrade">USSC PanaloWallet Upgrade</option>
                    </select>
                </div>
        </div>
        
      <!-- Content -->
        <div class="box-body" id='prize_category'>
            <label class="col-sm-2 control-label">Prize Category</label>
                <div class="col-sm-3">
                    <select class="form-control" id="prize_category">/
                        <option value=""></option>
                        <option value="Major">Major</option>
                        <option value="Minor">Minor</option>
                    </select>
                </div>
        </div>

        <div class="box-body" id='minor_prize'>
            <label class="col-sm-2 control-label">Prize Type</label>
                <div class="col-sm-3">
                    <select class="form-control" id="prize_type">
                         <option value=""></option>        
                    </select>
                </div>

        </div>
        <div class="box-body" id='winners'>
            <label class="col-sm-2 control-label">No. of Winners</label>
                <div class="col-sm-1">
                    <input type="text" id="winners" class="col-sm-2">
                </div>
        </div>
      <!-- End of Content -->

		      <div class="box-footer">
            <button class="btn btn-info pull-left" id="btnDraw" name="btnDraw" type="button" >
       			  SUBMIT
            </button>
          </div>

    </div>

</div>
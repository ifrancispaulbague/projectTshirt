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
           <button class="btn btn-info pull-left" id="btnSearch" name="btnSearch" type="button" >
       			SUBMIT
           </button>
       </div>

    </div>

</div>
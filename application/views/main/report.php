<div class="col-xs-12">
                       
    <div class="box box-primary">
        <div class="box-header with-border box-info">
            <h3 class="box-title">Reports</h3>
            <a href="<?=base_url()?>" class="btn btn-info pull-right btn-xs" id="btnHome" name="btnHome"> Back to Homepage </a>
        </div>

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
            <label class="col-sm-2 control-label">Criteria</label>
            <div class="col-sm-4">
                <select class="form-control" id="extract">
                    <option value="0">--- SELECT ---</option>
                    <option value="entry">Raffle Entries</option>
                    <option value="prize">Raffle Prizes</option>
                    <option value="winner">Raffle Winners</option>
                </select>
            </div>
        </div>
        <div class="box-footer">
                <button class="btn btn-info pull-left btn-sm" id="btnReport" name="btnReport" type="button" >
                    SUBMIT
                </button>
            </div>

            <div class="box-body table-responsive">   
                <table class="table table-bordered table-hover table-striped" id="tbl_reports" hidden>
                    <thead>
                        <th style='text-align:center'></th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
       
    </div>
</div>
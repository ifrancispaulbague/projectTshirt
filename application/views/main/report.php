<div class="col-xs-12">
                       
<!-- Title Header -->
<div class="box box-primary">
    <div class="box-header with-border box-info">
        <h3 class="box-title">Reports Data</h3>
            <a href="<?=base_url()?>home/" class="btn btn-info pull-right btn-xs" id="btnHome" name="btnHome" type="button" >
            Back to Homepage
            </a>
    </div>
<!-- End of Title Header -->

       <div class="box-body">
           <label class="col-sm-2 control-label">Promo Title</label>
               <select id="category">
                   <option value=""></option>
                   <option value="Major">Major</option>
                   <option value="Minor">Minor</option>
               </select>
       </div>
       <div class="box-body">
           <label class="col-sm-2 control-label">Reports</label>
               <select id="category">
                   <option value=""></option>
                   <option value="Major">Raffle Entries</option>
                   <option value="Minor">Raffle Prizes</option>
                   <option value="Minor">Raffle Winners</option>
               </select>
       </div>
  
           <div class="box-footer">
               <button class="btn btn-info pull-left" id="btnSearch" name="btnSearch" type="button" >
           SUBMIT
               </button>
           </div>

        </div>
</div>
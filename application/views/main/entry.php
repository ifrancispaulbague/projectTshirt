
    <div class="col-xs-12">
       
        <!-- Title Header -->
        <div class="box box-primary">
            <div class="box-header with-border box-info">
                <h3 class="box-title">Raffle Entries</h3>
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
                  <div class="form-group">
                      <label for="InputFile">File</label>
                      <input type="file" id="InputFile">
                  </div>
                </div>
      
                <div class="box-footer">
                    <button class="btn btn-info pull-left" id="btnEntry" name="btnEntry" type="button" >
                        SUBMIT
                    </button>
                </div>
        </div>
    </div>
   
        </section>
                 

       </div> 
    </div>
</div>  
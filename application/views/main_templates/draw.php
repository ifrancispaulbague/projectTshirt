

<div class="row">

    <div class="col-md-12">
        <div class="box box-primary">

        <div class="box-header with-border box-info">
            <h3 class="box-title">Raffle Draw</h3>
                <div class="box-tools">
                </div>
        </div>

        <div class"box-body">
            <select>
                <option value="Major">Major</option>
                <option value="Minor">Minor</option>
            </select>
        </div>

        <div class="box-footer">
            <button class="btn btn-info pull-left" id="btnSearch" name="btnSearch" type="button" >
                SUBMIT
            </button>
        </div>

        </div>
    </div>
</div>     

<div class="row">
        <div class="col-md-12">
         <div class="box box-primary">
            <div class="box-header with-border box-info">
              <h3 class="box-title"></h3>
              <div class="box-tools">
              </div>
            </div>
        <div class"box-body">
        </div>
          <div class="box-body table-responsive">
              <table class="table table-condensed table-bordered table-striped table-hover">
                <thead>
                  <tr>
                     <th>PRIZE</th>
                     <th>TYPE</th>
                     <th>WINNERS</th>
                     <th>STATUS</th>
                  </tr>
                </thead>
                <tbody> 
                  <?php foreach ($prizes as $value):?>
                    <tr>
                      <td><?=$value->$prizes?></td>
                      <td><?=$value->$type?></td>
                      <td><?=$value->$winners?></td>
                      <td><?=$value->$status?></td>
                    </tr>
                  <?php endforeach?>
                </tbody>
              </table>
          </div>
        </div>
      </div>
</div>           
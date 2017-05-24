<div class="col-xs-12">
    
    <div class="box-header box-info">
        <a href="<?=base_url()?>" class="pull-right"> Log-out </a>
    </div>
    
    <center><h1> USSC RAFFLE </h1></center>

    <div class="box-body">
        <table class="table text-center" align="center">
            <tr>
                <th>RAFFLE ENTRIES</th>
                <th>DRAW LOTS</th>
                <th>REPORTS</th>
            </tr>
            <tr>
                <td >
                    <a href="<?=base_url()?>home/entries" data-toggle="tooltip" title="Upload Raffle Entries">
                        <img src="<?=base_url()?>assets/images/ticket2.png" height="200" width="200" class="img-circle">
                    </a>
                </td>
                <td>
                     <a data-placement="top" href="<?=base_url()?>home/draw" btn-xs" style="margin:20px auto text-align:center display:block width:120px" data-toggle="tooltip" title="Draw winners from raffle entries">
                        <img src="<?=base_url()?>/assets/images/raffle2.png" height="200" width="200" class="img-circle">
                    </a>
                </td>
                <td>
                     <a href="<?=base_url()?>home/report" style="margin:20px auto text-align:center display:block width:120px" data-toggle="tooltip" title="Upload Raffle Entries">
                        <img src="<?=base_url()?>/assets/images/report2.png" height="200" width="200" class="img-circle">
                    </a>
                </td>
            </tr>
        </table> 
    </div>

</div>  
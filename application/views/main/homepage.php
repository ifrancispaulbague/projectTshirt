<div>
    <form class="form-horizontal" method="POST" action="#" id="entry_form" name="entry_form" enctype="multipart/form-data">
    <center>
        <i class="fa fa-fw fa-star"></i>
        <img src="<?=base_url()?>assets/images/banner.png" height="30%" width="50%">
        <i class="fa fa-fw fa-star"></i>
    </center>
    <table class="table text-center">
        <thead>
        <tr>
            <td >
                <a href="#" onclick="getHerData()" data-toggle="tooltip" title="WOMEN">
                    <img src="<?=base_url()?>assets/images/female.jpg" height="300" width="300" class="img-circle">
                </a>
            </td>
            <td >
                <a href="#" data-toggle="tooltip" title="MEN">
                    <img src="<?=base_url()?>assets/images/male.jpg" height="300" width="300" class="img-circle">
                </a>
            </td>
        </tr>
        </thead>
        <tbody>
            <tr>
                <th>FOR HER</th>
                <th>FOR HIM</th>
                
            </tr>
        </tbody>
    </table> 
        <input type='hidden' id='dataObject' name='dataObject'>
    </form>
</div>

<?php if ($code) { ?>
<div id="err_msg_div" <?php if (!$code) { ?> style="visibility:hidden" <?php } else { ?> style="margin-top:20px;margin-bottom:5px;" tabindex="-1" <?php } ?>
    class="alert <?php if ($code == '00') { ?> alert-success <?php } else { ?> alert-error <?php } ?>">
    <span id="err_msg" name="err_msg"><?=($code and $msg)? $msg: ""; ?></span>
</div>
<?php } ?>
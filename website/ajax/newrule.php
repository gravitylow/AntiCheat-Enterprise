<?php $id = "new"; ?>
<form class="grid-100 grid-parent top-margin-20" id="<?php echo $id; ?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <div class="grid-80">
        <input type="text" name="rule" class="form-control" />
    </div>
    <div class="grid-20 text-center">
        <a href="#savenewrule" data-id="<?php echo $id; ?>" class="btn btn-danger">Save</a>
        <a href="#removenewrule" data-id="<?php echo $id; ?>" class="btn btn-danger">Delete</a>
    </div>
</form>

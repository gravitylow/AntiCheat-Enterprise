<?php $id = "new"; ?>
<form class="grid-100 grid-parent top-margin-20" id="<?php echo $id; ?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <div class="grid-20">
        <input type="text" name="name" class="form-control" />
    </div>
    <div class="grid-10">
        <input type="number" name="level" class="form-control" />
    </div>
    <div class="grid-20">
        <input type="text" name="color" class="form-control" />
    </div>
    <div class="grid-30">
        <input type="text" name="actions" class="form-control" />
    </div>
    <div class="grid-20 text-center">
        <a href="#savenewgroup" data-id="<?php echo $id; ?>" class="btn btn-danger">Save</a>
        <a href="#removenewgroup" data-id="<?php echo $id; ?>" class="btn btn-danger">Delete</a>
    </div>
</form>

<?php
    $titulo = 'New Record';
    $isAdmin = false;
    
    if(is_object($model)){
        $titulo = $model->name.' '. $model->last_name;
    }
?>

<h1 class="page-header">
    <?php echo $titulo; ?>
</h1>

<ol class="breadcrumb">
    <li>
        <a href="<?php echo site_url('Person'); ?>">People</a>
    </li>
    <li class="active">
        <?php echo $titulo; ?>
    </li>
</ol>

<?php echo form_open('Person/save', ['enctype' => 'multipart/form-data']); ?>

<input type="hidden" name="id" value="<?php echo is_object($model) ? $model->id : ''; ?>" />

<div class="form-group">
    <label>Name</label>
    <input type="text" name="name" class="form-control" placeholder="Set user name" value="<?php echo is_object($model) ? $model->name : ''; ?>">
</div>

<div class="form-group">
    <label>Last Name</label>
    <input type="text" name="last_name" class="form-control" placeholder="Set user last name" value="<?php echo is_object($model) ? $model->last_name : ''; ?>">
</div>


<div class="form-group">
    <label>Email</label>
    <input type="text" name="email" class="form-control" placeholder="Set user email" value="<?php echo is_object($model) ? $model->email : ''; ?>">
</div>

<div class="form-group">
    <label>ID Number</label>
    <input type="text" name="id_number" class="form-control" placeholder="Set user ID number" value="<?php echo is_object($model) ? $model->id_number : ''; ?>">
</div>

<div class="form-group">
    <label>DOB</label>
    <div class="input-append date" id="dp3" >
      <input class="form-control" name="dob" size="16" placeholder="Set user date of birth" name="dob" type="text" value="<?php echo (is_object($model) && $model->dob != '0000-00-00') ? $model->dob : ''; ?>"">
      <span class="add-on"><i class="icon-th"></i></span>
    </div>
   
</div>

<div class="form-group">
    <label>Address</label>
    <input type="text" name="address" class="form-control" placeholder="Set user address" value="<?php echo is_object($model) ? $model->address : ''; ?>">
</div>

<div class="form-group">
    <label>Image</label>
    <input type="file" name="image" class="form-control">
</div>






<button class="btn btn-primary" type="submit">
    Save
</button>

<?php echo form_close(); ?>



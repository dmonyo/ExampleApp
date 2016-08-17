<?php
    $titulo = 'New Record';
    $isAdmin = false;
    
    if(is_object($model)){
        $titulo = $model->email;
    }
?>

<h1 class="page-header">
    <?php echo $titulo; ?>
</h1>

<ol class="breadcrumb">
    <li>
        <a href="<?php echo site_url('Users'); ?>">Users</a>
    </li>
    <li class="active">
        <?php echo $titulo; ?>
    </li>
</ol>

<?php echo form_open('Users/save', ['enctype' => 'multipart/form-data']); ?>

<input type="hidden" name="id" value="<?php echo is_object($model) ? $model->id : ''; ?>" />


<div class="form-group">
    <label>Email</label>
    <input type="text" name="email" class="form-control" placeholder="Set user email" value="<?php echo is_object($model) ? $model->email : ''; ?>">
</div>

<div class="form-group">
    <label>password</label>
    <input type="password" name="password" class="form-control" placeholder="Set password">
</div>

<div class="form-group">
    <label>Name</label>
    <input type="text" name="name" class="form-control" placeholder="Set user name" value="<?php echo is_object($model) ? $model->name : ''; ?>">
</div>

<div class="form-group">
    <label>Last Name</label>
    <input type="text" name="last_name" class="form-control" placeholder="Set user last name" value="<?php echo is_object($model) ? $model->last_name : ''; ?>">
</div>

<div class="form-group">
    <label>Admin?</label>
    <div class="radio">
      <label>
        <input id="idAdmin" name="isAdmin" type="radio" value="1">
        Yes
      </label>
      <label>
        <input id="idAdmin" name="isAdmin" type="radio" value="0">
        No
      </label>
      
    </div>
</div>


<button class="btn btn-primary" type="submit">
    Save
</button>

<?php echo form_close(); ?>
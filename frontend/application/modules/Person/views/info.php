<?php
    $titulo = 'New Record';
    $isAdmin = false;
    
    if(is_object($model)){
        $titulo = "General Information";
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
        <?php echo "$model->name $model->last_name"; ?>
    </li>
</ol>

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <?php if($model->image != ""): ?>
                    <td><img class="img-responsive" src="<?php echo $model->image; ?>"  /></td>
                <?php else: ?>
                     <img class="img-responsive" src="<?php echo site_url('assets/img/no-thumb.jpg'); ?>"  />
                <?php endif; ?>
        </div>
        <div class="col-sm-6">
            <div class="row">
                <div class="col-xs-12">
                    <label for="<?php echo $model->name;?>">Name</label>
                    <p><?php echo $model->name;?> </p>
                </div>
                <div class="col-xs-12">
                    <label for="<?php echo $model->last_name;?>">Last Name</label>
                    <p><?php echo $model->last_name; ?> </p>
                </div>
                <div class="col-xs-12">
                    <label for="<?php echo $model->email;?>">Email</label>
                    <p><?php echo $model->email; ?> </p>
                </div>
                <div class="col-xs-12">
                    <label for="<?php echo $model->id_number;?>">ID Number</label>
                    <p><?php echo $model->id_number; ?> </p>
                </div>
                 <div class="col-xs-12">
                    <label for="<?php echo $model->dob;?>">DOB</label>
                    <p><?php echo $model->dob; ?> </p>
                </div>
                <div class="col-xs-12">
                    <label for="<?php echo $model->address;?>">Address</label>
                    <p><?php echo $model->address; ?> </p>
                </div>
               
            </div>
        </div>
    </div>
</div>
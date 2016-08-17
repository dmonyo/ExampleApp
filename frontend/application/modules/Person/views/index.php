<h1 class="page-header">
    <a class="pull-right btn btn-primary" href="<?php echo site_url('Person/crud'); ?>">New Record</a>
    People
</h1>

<ol class="breadcrumb">
  <li class="active">Empleados</li>
</ol>
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>            
                <th>Name</th>
                <th>Last Name</th>
                <th >Email</th>
                <th style="width:160px;"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($model as $m): ?>
            <tr>
                
                <td><?php echo $m->name; ?></td>
                <td><?php echo $m->last_name; ?></td>
                <td><?php echo $m->email; ?></td>
                <?php if($m->image != ""): ?>
                    <td><img style="width:60px;" src="<?php echo $m->image; ?>"  /></td>
                <?php else: ?>
                     <td><img style="width:60px;" src="assets/img/no-thumb.jpg"  /></td>
                <?php endif; ?>
                <td class="text-center">
                    <a class="btn btn-xs btn-default" href="<?php echo site_url('Person/info/' . $m->id); ?>">
                        Info
                    </a> 

                    <a class="btn btn-xs btn-success" href="<?php echo site_url('Person/crud/' . $m->id); ?>">
                        Edit
                    </a>                
                    <a class="btn btn-xs btn-danger" href="<?php echo site_url('Person/delete/' . $m->id); ?>" onclick="return confirm('¿Are you sure you want to delete this user?');">
                        Delete
                    </a>
                    
                </td>
            </tr>
            <?php endforeach; ?>
            
        </tbody>
    </table>    
</div>

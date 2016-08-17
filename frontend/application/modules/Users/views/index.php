<?php //var_dump($model); ?>
<h1 class="page-header">
    <a class="pull-right btn btn-primary" href="<?php echo site_url('Users/crud'); ?>">New Record</a>
    Users
</h1>

<ol class="breadcrumb">
  <li class="active">Users</li>
</ol>

<table class="table table-striped table-bordered">
    <thead>
        <tr>   
            <th>isAdmin?</th>        
            <th>Name</th>
            <th>Company</th> 
            <th style="width:160px;"></th>
        </tr>
    </thead>
    <tbody>


        <?php foreach($model as $m): ?>
        <tr>
            
            <td><?php echo ($m->isAdmin)? 'YES': 'NO'; ?></td>
            <td><?php echo $m->name. ' ' .$m->last_name; ?></td>
            <td><?php echo $m->email; ?></td>
            <td class="text-center">
                <a class="btn btn-xs btn-success" href="<?php echo site_url('Users/crud/' . $m->id); ?>">
                    Edit
                </a>
                <?php if($user->id != $m->id): ?>
                    <a class="btn btn-xs btn-danger" href="<?php echo site_url('Users/delete/' . $m->id); ?>" onclick="return confirm('¿Are you sure you want to delete this user?');">
                        Delete
                    </a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php echo $this->pagination->create_links(); ?>
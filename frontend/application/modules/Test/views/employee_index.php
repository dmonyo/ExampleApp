<?php //var_dump($model); ?>

<h1 class="page-header">
    Test - Empleados
    <small>
        <a href="<?php echo site_url('Test/employee_insert'); ?>">Nuevo empleado</a>
    </small>
</h1>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th style="width:60px;"></th>
            <th>Nombre</th>
            <th>Correo</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($model as $m): ?>
        <tr>
            <td><?php echo empty($m->Imagen) ? '' : sprintf('<img class="img-responsive" src="%s" />', $m->Imagen); ?></td>
            <td><?php echo $m->name; ?></td>
            <td><?php echo $m->email; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php echo $this->pagination->create_links(); ?>
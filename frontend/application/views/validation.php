<h1 class="page-header">
    Error de validación
</h1>

<btn class="btn btn-link btn-block btn-default" onclick="window.history.back();">Volver a la página anterior</btn>

<ul class="list-group">
<?php foreach($errors as $k => $error): ?>
    <li class="list-group-item list-group-item-warning">
        <h4 class="list-group-item-heading"><?php echo $k; ?></h4>
        <ul>
            <?php foreach($error as $e): ?>
                <li><?php echo $e; ?></li>
            <?php endforeach; ?>
        </ul>
    </li>
<?php endforeach; ?>
</ul>

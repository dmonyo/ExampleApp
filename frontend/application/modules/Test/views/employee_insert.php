<h1 class="page-header">
    Test - Nuevo empleado
</h1>

<?php echo form_open('', ['enctype' => 'multipart/form-data']); ?>

<div class="form-group">
    <label>Nombre</label>
    <input type="text" name="Nombre" class="form-control" placeholder="Ingrese el nombre" >
</div>

<div class="form-group">
    <label>Correo</label>
    <input type="text" name="Correo" class="form-control" placeholder="Ingrese el correo" >
</div>

<div class="form-group">
    <label>Password</label>
    <input type="text" name="Password" class="form-control" placeholder="Ingrese el password" >
</div>

<div class="form-group">
    <label>Imagen</label>
    <input type="file" name="File" class="form-control" >
</div>

<button class="btn btn-primary" type="submit">
    Enviar
</button>

<?php echo form_close(); ?>
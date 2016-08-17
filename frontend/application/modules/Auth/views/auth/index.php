<div class="col-xs-4"></div>
<div class="col-xs-4">
    <?php echo form_open('Auth/authenticate'); ?>
        <h1 class="page-header">Ingreso al sistema</h1>
    
        <?php if(isset($error)): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
        <?php endif; ?>
    
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input required="required" type="email" id="inputEmail" class="form-control" placeholder="Ingrese su email" name="email" />
        </div>
        <div class="form-group">
        <label for="inputPassword">Password</label>
        <input required="required" type="password" id="inputPassword" class="form-control" placeholder="Ingrese su password" name="password" />
        </div>
        <div class="form-group">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
        </div>
    <?php echo form_close(); ?>
</div>
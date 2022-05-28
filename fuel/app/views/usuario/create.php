<?php
if (isset($errors)) {
    echo '<ul style="color:red"> Errors ';
    foreach ($errors as $error) {
        echo '<li>' . $error . '</li>';
    }
    echo '</ul>';
}
?>
<?php echo Form::open("/usuario/create"); ?>
<div >
    <?php echo Form::label('Nombres', "nombres"); ?>
    <?php
    echo Form::input('nombres', Input::post('nombres', isset($usuario) ? $usuario->nombres : ''));
    ?>
</div>
<div >
    <?php echo Form::label('Rol', "rol"); ?>
    <?php
    echo Form::input('rol', Input::post('rol', isset($usuario) ? $usuario->rol : ''));
    ?>
</div>
<div >
    <?php echo Form::label('Ocupacion', "ocupacion"); ?>
    <?php
    echo Form::input('ocupacion', Input::post('ocupacion', isset($usuario) ? $usuario->ocupacion : ''));
    ?>
</div>
<div>
    <?php echo Form::submit('create'); ?>
</div>
<?php echo Form::close(); ?>
<a href="/usuario/" >Back To List</a>
<head>
    <?php echo Asset::css('style.css'); ?>
</head>
<h2 ><a href="/usuario/create">Create</a> </h2>
<style>
    table, th, td {
        border: 1px solid black;
    }
</style>
<table  >
    <tr><th> Id</th><th>Nombres</th><th>Rol</th><th>Ocupacion</th><tr>
        <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?php echo $usuario->id; ?> </td>
            <td><?php echo $usuario->nombres; ?></td>
            <td><?php echo $usuario->rol; ?></td>
            <td><?php echo $usuario->ocupacion; ?> </td>
            <td>
                <a href="/usuario/view/<?php echo $usuario->id; ?> " >Ver Detalles </a>
                 <a href="/usuario/edit/<?php echo $usuario->id; ?>" >Editar  Detalles </a>
                <a href="/usuario/delete/<?php echo $usuario->id; ?>"  >Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
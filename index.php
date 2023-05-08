<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


$carga = fn($clase)=>require("$clase.php");
spl_autoload_register($carga);

if (isset($_POST['submit'])){
   $productos = $_POST['productos'];
   $familias =  $_POST['familias'];
   BD::actualizaProductos($productos, $familias);
}

$productos = BD::obtener_productos();
$listado = Plantilla::getListadoProductos($productos);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="index.php" method="post">
    <?="$listado"?>
    <input type="submit" value="Actualizar" name="submit">
</form>

</body>
</html>

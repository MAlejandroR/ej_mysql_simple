<?php

class BD
{
    static private $conexion = null;

    static public function obtener_productos()
    {
        if (self::$conexion == null)
            self::conectar();
        $sql = "SELECT * FROM producto";
        $resultado = self::$conexion->query($sql);
        $productos = [];
        while ($fila = $resultado->fetch_assoc()) {
            $productos[] = $fila;
        }
        return $productos;
    }

    static public function conectar()
    {
        $datos = parse_ini_file('conexion.ini', true);
        try {
            self::$conexion = new mysqli($datos['host'], $datos['user'],
                $datos['password'], $datos['basedatos'], $datos['port']);
        } catch (Exception $exception) {
            die("Error conectando " . $exception->getMessage());
        }
    }

    static function obtenerFamilias()
    {
        if (self::$conexion == null)
            self::conectar();
        $sql = "SELECT * FROM familia";
        $resultado = self::$conexion->query($sql);
        $familias = [];
        while ($fila = $resultado->fetch_assoc()) {
            $familias[] = $fila;
        }
        return $familias;
    }

    static function actualizaProductos($productos, $familias)
    {
        if (self::$conexion == null)
            self::conectar();
        foreach ($productos as $index => $producto) {
            $sql = "UPDATE producto SET familia = ? WHERE cod = ?";
            $stmt = self::$conexion->prepare($sql);
//        var_dump($familias);
//        var_dump($producto);
//        var_dump($index);
//        var_dump($productos);
            $stmt->bind_param("ss", $familias[$index], $producto);
            $stmt->execute();
        }
    }


}
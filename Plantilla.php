<?php

class Plantilla
{

    static function getListadoProductos($productos)
    {
        $listado = "<table>";
        $listado .= "<caption>Listado de productos</caption>";
        $listado .= "<tr><th>Nombre</th><th>Precio</th><th>Familia</th></tr>";
        foreach ($productos as $producto) {
            $listado_familias = self::getListadoFamilias($producto['familia']);
            $listado .= "<input type=hidden name=productos[] value='{$producto['cod']}'/>";
            $listado .= "<tr><td>{$producto['nombre_corto']}</td><td>{$producto['PVP']}</td><td>" .
                $listado_familias .
                "</td></tr>";
        }
        $listado .= "</<table>";

        return $listado;
    }

    static function getListadoFamilias(string $familia_selected)
    {
        $familias = BD::obtenerFamilias();
        $listado_familias = "<select name='familias[]'>";
        foreach ($familias as $familia) {
            $selected =($familia['cod'] == $familia_selected) ? "selected" : "";
            $listado_familias .= "<option $selected value='{$familia['cod']}'>{$familia['nombre']}</option>\n";
        }
        $listado_familias .= "</select>\n";
        return $listado_familias;
        }
}
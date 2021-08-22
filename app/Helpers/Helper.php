<?php

namespace App\Helpers;

use Carbon\Carbon;

class Helper
{
    /**
     * Reemplaza las comas por punto para guardar en BD.
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public static function formatearMoneda($value= '')
    {
        return str_replace(',', '.', str_replace('.', '', $value));
    }

    /**
     * Formatea un número con los millares agrupados
     * @param  string $valor   [description]
     * @param  [type] $decimal [description]
     * @return [type]          [description]
     */
    public static function monedaColombia($valor='', $decimal, $currency='')
    {
        return $currency.number_format($valor, $decimal, ',', '.');
    }

    /**
     * Sanear Ampersand
     * @param  string $valor   [description]
     * @param  [type] $decimal [description]
     * @return [type]          [description]
     */
    public static function sanarAmpersand($cadena)
    {
        return str_replace("&", "&amp;", $cadena);
    }

    /**
     * Calcula el Digito de Verificacion
     * @param  [type] $nit [description]
     * @return [type]      [description]
     */
    public static function dv($nit)
    {
        if (! is_numeric($nit)) {
            return false;
        }

        $arr = [
            1  => 3,
            4  => 17,
            7  => 29,
            10 => 43,
            13 => 59,
            2  => 7,
            5  => 19,
            8  => 37,
            11 => 47,
            14 => 67,
            3  => 13,
            6  => 23,
            9  => 41,
            12 => 53,
            15 => 71
        ];
        $x = 0;
        $y = 0;
        $z = strlen($nit);
        $dv = '';

        for ($i=0; $i<$z; $i++) {
            $y = substr($nit, $i, 1);
            $x += ($y*$arr[$z-$i]);
        }

        $y = $x%11;

        if ($y > 1) {
            $dv = 11-$y;
            return $dv;
        } else {
            $dv = $y;
            return $dv;
        }
    }

}

<?php
/**
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    Francisco González <fcojaviergonmi@gmail.com>
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class Validate extends ValidateCore
{
    public static function isDniLite($rut)
    {
        //return empty($dni) || (bool)preg_match('/^[0-9A-Za-z-.]{1,16}$/U', $dni);
        $rut = str_replace(".", "", $rut);
        if (strlen($rut) < 9) {
            $resp = 0;
        } else {
            if ($rut1 = explode("-", $rut)) {
                if (isset($rut[0]) && isset($rut[1])) {

                    $r = (int)$rut1[0];
                    $rut1[0] = (int)$rut1[0];
                    $rut1[1] = (int)$rut1[1];

                    $s = 1;
                    for ($m = 0; $r != 0; $r /= 10)
                        $s = ($s + $r % 10 * (9 - $m++ % 6)) % 11;
                    $digito = chr($s ? $s + 47 : 75);

                    if ($rut1[1] == $digito) {
                        $resp = 1;
                    } else {
                        $resp = 0;
                    }
                } else {
                    $resp = 0;
                }
            } else {
                $resp = 0;
            }
        }
        return $resp;
    }

}

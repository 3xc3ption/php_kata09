<?php
/**
 * Created by PhpStorm.
 * User: PAD
 * Date: 06.02.2019
 * Time: 11:39
 */


ini_set('display_erros', true);



require ("autoloader.php");


function escape($str){
    return htmlentities($str, ENT_QUOTES, 'UTF-8');
}
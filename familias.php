<?php
/**
 * Created by PhpStorm.
 * User: maletil
 * Date: 28/08/17
 * Time: 20:01
 */

if (isset($_GET["auth"])) {
    $auth = $_GET["auth"];

    $apiRequest = "http://localhost/GsoftAPI-A/methods/get/familias.php?auth=". $auth;
    $json_string = file_get_contents($apiRequest);

    if (isset($json_string)) {
        $json_output = json_decode($json_string);
    } else {
        echo('No encontrado');
        $json_output = false;
    }

//var_dump($data);
    echo "<table cellspacing=\"0\">
           <tr class='banner'>
                <td><strong>Codigo</strong></td>
                <td><strong>Nombre</strong></td>
            </tr>";

    if ($json_output) {
        foreach ($json_output as $object):?>

            <tr class="content">
                <td><strong><?php echo $object->{'Codigo'} ?></strong></td>
                <td><strong><?php echo $object->{'Nombre'} ?></strong></td>

            </tr>

        <?php endforeach;
        echo "</table>";
    } else {echo "</table>"; echo ('No encontrado');}
}
?>

<style>
    td{
        padding-right:10px;
        padding-left: 13px;
        padding-top: 4px;
        font-family: Liberation Sans, Arial, monospace;
        font-size: 1rem;
        box-shadow: 1px 0 0 0 #406c52 inset;
    }
    .banner td {
        padding-top: 14px;
        padding-bottom: 12px;
        box-shadow: 1px 0 0 0 #35694a inset;
    }
    .banner{
        background-color: #0d9351;
        color: #f8f8f8;
    }
    .content {
        background-color: #c5d8c6b3;
        font-weight: 300;
        line-height: 1.5;
    }
    .content:nth-child(2n){
        background-color: #FFF;
    }
</style>

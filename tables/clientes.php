<?php
/**
 * Created by PhpStorm.
 * User: maletil
 * Date: 15/08/17
 * Time: 9:55
 */

if (isset($_GET["auth"]) && isset($_GET["search"])) {

    $search = rawurlencode($_GET["search"]);
    $auth = $_GET["auth"];
    $getPrice = "false";


    function phoneNumber($number) {
        if ($number != "") {
            echo "<a target=\"_blank\" href=\"tel:" . $number . "\">" . $number . "</a>";
        }
    }


    $apiRequest = "http://localhost/GsoftAPI-A/methods/get/clientes.php?auth=". $auth ."&search=". $search;
    $json_string = file_get_contents($apiRequest);

    if (isset($json_string)) {
        $json_output = json_decode($json_string);
    } else {
        echo('No encontrado');
        $json_output = false;
    }

//var_dump($data);
    echo "<link rel=\"stylesheet\" href=\"http://localhost/GsoftWEB/css/tables.css\" type=\"text/css\"><table cellspacing=\"0\">
           <tr class='banner'>
                <td><strong>Código</strong></td>
                <td><strong>Nombre Fiscal</strong></td>
                <td><strong>CIF</strong></td>
                <td><strong>C. Postal</strong></td>
                <td><strong>Población.</strong></td>
                <td><strong>Domicilio</strong></td>
                <td><strong>Teléfono 1</strong></td>
                <td><strong>Teléfono 2</strong></td>
            </tr>";

    if ($json_output) {
        foreach ($json_output as $object):?>

            <tr class="content">
                <td><strong><?php echo $object->{'Codigo'} ?></strong></td>
                <td><strong><?php echo $object->{'Nombre Fiscal'} ?></strong></td>
                <td><strong><?php echo $object->{'CIF'} ?></strong></td>
                <td><strong><?php echo $object->{'C Postal'} ?></strong></td>
                <td><strong><?php echo $object->{'Poblacion'} ?></strong></td>
                <td><strong><?php echo $object->{'Domicilio'} ?></strong></td>
                <td><strong><?php phoneNumber($object->{'Telefono1'}); ?></strong></td>
                <td><strong><?php phoneNumber($object->{'Telefono2'}) ?></strong></td>
            </tr>

        <?php endforeach;
        echo "</table>";
    } else {echo "</table>"; echo ('No encontrado');}
}
?>

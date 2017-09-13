<?php
/**
 * Created by PhpStorm.
 * User: maletil
 * Date: 28/08/17
 * Time: 20:01
 */

if (isset($_GET["auth"])) {
    $config = include ('../private/config.php');
    $auth = $_GET["auth"];

    $apiRequest = $config['apihost']."methods/get/familias.php?auth=". $auth;
    $json_string = file_get_contents($apiRequest);

    if (isset($json_string)) {
        $json_output = json_decode($json_string);
    } else {
        echo('No encontrado');
        $json_output = false;
    }

//var_dump($data);
    echo "<link rel=\"stylesheet\" href=\"".$config['webhost']."/css/tables.css\" type=\"text/css\"><table cellspacing=\"0\">
           <tr class='banner'>
                <td><strong>Código</strong></td>
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
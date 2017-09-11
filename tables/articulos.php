<?php
/**
 * Created by PhpStorm.
 * User: maletil
 * Date: 29/08/17
 * Time: 18:02
 */

if (isset($_GET["auth"]) && isset($_GET["search"])) {

    $orderBy = "";
    $orderWord = "";
    $search = rawurlencode($_GET["search"]);
    $auth = $_GET["auth"];
    $getPrice = "false";
    //Config
    $showZeroValue = true;
    $roundPrices = true;
    $roundPrecision = 3;

    if (isset($_GET["getPrice"])) {
        $getPrice = $_GET["getPrice"];
    }
    if (isset($_GET["orderBy"])) {
        $orderBy = $_GET["orderBy"];
    }
    if (isset($_GET["orderWord"])) {
        $orderWord = "&orderWord=" . $_GET["orderWord"];
    }


    $apiRequest = "http://localhost/GsoftAPI-A/methods/get/articulos.php?auth=". $auth ."&search=". $search ."&getPrice=". $getPrice ."&orderBy=". $orderBy . $orderWord;
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
                <td><strong>Nombre</strong></td>
                <td><strong>Familia</strong></td>";
                if ($getPrice == 'true'){
           echo "<td><strong>P. Medio</strong></td>
                <td><strong>P. Últ.</strong></td>";
                }
            echo "<td><strong>Últ. mod.</strong></td>
            </tr>";

    if ($json_output) {
        foreach ($json_output as $object):?>

            <tr class="content">
                <td><strong><?php echo $object->{'Codigo'} ?></strong></td>
                <td><strong><?php echo $object->{'Descripcion'} ?></strong></td>
                <td><strong><?php echo substr($object->{'Codigo'}, 0, 2) ?></strong></td>

                <?php if($getPrice == 'true') {echo "<td><strong>";
                    if($object->{'Precio Medio'} != 0) {
                        if ($roundPrices) {
                            echo round(substr($object->{'Precio Medio'}, 0, 6), $roundPrecision) . "€";
                        } else {
                            echo substr($object->{'Precio Medio'}, 0, 6) . "€";
                        }
                    }else {
                        if ($showZeroValue) {
                            echo '0';
                        }
                    }
                    echo "</strong></td> <td><strong>";

                    if($object->{'Ultimo Precio'} != 0) {
                        if ($roundPrices) {
                            echo round(substr($object->{'Ultimo Precio'}, 0, 6), $roundPrecision) . "€";
                        } else {
                            echo substr($object->{'Ultimo Precio'}, 0, 6) . "€";
                        }
                    } else {
                        if ($showZeroValue) {
                            echo '0';
                        }
                    }
                    echo "</strong></td>"; }?>
                <td><strong><?php echo substr($object->{'Ultima Modificacion'}, 0, 10) ?></strong></td>
            </tr>

        <?php endforeach;
        echo "</table>";
    } else {echo "</table>"; echo ('No encontrado');}
}
?>

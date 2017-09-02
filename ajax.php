<?php
/**
 * Created by PhpStorm.
 * User: maletil
 * Date: 30/08/17
 * Time: 22:16
 */

if (isset($_GET["auth"])){
    $auth = $_GET["auth"];
?>

<html>
<head>
    <script>
        function showResult(str) {
            if (str.length==0 | str.length==1) {
                document.getElementById("livesearch").innerHTML="";
                document.getElementById("livesearch").style.border="0px";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    document.getElementById("livesearch").innerHTML=this.responseText;
                }
            };

            <?php $mode = 0; $orderBy = "Familia";
            if (isset($_GET["mode"])){
                $mode = $_GET["mode"];
            }
            if ($mode == 1){
                $url = "http://localhost/GsoftWEB/clientes.php?auth=1&search=";
            }else {
                $url = "http://localhost/GsoftWEB/articulos.php?auth=". $auth ."&orderBy=". $orderBy ."&getPrice=false&search="; } ?>
            xmlhttp.open("GET","<?php echo $url;?>"+str,true);
            xmlhttp.send();
            console.log(xmlhttp);
        }
</script>
</head>
<body>
    <form>
        <input type="radio" id="nombre" name="order" value="nombre" checked>
        <label for="nombre">Nombre</label>
        <input type="radio" id="familia" name="order" value="familia">
        <label for="familia">Familia</label>
        <input type="radio" id="fecha" name="order" value="fecha">
        <label for="fecha">Fecha</label>
    </form>
    <script>


        var x = document.getElementById("nombre").value;
        if (x = "nombre"){
            console.log("nombre");
        } else {
            console.log("no es nombre");
        }
    

</script>
<form>
<label>
<input type="text" size="30" onkeyup="showResult(this.value)">
    </label>
    <div id="livesearch"></div>
    </form>
    </body>
    </html>
<?php } ?>
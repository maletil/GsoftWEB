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
        var order = "";
        function orderby(str) {
            console.log(str);
            order = str;
        }
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

            <?php $mode = 0;
            if (isset($_GET["mode"])){
                $mode = $_GET["mode"];
            }
            if ($mode == 1){
                $url = "http://localhost/GsoftWEB/clientes.php?auth=1&search=";
            }else {
                $url = "http://localhost/GsoftWEB/articulos.php?auth=". $auth ."&getPrice=false&search="; } ?>
            console.log(order);
            xmlhttp.open("GET","<?php echo $url;?>"+ str + "&orderBy=" + order,true);
            xmlhttp.send();
            console.log(xmlhttp);
        }
</script>
</head>
<body>
    <form>
        <input type="radio" id="nombre" name="order" value="Nombre" onclick="orderby(this.value);"  checked>
        <label for="nombre">Nombre</label>
        <input type="radio" id="familia" name="order" value="Familia" onclick="orderby(this.value);">
        <label for="familia">Familia</label>
        <input type="radio" id="fecha" name="order" value="Fecha" onclick="orderby(this.value);">
        <label for="fecha">Fecha</label>
    </form>
<form>
<label>
<input type="text" size="30" onkeyup="showResult(this.value)">
    </label>
    <div id="livesearch"></div>
    </form>
    </body>
    </html>
<?php } ?>
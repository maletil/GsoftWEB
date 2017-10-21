<?php
/**
 * Created by PhpStorm.
 * User: maletil
 * Date: 30/08/17
 * Time: 22:16
 */

if (isset($_GET["auth"])){
    $auth = $_GET["auth"];
    $mode = 0;
if (isset($_GET["mode"])){
    $mode = $_GET["mode"];
}
    $config = include ('private/config.php');
?>

<html>
<head>
    <script>
        var price = true;
        var order = "Nombre";
        var search = "";

        function priceBox(str) {

            price = getPrice.checked;
            makerequest();
        }
        function orderby(str) {
            order = str;
            makerequest();
        }
        function showResult(str) {
            if (str.length === 0 || str.length === 1) {
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
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById("livesearch").innerHTML=this.responseText;
                }
            };
            search = str;
            makerequest();
        }
        function makerequest() {
            console.log(order);
            console.log(search);
            console.log(price);
            var petition = "<?php echo $config['webhost']?>tables/articulos.php" + "?search=" + search + "&orderBy=" + order + "&getPrice=" + price + "&auth=<?php echo $auth;?>" ;
            xmlhttp.open("GET",petition,true);
            xmlhttp.send();
            console.log(xmlhttp);
        }
</script>
</head>
<body>
    <form>
        <input type="radio" id="nombre" name="order" value="Nombre" onclick="orderby(this.value);" checked>
        <label for="nombre">Nombre</label>
        <input type="radio" id="familia" name="order" value="Familia" onclick="orderby(this.value);">
        <label for="familia">Familia</label>
        <input type="radio" id="fecha" name="order" value="Fecha" onclick="orderby(this.value);">
        <label for="fecha">Fecha</label>
        <input id="getPrice" type="checkbox" value="true" style="margin-left:35px;" onclick="priceBox(this.value)" checked>
        <label for="getPrice">Precios</label>
    </form>
<form>
<label>
<input id="box" type="text" size="30" onkeyup="showResult(this.value);">
    </label>
    <br>
    <div id="livesearch"></div>
    </form>
    </body>
    </html>
<?php } ?>
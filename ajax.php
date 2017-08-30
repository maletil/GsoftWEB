<?php
/**
 * Created by PhpStorm.
 * User: maletil
 * Date: 30/08/17
 * Time: 22:16
 */?>

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
            }

            <?php if (isset($_GET["mode"])){
                $mode = $_GET["mode"];
            }
            if ($mode == 1){
                $url = "http://localhost/GsoftWEB/clientes.php?auth=1&search=";
            }else {
                $url = "http://localhost/GsoftWEB/articulos.php?auth=1&orderBy=Fecha&getPrice=false&search="; } ?>
xmlhttp.open("GET","<?php echo $url;?>"+str,true);
xmlhttp.send();
console.log(xmlhttp);
}
</script>
</head>
<body>

<form>
<label>
<input type="text" size="30" onkeyup="showResult(this.value)">
    </label>
    <div id="livesearch"></div>
    </form>
    </body>
    </html>

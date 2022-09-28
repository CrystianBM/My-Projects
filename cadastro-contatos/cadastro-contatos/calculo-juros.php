<?php 
include('dbcon.php');
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="datepicker.material.css">
<script src="datepicker.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="jquery.maskMoney.js" type="text/javascript"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

<title> Cadastrar Contato </title>

</head>

<body class="body">

<h2 class="titulo"> Sistema de cadastro de contatos
	<a href="index.php"> 
        <button type="button" class="btn btn-primary logout" data-bs-toggle="button" title="Register" name="register" value="Registrar">Logout</button> 
    </a>
</h2>

<table class="tableMenu">
    <tr class="menu">
        <th class="thMenu"><a href="home.php" class="linkMenu">Home</a></th>
        <th class="thMenu"><a href="cadastro-usuario.php" class="linkMenu">Cadastrar Usuario</a></th>
        <th class="thMenu"><a href="cadastro-contatos.php" class="linkMenu">Cadastrar Contato</a></th>
        <th class="thMenu"><a href="exibir-contatos.php" class="linkMenu">Exibir Contatos</a></th>
        <th class="thMenu"><a href="misc.php" class="linkMenu">Outros</a></th>
    </tr>
</table>

<div class="form-wrapper-juros">
  
  	<form class="form-juros" action="#" method="post">
    	<table class="tableJuros">
            <tr>
                <td class="tdJuros v1" >
                    <form>
                        Digite o valor da parcela <br>
                        <input type="text" name="parcela" id="parcela" class="parcela" placeholder="R$ 0,00" autofocus="true"/>
                    </form>
                </td>
                <td class="tdJuros">
                    <div calss="tdJurosContent">
                        Valor da parcela com o reajuste
                        <input id="totalComJuros" readonly style="display: block;" placeholder="R$ 0,00"/>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="tdJuros">
                    Selecione a data de vencimento da parcela <br>
                    <input type="text" id="data" class="data" name="data" placeholder="00/00/0000"/>
                </td>
                <td class="tdJuros v2">
                    Total de juros até a presente data
                    <input type="text" id="totalDeJuros" readonly style="display: block;" placeholder="R$ 0,00"/>
                </td>
            </tr>
        </table>
        <br>
        <button type="submit" class="btn btn-primary" data-bs-toggle="button" id="calcular" name="calcular" value="Calcular">Calcular</button>
	<?php
	if (isset($_POST['calcular']))
    {   
        $date = explode("/", $_REQUEST["data"]);
        if (count($date) <= 2) {
            echo("<h5 class='aviso erro'>Insira uma data válida e tente novamente.</h5>");
        }else{
            $actDate = explode("-", date("d-m-Y"));
            $valParcela = floatval(str_replace("R$ ", "", str_replace(",", ".", str_replace(".", "", $_REQUEST["parcela"]))));
            $valParc = $_REQUEST["parcela"];
            $valFinal = $valParcela + $valParcela * 5 / 100;
            $valJuros = 0;

            $diffDate = [$actDate[0] - $date[0], $actDate[1] - $date[1], $actDate[2] - $date[2]];

            $diffMonth = $diffDate[1] + ($diffDate[2]*12);
            $totalDiffDays = $diffDate[0] + ($diffMonth*30);


            if ($totalDiffDays <= 0) {
                ?>
                <script>
                    var valFinal = document.getElementById("totalComJuros");
                    <?php echo "valFinal.value = parseFloat($valParcela).toFixed(2);"?>;
                    var valJuros = document.getElementById("totalDeJuros");
                    <?php echo "valJuros.value = parseFloat($valJuros).toFixed(2);"?>;
                </script>
                <?php
            }else{
                $valJuros = $valParcela * 5 / 100;
                for ($i=1; $i <= $totalDiffDays; $i++) { 
                    if ($i % 30 == 0) {
                        $valFinal = $valFinal + $valParcela * 5 / 100;
                        $valJuros = $valJuros + $valParcela * 5 / 100;
                    }else{
                        $valFinal = $valFinal + $valParcela * 32/1000;
                        $valJuros = $valJuros + $valParcela * 32/1000;
                    }
                }
                ?>
                <script>

                    function maskThis(x){
                        var valArray = String(x.toFixed(2)).split(""); //dividir em array para colocar o "R$ " e pontuação de milhar e decimal entre cada item do array
                        var valArrayCount = valArray.length;
                        valArray[valArray.indexOf(".")] = ",";
                        if (valArrayCount > 6 ){
                            valArray.splice(1, 0, ".");
                        }
                        valArray.unshift("R$ ");
                        return valArray.join("");
                    }

                    var valFinal1 = document.getElementById("totalComJuros");
                    valFinal1.value = maskThis(<?=$valFinal?>);

                    var valJuros1 = document.getElementById("totalDeJuros");
                    valJuros1.value = maskThis(<?=$valJuros?>);

                    var valParc = document.getElementById("parcela")
                    valParc.value = "<?= $_REQUEST["parcela"]?>";

                    var valDate = document.getElementById("data");
                    valDate.value = "<?=$_REQUEST["data"]?>";
                </script>
                <?php
            }
        }
	}
  	?>
    
</form>

</div><br><br>

<script>
    !function($){"use strict";function e(e,t){var n="";return e.indexOf("-")>-1&&(e=e.replace("-",""),n="-"),e.indexOf(t.prefix)>-1&&(e=e.replace(t.prefix,"")),e.indexOf(t.suffix)>-1&&(e=e.replace(t.suffix,"")),n+t.prefix+e+t.suffix}function t(e,t){return t.allowEmpty&&""===e?"":t.reverse?a(e,t):n(e,t)}function n(t,n){var a,i,o,l=t.indexOf("-")>-1&&n.allowNegative?"-":"",s=t.replace(/[^0-9]/g,"");return a=r(s.slice(0,s.length-n.precision),l,n),n.precision>0&&(i=s.slice(s.length-n.precision),o=new Array(n.precision+1-i.length).join(0),a+=n.decimal+o+i),e(a,n)}function a(t,n){var a,i=t.indexOf("-")>-1&&n.allowNegative?"-":"",o=t.replace(n.prefix,"").replace(n.suffix,""),l=o.split(n.decimal)[0],s="";if(""===l&&(l="0"),a=r(l,i,n),n.precision>0){var c=o.split(n.decimal);c.length>1&&(s=c[1]),a+=n.decimal+s;var u=Number.parseFloat(l+"."+s).toFixed(n.precision).toString().split(n.decimal)[1];a=a.split(n.decimal)[0]+"."+u}return e(a,n)}function r(e,t,n){return e=e.replace(/^0*/g,""),""===(e=e.replace(/\B(?=(\d{3})+(?!\d))/g,n.thousands))&&(e="0"),t+e}$.browser||($.browser={},$.browser.mozilla=/mozilla/.test(navigator.userAgent.toLowerCase())&&!/webkit/.test(navigator.userAgent.toLowerCase()),$.browser.webkit=/webkit/.test(navigator.userAgent.toLowerCase()),$.browser.opera=/opera/.test(navigator.userAgent.toLowerCase()),$.browser.msie=/msie/.test(navigator.userAgent.toLowerCase()),$.browser.device=/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));var i={prefix:"", suffix:"", affixesStay:!0, thousands:",", decimal:".", precision:2, allowZero:!1, allowNegative:!1, doubleClickSelection:!0, allowEmpty:!1, bringCaretAtEndOnFocus:!0}, o={destroy:function(){return $(this).unbind(".maskMoney"),$.browser.msie&&(this.onpaste=null),this},applyMask:function(e){return t(e,$(this).data("settings"))},mask:function(e){return this.each(function(){var t=$(this);return"number"==typeof e&&t.val(e),t.trigger("mask")})},unmasked:function(){return this.map(function(){var e,t=$(this).val()||"0",n=-1!==t.indexOf("-");return $(t.split(/\D/).reverse()).each(function(t,n){if(n)return e=n,!1}),t=t.replace(/\D/g,""),t=t.replace(new RegExp(e+"$"),"."+e),n&&(t="-"+t),parseFloat(t)})},unmaskedWithOptions:function(){return this.map(function(){var e=$(this).val()||"0",t=$(this).data("settings")||i,n=new RegExp(t.thousandsForUnmasked||t.thousands,"g");return e=e.replace(n,""),parseFloat(e)})},init:function(n){return n=$.extend($.extend({},i),n),this.each(function(){function a(){var e,t,n,a,r,i=x.get(0),o=0,l=0;return"number"==typeof i.selectionStart&&"number"==typeof i.selectionEnd?(o=i.selectionStart,l=i.selectionEnd):(t=document.selection.createRange())&&t.parentElement()===i&&(a=i.value.length,e=i.value.replace(/\r\n/g,"\n"),(n=i.createTextRange()).moveToBookmark(t.getBookmark()),(r=i.createTextRange()).collapse(!1),n.compareEndPoints("StartToEnd",r)>-1?o=l=a:(o=-n.moveStart("character",-a),o+=e.slice(0,o).split("\n").length-1,n.compareEndPoints("EndToEnd",r)>-1?l=a:(l=-n.moveEnd("character",-a),l+=e.slice(0,l).split("\n").length-1))),{start:o,end:l}}function r(){var e=!(x.val().length>=x.attr("maxlength")&&x.attr("maxlength")>=0),t=a(),n=t.start,r=t.end,i=!(t.start===t.end||!x.val().substring(n,r).match(/\d/)),o="0"===x.val().substring(0,1);return e||i||o}function i(e){w.formatOnBlur||x.each(function(t,n){if(n.setSelectionRange)n.focus(),n.setSelectionRange(e,e);else if(n.createTextRange){var a=n.createTextRange();a.collapse(!0),a.moveEnd("character",e),a.moveStart("character",e),a.select()}})}function o(e){var n,a=x.val().length;x.val(t(x.val(),w)),n=x.val().length,w.reverse||(e-=a-n),i(e)}function l(){var e=x.val();if(!w.allowEmpty||""!==e){var n=e.indexOf(w.decimal);if(w.precision>0)if(n<0)e+=w.decimal+new Array(w.precision+1).join(0);else{var a=e.slice(0,n),r=e.slice(n+1);e=a+w.decimal+r+new Array(w.precision+1-r.length).join(0)}else n>0&&(e=e.slice(0,n));x.val(t(e,w))}}function s(){var e=x.val();return w.allowNegative?""!==e&&"-"===e.charAt(0)?e.replace("-",""):"-"+e:e}function c(e){e.preventDefault?e.preventDefault():e.returnValue=!1}function u(e){var t=(e=e||window.event).which||e.charCode||e.keyCode,n=w.decimal.charCodeAt(0);return void 0!==t&&(!(t<48||t>57)||t===n&&w.reverse?!!r()&&((t!==n||!d())&&(!!w.formatOnBlur||(c(e),p(e),!1))):g(t,e))}function d(){return!v()&&f()}function v(){var e=x.val().length,t=a();return 0===t.start&&t.end===e}function f(){return x.val().indexOf(w.decimal)>-1}function p(e){var t,n,r,i,l=(e=e||window.event).which||e.charCode||e.keyCode,s="";l>=48&&l<=57&&(s=String.fromCharCode(l)),n=(t=a()).start,r=t.end,i=x.val(),x.val(i.substring(0,n)+s+i.substring(r,i.length)),o(n+1)}function g(e,t){return 45===e?(x.val(s()),!1):43===e?(x.val(x.val().replace("-","")),!1):13===e||9===e||(!(!$.browser.mozilla||37!==e&&39!==e||0!==t.charCode)||(c(t),!0))}function m(){setTimeout(function(){l()},0)}function h(){return(parseFloat("0")/Math.pow(10,w.precision)).toFixed(w.precision).replace(new RegExp("\\.","g"),w.decimal)}var w,b,x=$(this);w=$.extend({},n),w=$.extend(w,x.data()),x.data("settings",w),$.browser.device&&x.attr("type","tel"),x.unbind(".maskMoney"),x.bind("keypress.maskMoney",u),x.bind("keydown.maskMoney",function(e){var t,n,r,i,l,s=(e=e||window.event).which||e.charCode||e.keyCode;return void 0!==s&&(t=a(),n=t.start,r=t.end,8!==s&&46!==s&&63272!==s||(c(e),i=x.val(),n===r&&(8===s?""===w.suffix?n-=1:(l=i.split("").reverse().join("").search(/\d/),r=1+(n=i.length-l-1)):r+=1),x.val(i.substring(0,n)+i.substring(r,i.length)),o(n),!1))}),x.bind("blur.maskMoney",function(t){if($.browser.msie&&u(t),w.formatOnBlur&&x.val()!==b&&p(t),""===x.val()&&w.allowEmpty)x.val("");else if(""===x.val()||x.val()===e(h(),w))w.allowZero?w.affixesStay?x.val(e(h(),w)):x.val(h()):x.val("");else if(!w.affixesStay){var n=x.val().replace(w.prefix,"").replace(w.suffix,"");x.val(n)}x.val()!==b&&x.change()}),x.bind("focus.maskMoney",function(){b=x.val(),l();var e,t=x.get(0);w.selectAllOnFocus?t.select():t.createTextRange&&w.bringCaretAtEndOnFocus&&((e=t.createTextRange()).collapse(!1),e.select())}),x.bind("click.maskMoney",function(){var e,t=x.get(0);w.selectAllOnFocus||(t.setSelectionRange&&w.bringCaretAtEndOnFocus?(e=x.val().length,t.setSelectionRange(e,e)):x.val(x.val()))}),x.bind("dblclick.maskMoney",function(){var e,t,n=x.get(0);n.setSelectionRange&&w.bringCaretAtEndOnFocus?(t=x.val().length,e=w.doubleClickSelection?0:t,n.setSelectionRange(e,t)):x.val(x.val())}),x.bind("cut.maskMoney",m),x.bind("paste.maskMoney",m),x.bind("mask.maskMoney",l)})}};$.fn.maskMoney=function(e){return o[e]?o[e].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof e&&e?void $.error("Method "+e+" does not exist on jQuery.maskMoney"):o.init.apply(this,arguments)}}(window.jQuery||window.Zepto);
    $(".data").mask("99/99/9999");
    $(".parcela").maskMoney({thousands:'.', decimal:',', prefix:'R$ '});
    var data = new Datepicker("#data");
</script>


    


<div class="rodape r1">
	<h5> ® Crystian Marques 2022. Todos os direitos reservados. </h5>
</div>
</body>
</html>
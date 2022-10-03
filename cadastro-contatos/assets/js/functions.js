
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
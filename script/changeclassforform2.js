function isClass(isclass,istab2="nohave"){
    if(isclass === "have"){
        window.location.href=`form.php?class=columnData&class1=${istab2}`;
    }else{
        window.location.href=`form.php?class1=${istab2}`;
    }

}
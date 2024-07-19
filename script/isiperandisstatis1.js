// const showformout = document.querySelectorAll('#adddata');
const myform = document.querySelector('#myform');
document.querySelector("#addFormperformance").addEventListener('click', () => {
    if(document.querySelector(".modal").classList.contains("isperformance")){
        myform.action = "addprojectonper.php";
    }else if(document.querySelector(".modal").classList.contains("issatisfy")){
        myform.action = "addprojectonsta.php";
    }
    // showformout.forEach((e) => {
    //     if(e.classList.contains('columnData')){
    //         window.location.href = `insert_satis_form.php?class1=firstshow&class=have`;
    //     }else{
    //         window.location.href = `insert_satis_form.php?class1=firstshow`;
    //     }
    // });
    // showformout.forEach((e) => {
    //     if(e.classList.contains('columnData')){
    //         window.location.href = `insert_performance_form.php?class=have`;
    //     }else{
    //         window.location.href = `insert_performance_form.php`;
    //     }
    // });

});
document.querySelector("#addFormsatisfy").addEventListener('click', () => {
    if(document.querySelector(".modal").classList.contains("isperformance")){
        myform.action = "addprojectonper.php";
    }else if(document.querySelector(".modal").classList.contains("issatisfy")){
        myform.action = "addprojectonsta.php";
    }
});

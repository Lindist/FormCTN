// const showformout = document.querySelectorAll('#adddata');
const myform = document.querySelector('#myform');
const title = document.querySelector('.title');
document.querySelector("#addFormperformance").addEventListener('click', () => {
    if(document.querySelector(".modal").classList.contains("isperformance")){
        myform.action = "addprojectonper.php";
    }else if(document.querySelector(".modal").classList.contains("issatisfy")){
        myform.action = "addprojectonsta.php";
    }

});
document.querySelector("#addFormsatisfy").addEventListener('click', () => {
    if(document.querySelector(".modal").classList.contains("isperformance")){
        myform.action = "addprojectonper.php";
    }else if(document.querySelector(".modal").classList.contains("issatisfy")){
        myform.action = "addprojectonsta.php";
    }
});

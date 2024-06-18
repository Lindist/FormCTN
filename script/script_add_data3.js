const formRange = document.querySelector('#check-edit');

formRange.addEventListener('click',showformRange);
const showformout = document.querySelector('#adddata');
console.log(showformout);
/*------------- */
window.onload = function() {
const urlParams = new URLSearchParams(window.location.search);
const classToAdd = urlParams.get('class');
if (classToAdd === 'columnData') {
    document.getElementById('adddata').classList.add(classToAdd);
    document.querySelectorAll('.subform').forEach((e) => {
        e.classList.add(classToAdd);
    });
    if(showformout.classList.contains('columnData')){
        formRange.innerHTML = `<img class='disimg' style='width: 25px;' src="picture/remove.png">`;
    }else{
        formRange.innerHTML = `ตรวจสอบและแก้ไข`;
    }
}
};
/*------------- */
function confirmdel(ids){
    let discon = confirm(`ยืนยันที่จะลบฟอร์มที่${ids[0]}หรือไม่`);
    if(discon === true){
        window.location.href = `delete.php?id=${ids[1]}&id_input=${ids[2]}&id_process=${ids[3]}&id_report=${ids[4]}&id_senrity=${ids[5]}`;
    }
}

/* ------------------------*/
function isaddClass(ids){
    if(showformout.classList.contains('columnData')){
        window.location.href = `ShowallData.php?id=${ids[0]}&id_input=${ids[1]}&id_process=${ids[2]}&id_report=${ids[3]}&id_senrity=${ids[4]}&class=have`;
    }else{
        window.location.href = `ShowallData.php?id=${ids[0]}&id_input=${ids[1]}&id_process=${ids[2]}&id_report=${ids[3]}&id_senrity=${ids[4]}`;
    }
}

/* ------------------------*/

function showformRange(){

    const showform = document.querySelector('#adddata');
    showform.classList.toggle('columnData');
    const changeform = document.querySelectorAll('.subform');
    changeform.forEach((e) => {
        e.classList.toggle('columnData');
    });
    if(showform.classList.contains('columnData')){
        formRange.innerHTML = `<img class='disimg' style='width: 25px;' src="picture/remove.png">`;
    }else{
        formRange.innerHTML = `ตรวจสอบและแก้ไข`;
    }    
}
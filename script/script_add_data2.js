const formRange = document.querySelector('#check-edit');

formRange.addEventListener('click',showformRange);
/*------------- */
window.onload = function() {
const urlParams = new URLSearchParams(window.location.search);
const classToAdd = urlParams.get('class');
if (classToAdd === 'columnData') {
    document.getElementById('adddata').classList.add(classToAdd);
    document.querySelectorAll('.subform').forEach((e) => {
        e.classList.add(classToAdd);
    });
    if(showform.classList.contains('columnData')){
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
    // showform.style.displasy="flex";
    // showform.style.flexDirection="column";
    // showform.style.justifyContent = "flex-start";
    // showform.style.alignItems = "flex-start";
    // showform.style.flexWrap="wrap";
//     showform.classList.remove('form-box');
//     showform.classList.add('grid');
//     showform.insertAdjacentHTML("beforeend",`
//             <div class='container120'>
//             <div class='subform'>
//             <h2>แบบฟอร์มที่ 1</h2>
//             <div class='text'>Lorem ipsum dolor sit amet.</div>
//             <a href='#' id='btn'>ข้อมูล</a>
//             </div>
//             </div>
    
// `);
    
    
}
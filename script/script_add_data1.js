const formRange = document.querySelector('#check-edit');

formRange.addEventListener('click',showformRange);

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
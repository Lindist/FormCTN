const formRange = document.querySelectorAll('#check-edit');
formRange.forEach((f) => {
    f.addEventListener('click',showformRange);
});
const showformout = document.querySelectorAll('#adddata');
/*------------------ */
document.getElementById('addFormperformance').addEventListener('click', () => {
    showformout.forEach((e) => {
        if(e.classList.contains('columnData')){
            window.location.href = `insert_performance_form.php?class=have`;
        }else{
            window.location.href = `insert_performance_form.php`;
        }
    });
});
document.getElementById('addFormsatisfy').addEventListener('click', () => {
    showformout.forEach((e) => {
        if(e.classList.contains('columnData')){
            window.location.href = `insert_satis_form.php?class1=firstshow&class=have`;
        }else{
            window.location.href = `insert_satis_form.php?class1=firstshow`;
        }
    });
});
/*------------- */

/*------------- */
function confirmdel(ids,tab2='false'){
    Swal.fire({
        title: "ลบฟอร์มข้อมูล",
        text: `ยืนยันที่จะลบฟอร์มที่${ids[0]}หรือไม่`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#333",
        confirmButtonText: "ลบ",
        cancelButtonText: "ยกเลิก"
      }).then((result) => {
        if (result.isConfirmed) {
            if(tab2=='false'){
                window.location.href = `delete_performacne_form.php?id=${ids[1]}`;
            }else if(tab2=='true'){
                window.location.href = `delete_satis_form.php?id=${ids[1]}`;
            }
        }
      });
}

/* ------------------------*/
function isaddClass(ids,tab2='false'){
    if(tab2==='false'){
        showformout.forEach((e) => {
            if(e.classList.contains('columnData')){
                window.location.href = `show_performance.php?id=${ids}&class=have`;
            }else{
                window.location.href = `show_performance.php?id=${ids}`;
            }
        });
    }
    else if (tab2==='true'){
        showformout.forEach((e) => {
            if(e.classList.contains('columnData')){
                window.location.href = `show_satis.php?id=${ids}&class=have`;
            }else{
                window.location.href = `show_satis.php?id=${ids}`;
            }
        });
    }
    
}

/* ------------------------*/

function showformRange(){

    const showform = document.querySelectorAll('#adddata');
    showform.forEach((e) => {
        e.classList.toggle('columnData');

        if(e.classList.contains('columnData')){
            formRange.forEach((f) => {
                f.innerHTML = `<img class='disimg' style='width: 25px;' src="picture/remove.png">`;
            });
            
        }else{
            formRange.forEach((f) => {
                f.innerHTML = `ตรวจสอบและแก้ไข`;
            });
        } 
    });
    const changeform = document.querySelectorAll('.subform');
    changeform.forEach((e) => {
        e.classList.toggle('columnData');
    });
    
}
/*--------------------------------------------- */
const tabs = document.querySelectorAll('.tab_btn');
const dropdown1 = document.querySelector('.dropdown');

const linedropdown = document.querySelector('.linedropdown');
const all_content = document.querySelectorAll('.content_box');
const lineclass = document.querySelector('.tab_btn.active > h3');
var line=document.querySelector('.line');
tabs.forEach((tab, index) => {
    tab.addEventListener('click', (e)=>{
        tabs.forEach(tab=>{tab.classList.remove('active')})
        tab.classList.add('active');

        if(tab.classList.contains('dropline')){
            line.style.opacity = "0";
            linedropdown.style.opacity = "1";
            line.style.width = dropdown1.offsetWidth + "px";
            line.style.left = dropdown1.offsetLeft + "px";
        }else{
            line.style.opacity = "1";
            linedropdown.style.opacity = "0";
            linedropdown.style.transition = "all .4s linear";
            line.style.width = e.target.offsetWidth + "px";
            line.style.left = e.target.offsetLeft + "px";
        }

        all_content.forEach(content=>{content.classList.remove('active')});
        all_content[index].classList.add('active');
    })
})

window.onload = function() {
    line.style.width = lineclass.offsetWidth + 'px';
    line.style.left = lineclass.offsetLeft + 'px';

    const urlParams = new URLSearchParams(window.location.search);
    const classToAdd = urlParams.get('class');
    const classToAdd1 = urlParams.get('class1');

    if (classToAdd1 === 'firstshow') {

    const istab2 = document.getElementById('tab2');
    const istab2_1 = document.querySelector('#tab2 h3');

        tabs.forEach(tab=>{tab.classList.remove('active')})
        istab2.classList.add('active');

        all_content.forEach(content=>{content.classList.remove('active')});
        all_content[1].classList.add('active');
        line.style.width = istab2_1.offsetWidth + 'px';
        line.style.left = istab2_1.offsetLeft + 'px';
    }
    if (classToAdd === 'columnData') {

        document.querySelectorAll('#adddata').forEach((e) => {
            e.classList.add(classToAdd);
        });
        document.querySelectorAll('.subform').forEach((e) => {
            e.classList.add(classToAdd);
        });
        showformout.forEach((e) => {
            if(e.classList.contains('columnData')){
                formRange.forEach((f) => {
                    f.innerHTML = `<img class='disimg' style='width: 25px;' src="picture/remove.png">`;
                });
                
            }else{
                formRange.forEach((f) => {
                    f.innerHTML = `ตรวจสอบและแก้ไข`;
                });
            } 
        });
    }
    


};
/*--------------------------------------------- */


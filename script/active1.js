import Tab2Active from "./tabactive.js";
const tab2 = new Tab2Active();

tab2.tab1.addEventListener('click', () => {
    tab2.unActive();
    // console.log(tab2.istab2);
    if(tab2.istab2 === false){
        tab2.tab2.classList.remove('firstshow');
    }
});

tab2.tab2.addEventListener('click', () => {
    tab2.Active();
    // console.log(tab2.istab2);
    if(tab2.istab2 === true){
        tab2.tab2.classList.add('firstshow');
    }
});
const tab3 = document.querySelectorAll('#tab3');
tab3.forEach((e) => {
    e.addEventListener('click', () => {
        tab2.tab2.classList.remove('firstshow');
    });
});

// Function to save input values to local storage
function saveInputValues() {
    if (tab2.tab2.classList.contains('firstshow')) {
        const firstshowtab2 = 'firstshow';
        localStorage.setItem('firstshow', firstshowtab2);
    }else{
        const firstshowtab2 = 'nofirstshow';
        localStorage.setItem('firstshow', firstshowtab2);
    }

    const iscolclass = document.querySelectorAll('#adddata');
    if(iscolclass[0].classList.contains('columnData')){
        localStorage.setItem('columnDatatab1', 'columnData');
    }else{
        localStorage.setItem('columnDatatab1', 'nocolumnData');
    }
    if(iscolclass[1].classList.contains('columnData')){
        localStorage.setItem('columnDatatab2', 'columnData');
    }else{
        localStorage.setItem('columnDatatab2', 'nocolumnData');
    }

    const inputab2 = 'active';
    localStorage.setItem('tab2', inputab2);

    const isdropclass = document.querySelectorAll('.tab_btn.dropline');

    if(isdropclass[0].classList.contains('active')){
        localStorage.setItem('btndropdown1', inputab2);
    }
    else{
        localStorage.setItem('btndropdown1', null);
    }

    if(isdropclass[1].classList.contains('active')){
        localStorage.setItem('btndropdown2', inputab2);
    }
    else{
        localStorage.setItem('btndropdown2', null);
    }


}

// Function to restore input values from local storage
function restoreInputValues() {
    history.pushState(null, '', '/FormCTN/form.php');
    const savedInput1 = localStorage.getItem('tab2');
    const savedInput2 = localStorage.getItem('firstshow');
    const savedInput3_1 = localStorage.getItem('columnDatatab1');
    const savedInput3_2 = localStorage.getItem('columnDatatab2');

    const savedInput4_1 = localStorage.getItem('btndropdown1');
    const savedInput4_2 = localStorage.getItem('btndropdown2');

    if(savedInput4_1 === 'active' || savedInput4_2 === 'active'){
        
        const tabs = document.querySelectorAll('.tab_btn');
        const all_content = document.querySelectorAll('.content_box');
        var line=document.querySelector('.line');
        const dropdown = document.querySelector('.dropdown');
        const options = dropdown.querySelectorAll('.menunavbar li');
        const selected = dropdown.querySelector('.selected');
            
                

        tabs.forEach(tab=>{tab.classList.remove('active')});
        all_content.forEach(content=>{content.classList.remove('active')});
        if(savedInput4_1 === 'active'){
            all_content[2].classList.add('active');
            selected.innerHTML = `<h3> ${options[0].innerText} </h3>`;
                options.forEach(option => {
                    option.classList.remove('activefordropdown');
                });
            options[0].classList.add('activefordropdown');
        }else{
            all_content[3].classList.add('active');
            selected.innerHTML = `<h3> ${options[1].innerText} </h3>`;
                options.forEach(option => {
                    option.classList.remove('activefordropdown');
                });
            options[1].classList.add('activefordropdown');
        }
        line.style.width = dropdown.offsetWidth + "px";
        line.style.left = dropdown.offsetLeft + "px";
    }

    if(savedInput3_1 === 'columnData' || savedInput3_2 === 'columnData'){
        document.querySelectorAll('#adddata').forEach(e => {
            e.classList.add('columnData');
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
        document.querySelectorAll('.subform').forEach(e => {
            e.classList.add('columnData');
        });
    }
    if (savedInput2 === 'firstshow') {
        tab2.tab1.classList.remove('active');
        tab2.tab2.classList.add(savedInput1);
        tab2.tab2.classList.add(savedInput2);
        
        const all_content = document.querySelectorAll('.content_box');
        var line=document.querySelector('.line');
        const istab2_1 = document.querySelector('#tab2 h3');

        all_content.forEach(content=>{content.classList.remove('active')});
        all_content[1].classList.add('active');
        line.style.width = istab2_1.offsetWidth + 'px';
        line.style.left = istab2_1.offsetLeft + 'px';
    }
}

// Event listener to restore input values when the page loads
window.addEventListener('load', restoreInputValues);
// Event listener to save input values before the page unloads (reload or close)
window.addEventListener('beforeunload', saveInputValues);




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
        iscolclass.forEach((e) =>{
            if(e.classList.contains('columnData')){
                localStorage.setItem('columnData', 'columnData');
            } 
    });
    const inputab2 = 'active';
    localStorage.setItem('tab2', inputab2);
}

// Function to restore input values from local storage
function restoreInputValues() {
    history.pushState(null, '', '/from/fixtest/form.php');
    const savedInput1 = localStorage.getItem('tab2');
    const savedInput2 = localStorage.getItem('firstshow');
    const savedInput3 = localStorage.getItem('columnData');
    if (savedInput2 === 'firstshow') {
        tab2.tab1.classList.remove('active');
        tab2.tab2.classList.add(savedInput1);
        tab2.tab2.classList.add(savedInput2);

        if(savedInput3 === 'columnData'){
            alert('have');
        }
        
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




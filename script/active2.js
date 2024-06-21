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



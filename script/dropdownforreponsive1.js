const dropdown = document.querySelector('.responsive');
const headerfordivide = document.querySelector('header'); 
const marforbtnshow = document.querySelectorAll('.container > .btnshow');
dropdown.addEventListener('click', () => {
    document.querySelectorAll('.tab_box')[1].classList.toggle('active');
    document.querySelectorAll('header .responsive .toggle-btn span').forEach(element => {
        element.classList.toggle('spanactive');
    });
    marforbtnshow.forEach((e) =>{
        e.style.marginTop = (headerfordivide.offsetHeight + 8) + "px";
    });
});

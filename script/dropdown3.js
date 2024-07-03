const dropdowns = document.querySelectorAll('.dropdown');
dropdowns.forEach(dropdown => {
    const select = dropdown.querySelector('.select');
    const caret = dropdown.querySelector('.caret');
    const menu = dropdown.querySelector('.menunavbar');
    const options = dropdown.querySelectorAll('.menunavbar li');
    const selected = dropdown.querySelector('.selected');
    let isopen = false;
    select.addEventListener('click', () => {
        caret.classList.toggle('caret-rotate');
        menu.classList.toggle('menu-open');
        isopen = true;
    });

    document.querySelector('#tab1').addEventListener('click', () => {
        if(isopen === true){
            caret.classList.remove('caret-rotate');
            menu.classList.remove('menu-open');
            isopen = false;
        }
    });
    document.querySelector('#tab2').addEventListener('click', () => {
        if(isopen === true){
            caret.classList.remove('caret-rotate');
            menu.classList.remove('menu-open');
            isopen = false;
        }
    });
    

    options.forEach(option => {
        option.addEventListener('click', () => {
            selected.innerHTML = `<h3> ${option.innerText} </h3>`;
            caret.classList.remove('caret-rotate');
            menu.classList.remove('menu-open');
            options.forEach(option => {
                option.classList.remove('activefordropdown');
            });

            option.classList.add('activefordropdown');
        });
    });
});
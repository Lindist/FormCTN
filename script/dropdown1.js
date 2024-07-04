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
        selected.classList.remove('after');
        isopen = true;
    });

    document.querySelector('#tab1').addEventListener('click', () => {
        if(isopen === true){
            caret.classList.remove('caret-rotate');
            menu.classList.remove('menu-open');
            options.forEach(option => {
                option.classList.remove('activefordropdown');
            });
            isopen = false;
        }
        selected.innerHTML = `<h3> เลือกฟอร์มสำหรับกรอก </h3>`;
        selected.classList.remove('after');
    });
    document.querySelector('#tab2').addEventListener('click', () => {
        if(isopen === true){
            caret.classList.remove('caret-rotate');
            menu.classList.remove('menu-open');
            options.forEach(option => {
                option.classList.remove('activefordropdown');
            });
            isopen = false;
        }
        selected.innerHTML = `<h3> เลือกฟอร์มสำหรับกรอก </h3>`;
        selected.classList.remove('after');
    });

    options.forEach(option => {
        option.addEventListener('click', () => {
            selected.innerHTML = `<h3> ${option.innerText} </h3>`;
            selected.classList.add('after');
            let dropdown2 = document.querySelector('.dropdown .select .after');
            let dropdown3 = document.querySelector('.dropdown .select .caret');
            let sumlongline = (dropdown2.offsetWidth + dropdown3.offsetWidth);
            linedropdown.style.width = sumlongline + "px";
            linedropdown.style.left = dropdown2.offsetLeft + "px";
            caret.classList.remove('caret-rotate');
            menu.classList.remove('menu-open');
            options.forEach(option => {
                option.classList.remove('activefordropdown');
            });

            option.classList.add('activefordropdown');
        });
    });
});
const dropdown = document.querySelector('.responsive');
dropdown.addEventListener('click', () => {
    document.querySelector('.tab_box').classList.toggle('active');
    document.querySelector('header .responsive .caret').classList.toggle('caret-rotate');
});
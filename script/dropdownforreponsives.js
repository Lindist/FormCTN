const dropdown = document.querySelector('.responsive');
dropdown.addEventListener('click', () => {
    document.querySelector('.tab_box').classList.toggle('active');
    document.querySelectorAll('header .responsive .toggle-btn span').forEach(element => {
        element.classList.toggle('spanactive');
    });
});
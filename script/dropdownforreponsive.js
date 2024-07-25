const dropdown = document.querySelector('.responsive');
dropdown.addEventListener('click', () => {
    document.querySelectorAll('.tab_box')[1].classList.toggle('active');
    document.querySelectorAll('header .responsive .toggle-btn span').forEach(element => {
        element.classList.toggle('spanactive');
    });
});
// sesion1
const section1add = () => {
    for (let i = 0; i < 4; i++) {
        const row = document.getElementById(`section1tr${i}`);
        const textarea = document.getElementById(`section1tr${i}td`);

        if (row.classList.contains('hidden')) {
            row.classList.remove('hidden');
            textarea.disabled = false;
            break;
        }
    }

    updateButtons();
}

const section1remove = () => {
    for (let i = 3; i >= 0; i--) {
        const row = document.getElementById(`section1tr${i}`);
        const textarea = document.getElementById(`section1tr${i}td`);

        if (!row.classList.contains('hidden')) {
            row.classList.add('hidden');
            textarea.disabled = true;
            break;
        }
    }

    updateButtons();
}

const updateButtons = () => {
    let visibleRows = 0;

    for (let i = 0; i < 4; i++) {
        const textarea = document.getElementById(`section1tr${i}td`);
        if (!document.getElementById(`section1tr${i}`).classList.contains('hidden')) {
            visibleRows++;
            textarea.disabled = false; // Enable textarea when row is visible
        } else {
            textarea.disabled = true; // Disable textarea when row is hidden
        }
    }

    document.getElementById('section1addbtn').classList.toggle('hidden', visibleRows >= 4);
    document.getElementById('section1removebtn').classList.toggle('hidden', visibleRows <= 1);
}

window.onload = updateButtons;

// section1
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

    update1Buttons();
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

    update1Buttons();
}

const update1Buttons = () => {
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

// section2
const section2add = () => {
    for (let i = 0; i < 4; i++) {
        const row = document.getElementById(`section2tr${i}`);
        const textarea = document.getElementById(`section2tr${i}td`);

        if (row.classList.contains('hidden')) {
            row.classList.remove('hidden');
            textarea.disabled = false;
            break;
        }
    }

    update2Buttons();
}

const section2remove = () => {
    for (let i = 3; i >= 0; i--) {
        const row = document.getElementById(`section2tr${i}`);
        const textarea = document.getElementById(`section2tr${i}td`);

        if (!row.classList.contains('hidden')) {
            row.classList.add('hidden');
            textarea.disabled = true;
            break;
        }
    }

    update2Buttons();
}

const update2Buttons = () => {
    let visibleRows = 0;

    for (let i = 0; i < 4; i++) {
        const textarea = document.getElementById(`section2tr${i}td`);
        if (!document.getElementById(`section2tr${i}`).classList.contains('hidden')) {
            visibleRows++;
            textarea.disabled = false; // Enable textarea when row is visible
        } else {
            textarea.disabled = true; // Disable textarea when row is hidden
        }
    }

    document.getElementById('section2addbtn').classList.toggle('hidden', visibleRows >= 4);
    document.getElementById('section2removebtn').classList.toggle('hidden', visibleRows <= 1);
}

// section3
const section3add = () => {
    for (let i = 0; i < 4; i++) {
        const row = document.getElementById(`section3tr${i}`);
        const textarea = document.getElementById(`section3tr${i}td`);

        if (row.classList.contains('hidden')) {
            row.classList.remove('hidden');
            textarea.disabled = false;
            break;
        }
    }

    update3Buttons();
}

const section3remove = () => {
    for (let i = 3; i >= 0; i--) {
        const row = document.getElementById(`section3tr${i}`);
        const textarea = document.getElementById(`section3tr${i}td`);

        if (!row.classList.contains('hidden')) {
            row.classList.add('hidden');
            textarea.disabled = true;
            break;
        }
    }

    update3Buttons();
}

const update3Buttons = () => {
    let visibleRows = 0;

    for (let i = 0; i < 4; i++) {
        const textarea = document.getElementById(`section3tr${i}td`);
        if (!document.getElementById(`section3tr${i}`).classList.contains('hidden')) {
            visibleRows++;
            textarea.disabled = false; // Enable textarea when row is visible
        } else {
            textarea.disabled = true; // Disable textarea when row is hidden
        }
    }

    document.getElementById('section3addbtn').classList.toggle('hidden', visibleRows >= 4);
    document.getElementById('section3removebtn').classList.toggle('hidden', visibleRows <= 1);
}

// section4
const section4add = () => {
    for (let i = 0; i < 4; i++) {
        const row = document.getElementById(`section4tr${i}`);
        const textarea = document.getElementById(`section4tr${i}td`);

        if (row.classList.contains('hidden')) {
            row.classList.remove('hidden');
            textarea.disabled = false;
            break;
        }
    }

    update4Buttons();
}

const section4remove = () => {
    for (let i = 3; i >= 0; i--) {
        const row = document.getElementById(`section4tr${i}`);
        const textarea = document.getElementById(`section4tr${i}td`);

        if (!row.classList.contains('hidden')) {
            row.classList.add('hidden');
            textarea.disabled = true;
            break;
        }
    }

    update4Buttons();
}

const update4Buttons = () => {
    let visibleRows = 0;

    for (let i = 0; i < 4; i++) {
        const textarea = document.getElementById(`section4tr${i}td`);
        if (!document.getElementById(`section4tr${i}`).classList.contains('hidden')) {
            visibleRows++;
            textarea.disabled = false; // Enable textarea when row is visible
        } else {
            textarea.disabled = true; // Disable textarea when row is hidden
        }
    }

    document.getElementById('section4addbtn').classList.toggle('hidden', visibleRows >= 4);
    document.getElementById('section4removebtn').classList.toggle('hidden', visibleRows <= 1);
}

// Initialize buttons for each section on page load
window.onload = () => {
    update1Buttons();
    update2Buttons();
    update3Buttons();
    update4Buttons();

    // document.getElementById('section1addbtn').addEventListener('click', section1add);
    // document.getElementById('section1removebtn').addEventListener('click', section1remove);

    // document.getElementById('section2addbtn').addEventListener('click', section2add);
    // document.getElementById('section2removebtn').addEventListener('click', section2remove);

    // document.getElementById('section3addbtn').addEventListener('click', section3add);
    // document.getElementById('section3removebtn').addEventListener('click', section3remove);

    // document.getElementById('section4addbtn').addEventListener('click', section4add);
    // document.getElementById('section4removebtn').addEventListener('click', section4remove);
}

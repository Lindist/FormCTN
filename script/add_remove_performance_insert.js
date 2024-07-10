
//section1 add button
const section1add = () => {
    const section1tr1 = document.getElementById('section1tr1');
    const section1tr2 = document.getElementById('section1tr2');
    const section1tr3 = document.getElementById('section1tr3');
    const section1addbtn = document.getElementById('section1addbtn');
    const section1removebtn = document.getElementById('section1removebtn');
    const textarea1 = document.getElementById('section1tr1td');
    const textarea2 = document.getElementById('section1tr2td');
    const textarea3 = document.getElementById('section1tr3td');
    const textarea1f = document.getElementById('section1tr1tdf');
    const textarea2f = document.getElementById('section1tr2tdf');
    const textarea3f = document.getElementById('section1tr3tdf');

    if (section1tr1.classList.contains('hidden')) {
        section1tr1.classList.remove('hidden');
        textarea1.disabled = false;
        textarea1f.disabled = false;
    } else if (section1tr2.classList.contains('hidden')) {
        section1tr2.classList.remove('hidden');
        textarea2.disabled = false;
        textarea2f.disabled = false;
    } else if (section1tr3.classList.contains('hidden')) {
        section1tr3.classList.remove('hidden');
        textarea3.disabled = false;
        textarea3f.disabled = false;
    }

    if (!section1tr1.classList.contains('hidden')) {
        section1removebtn.classList.remove('hidden');
    }

    if (!section1tr3.classList.contains('hidden')) {
        section1addbtn.classList.add('hidden');
    }
}

// section1 remove button
const section1remove = () => {
    const section1tr1 = document.getElementById('section1tr1');
    const section1tr2 = document.getElementById('section1tr2');
    const section1tr3 = document.getElementById('section1tr3');
    const section1addbtn = document.getElementById('section1addbtn');
    const section1removebtn = document.getElementById('section1removebtn');
    const textarea1 = document.getElementById('section1tr1td');
    const textarea2 = document.getElementById('section1tr2td');
    const textarea3 = document.getElementById('section1tr3td');
    const textarea1f = document.getElementById('section1tr1tdf');
    const textarea2f = document.getElementById('section1tr2tdf');
    const textarea3f = document.getElementById('section1tr3tdf');

    if (!section1tr3.classList.contains('hidden')) {
        section1tr3.classList.add('hidden');
        textarea3.disabled = true;
        textarea3f.disabled = true;
    } else if (!section1tr2.classList.contains('hidden')) {
        section1tr2.classList.add('hidden');
        textarea2.disabled = true;
        textarea2f.disabled = true;
    } else if (!section1tr1.classList.contains('hidden')) {
        section1tr1.classList.add('hidden');
        textarea1.disabled = true;
        textarea1f.disabled = true;
    }
    
    if (section1tr1.classList.contains('hidden')) {
        section1removebtn.classList.add('hidden');
    }

    if (section1tr3.classList.contains('hidden')) {
        section1addbtn.classList.remove('hidden');
    }
}

//section2 add button
const section2add = () => {
    const section2tr1 = document.getElementById('section2tr1');
    const section2tr2 = document.getElementById('section2tr2');
    const section2tr3 = document.getElementById('section2tr3');
    const section2addbtn = document.getElementById('section2addbtn');
    const section2removebtn = document.getElementById('section2removebtn');
    const textarea1 = document.getElementById('section2tr1td');
    const textarea2 = document.getElementById('section2tr2td');
    const textarea3 = document.getElementById('section2tr3td');
    const textarea1f = document.getElementById('section2tr1tdf');
    const textarea2f = document.getElementById('section2tr2tdf');
    const textarea3f = document.getElementById('section2tr3tdf');

    if (section2tr1.classList.contains('hidden')) {
        section2tr1.classList.remove('hidden');
        textarea1.disabled = false;
        textarea1f.disabled = false;
    } else if (section2tr2.classList.contains('hidden')) {
        section2tr2.classList.remove('hidden');
        textarea2.disabled = false;
        textarea2f.disabled = false;
    } else if (section2tr3.classList.contains('hidden')) {
        section2tr3.classList.remove('hidden');
        textarea3.disabled = false;
        textarea3f.disabled = false;
    }

    if (!section2tr1.classList.contains('hidden')) {
        section2removebtn.classList.remove('hidden');
    }

    if (!section2tr3.classList.contains('hidden')) {
        section2addbtn.classList.add('hidden');
    }
}

//section2 remove button
const section2remove = () => {
    const section2tr1 = document.getElementById('section2tr1');
    const section2tr2 = document.getElementById('section2tr2');
    const section2tr3 = document.getElementById('section2tr3');
    const section2addbtn = document.getElementById('section2addbtn');
    const section2removebtn = document.getElementById('section2removebtn');
    const textarea1 = document.getElementById('section2tr1td');
    const textarea2 = document.getElementById('section2tr2td');
    const textarea3 = document.getElementById('section2tr3td');
    const textarea1f = document.getElementById('section2tr1tdf');
    const textarea2f = document.getElementById('section2tr2tdf');
    const textarea3f = document.getElementById('section2tr3tdf');

    if (!section2tr3.classList.contains('hidden')) {
        section2tr3.classList.add('hidden');
        textarea3.disabled = true;
        textarea3f.disabled = true;
    } else if (!section2tr2.classList.contains('hidden')) {
        section2tr2.classList.add('hidden');
        textarea2.disabled = true;
        textarea2f.disabled = true;
    } else if (!section2tr1.classList.contains('hidden')) {
        section2tr1.classList.add('hidden');
        textarea1.disabled = true;
        textarea1f.disabled = true;
    }

    if (section2tr1.classList.contains('hidden')) {
        section2removebtn.classList.add('hidden');
    }

    if (section2tr3.classList.contains('hidden')) {
        section2addbtn.classList.remove('hidden');
    }
}

//section3 add button
const section3add = () => {
    const section3tr1 = document.getElementById('section3tr1');
    const section3tr2 = document.getElementById('section3tr2');
    const section3tr3 = document.getElementById('section3tr3');
    const section3addbtn = document.getElementById('section3addbtn');
    const section3removebtn = document.getElementById('section3removebtn');
    const textarea1 = document.getElementById('section3tr1td');
    const textarea2 = document.getElementById('section3tr2td');
    const textarea3 = document.getElementById('section3tr3td');
    const textarea1f = document.getElementById('section3tr1tdf');
    const textarea2f = document.getElementById('section3tr2tdf');
    const textarea3f = document.getElementById('section3tr3tdf');

    if (section3tr1.classList.contains('hidden')) {
        section3tr1.classList.remove('hidden');
        textarea1.disabled = false;
        textarea1f.disabled = false;
    } else if (section3tr2.classList.contains('hidden')) {
        section3tr2.classList.remove('hidden');
        textarea2.disabled = false;
        textarea2f.disabled = false;
    } else if (section3tr3.classList.contains('hidden')) {
        section3tr3.classList.remove('hidden');
        textarea3.disabled = false;
        textarea3f.disabled = false;
    }

    if (!section3tr1.classList.contains('hidden')) {
        section3removebtn.classList.remove('hidden');
    }

    if (!section3tr3.classList.contains('hidden')) {
        section3addbtn.classList.add('hidden');
    }
}

//section3 remove button
const section3remove = () => {
    const section3tr1 = document.getElementById('section3tr1');
    const section3tr2 = document.getElementById('section3tr2');
    const section3tr3 = document.getElementById('section3tr3');
    const section3addbtn = document.getElementById('section3addbtn');
    const section3removebtn = document.getElementById('section3removebtn');
    const textarea1 = document.getElementById('section3tr1td');
    const textarea2 = document.getElementById('section3tr2td');
    const textarea3 = document.getElementById('section3tr3td');
    const textarea1f = document.getElementById('section3tr1tdf');
    const textarea2f = document.getElementById('section3tr2tdf');
    const textarea3f = document.getElementById('section3tr3tdf');

    if (!section3tr3.classList.contains('hidden')) {
        section3tr3.classList.add('hidden');
        textarea3.disabled = true;
        textarea3f.disabled = true;
    } else if (!section3tr2.classList.contains('hidden')) {
        section3tr2.classList.add('hidden');
        textarea2.disabled = true;
        textarea2f.disabled = true;
    } else if (!section3tr1.classList.contains('hidden')) {
        section3tr1.classList.add('hidden');
        textarea1.disabled = true;
        textarea1f.disabled = true;
    }

    if (section3tr1.classList.contains('hidden')) {
        section3removebtn.classList.add('hidden');
    }

    if (section3tr3.classList.contains('hidden')) {
        section3addbtn.classList.remove('hidden');
    }
}

//section4 add button
const section4add = () => {
    const section4tr1 = document.getElementById('section4tr1');
    const section4tr2 = document.getElementById('section4tr2');
    const section4tr3 = document.getElementById('section4tr3');
    const section4addbtn = document.getElementById('section4addbtn');
    const section4removebtn = document.getElementById('section4removebtn');
    const textarea1 = document.getElementById('section4tr1td');
    const textarea2 = document.getElementById('section4tr2td');
    const textarea3 = document.getElementById('section4tr3td');
    const textarea1f = document.getElementById('section4tr1tdf');
    const textarea2f = document.getElementById('section4tr2tdf');
    const textarea3f = document.getElementById('section4tr3tdf');

    if (section4tr1.classList.contains('hidden')) {
        section4tr1.classList.remove('hidden');
        textarea1.disabled = false;
        textarea1f.disabled = false;
    } else if (section4tr2.classList.contains('hidden')) {
        section4tr2.classList.remove('hidden');
        textarea2.disabled = false;
        textarea2f.disabled = false;
    } else if (section4tr3.classList.contains('hidden')) {
        section4tr3.classList.remove('hidden');
        textarea3.disabled = false;
        textarea3f.disabled = false;
    }

    if (!section4tr1.classList.contains('hidden')) {
        section4removebtn.classList.remove('hidden');
    }

    if (!section4tr3.classList.contains('hidden')) {
        section4addbtn.classList.add('hidden');
    }
}

//section4 remove button
const section4remove = () => {
    const section4tr1 = document.getElementById('section4tr1');
    const section4tr2 = document.getElementById('section4tr2');
    const section4tr3 = document.getElementById('section4tr3');
    const section4addbtn = document.getElementById('section4addbtn');
    const section4removebtn = document.getElementById('section4removebtn');
    const textarea1 = document.getElementById('section4tr1td');
    const textarea2 = document.getElementById('section4tr2td');
    const textarea3 = document.getElementById('section4tr3td');
    const textarea1f = document.getElementById('section4tr1tdf');
    const textarea2f = document.getElementById('section4tr2tdf');
    const textarea3f = document.getElementById('section4tr3tdf');

    if (!section4tr3.classList.contains('hidden')) {
        section4tr3.classList.add('hidden');
        textarea3.disabled = true;
        textarea3f.disabled = true;
    } else if (!section4tr2.classList.contains('hidden')) {
        section4tr2.classList.add('hidden');
        textarea2.disabled = true;
        textarea2f.disabled = true;
    } else if (!section4tr1.classList.contains('hidden')) {
        section4tr1.classList.add('hidden');
        textarea1.disabled = true;
        textarea1f.disabled = true;
    }

    if (section4tr1.classList.contains('hidden')) {
        section4removebtn.classList.add('hidden');
    }

    if (section4tr3.classList.contains('hidden')) {
        section4addbtn.classList.remove('hidden');
    }
}
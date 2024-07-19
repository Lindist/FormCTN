for(let i =1;i<=10;i++){
    document.querySelector(".dropdownforaddpriject .list").insertAdjacentHTML("beforeend", `
        <input type="radio" name="drop1" id="idp${i}" class="radio1_p" />
        <label for="idp${i}">
            <span class="numberp">${i}</span>
        </label>
    `);
}
let countdel = 0;
document.querySelector(".btncrease").addEventListener('click', () => {
    let creaseValue = document.querySelector('.input-box').textContent
    creaseValue = parseInt(creaseValue, 10)
    for(let i =0;i<creaseValue;i++){
    document.querySelector(".modal-content .containerformodal").insertAdjacentHTML("beforeend", `
        <div id="delthis" style="margin: 0 0 2rem 0;">
            <hr style="border-width: 0.7mm; margin: 2rem 0;">
            <label for="pname"><b>ชื่อโครงการ</b></label>
            <input type="text" placeholder="ชื่อโครงการ...." name="pname" required>
            <label for=""><b>วันหมดอายุ</b></label><br>
            <input type="text" name="expired[]" id="d${(i+1+countdel).toString()}" class="datepicker" placeholder="วันหมดอายุ...." value="" required><br>
            <label for=""><b>ระดับการศึกษา</b></label>

                <div class="dropdownforaddintro">
                    <div class="input-box"></div>
                <div class="list">
                    <input type="radio" name="drop1" id="id11" class="radio" />
                    <label for="id11">
                    <span class="material-symbols-outlined">person</span>
                        <span class="name">ปวช.</span>
                    </label>

                    <input type="radio" name="drop1" id="id12" class="radio" />
                    <label for="id12">
                    <span class="material-symbols-outlined">person_4</span>
                        <span class="name">ปวส.</span>
                    </label>
                    </div>
                </div>

                <label for=""><b>ปีการศึกษา</b></label>

                <div class="dropdownforaddintro">
                    <div class="input-box"></div>
                <div class="list">
                    <input type="radio" name="drop1" id="id14" class="radio1" />
                    <label for="id14">
                        <span class="namedate"></span>
                    </label>

                    <input type="radio" name="drop1" id="id15" class="radio1" />
                    <label for="id15">
                        <span class="namedate"></span>
                    </label>

                    <input type="radio" name="drop1" id="id16" class="radio1" />
                    <label for="id16">
                        <span class="namedate"></span>
                    </label>
                    </div>
                </div>
                <button type="button" id="btnfordeldataout" class="cancelbtn">ลบ</button>
            </div>
    `);
    countdel++;
}
// console.log(creaseValue)
// console.log(del);
// console.log(data);

    // for(let c=0;c<countdel;c++){
    //     document.querySelectorAll("#btnfordeldataout")[c].addEventListener('click', () => {
    //         document.querySelectorAll("#delthis")[c].remove();
    //     })
    // }
})
// document.querySelector(".dropdownforaddpriject .list").classList.add("after");
for(let i =1;i<=10;i++){
    document.querySelector(".dropdownforaddproject .list").insertAdjacentHTML("beforeend", `
        <input type="radio" name="drop0" id="idp${i}" class="radio1_p" />
        <label for="idp${i}">
            <span class="numberp">${i}</span>
        </label>
    `);
}
let year = new Date().getFullYear()+543;
let increasecountdel = 0;
let countid = 0;
document.querySelector(".btncrease").addEventListener('click', () => {
    let creaseValue = document.querySelector('.dropdownforaddproject > .input-box').textContent
    creaseValue = parseInt(creaseValue, 10)
    for(let i =0;i<creaseValue;i++){
    countid += 1;
    document.querySelector(".modal-content .containerformodal .tab_content_for_project").insertAdjacentHTML("beforeend", `
        <div id="delthis" class="openbtn" style="margin: 0 0 2rem 0;">
            <hr style="border-width: 0.7mm; margin: 2rem 0;">
            <label for="pname"><b>ชื่อโครงการ</b></label>
            <input type="text" placeholder="ชื่อโครงการ...." name="pname[]" required>
            <label for=""><b>วันหมดอายุ</b></label><br>
            <input type="text" name="expired[]" id="d${(countid).toString()}" class="datepicker" placeholder="วันหมดอายุ...." value="" required><br>
            <label for=""><b>ระดับการศึกษา</b></label>

                <div class="dropdownforaddintro">
                    <input type="text" placeholder="เลือกตัวเลือกที่ต้องการ..." name="level_edu[]" class="input-box input-box${(countid).toString()}" value="ปวช." readonly>
                <div class="list">
                    <input type="radio" name="drop1${(countid).toString()}" id="id1${(countid).toString()}" class="radio radio_${(countid).toString()}" />
                    <label for="id1${(countid).toString()}">
                    <span class="material-symbols-outlined">person</span>
                        <span class="name id1${(countid).toString()}" id="">ปวช.</span>
                    </label>

                    <input type="radio" name="drop1${(countid).toString()}" id="id12${(countid).toString()}" class="radio radio_${(countid).toString()}" />
                    <label for="id12${(countid).toString()}">
                    <span class="material-symbols-outlined">person_4</span>
                        <span class="name id12${(countid).toString()}" id="">ปวส.</span>
                    </label>
                    </div>
                </div>

                <label for=""><b>ปีการศึกษา</b></label>

                <div class="dropdownforaddintro">
                    <input type="text" placeholder="เลือกตัวเลือกที่ต้องการ..." name="year_edu[]" class="input-box input-boxY${(countid).toString()}" value="${year.toString()}" readonly>
                <div class="list">
                    <input type="radio" name="drop2${(countid).toString()}" id="id14${(countid).toString()}" class="radio1 radio1${(countid).toString()}" />
                    <label for="id14${(countid).toString()}">
                        <span class="namedate id14${(countid).toString()}" id=""></span>
                    </label>

                    <input type="radio" name="drop2${(countid).toString()}" id="id15${(countid).toString()}" class="radio1 radio1${(countid).toString()}" />
                    <label for="id15${(countid).toString()}">
                        <span class="namedate id15${(countid).toString()}" id=""></span>
                    </label>

                    <input type="radio" name="drop2${(countid).toString()}" id="id16${(countid).toString()}" class="radio1 radio1${(countid).toString()}" />
                    <label for="id16${(countid).toString()}">
                        <span class="namedate id16${(countid).toString()}" id=""></span>
                    </label>
                    </div>
                </div>
                <button type="button" id="btnfordeldataout" class="cancelbtn">ลบ</button>
                </div>
    `);

    // console.log(document.querySelectorAll("#btnfordeldataout")[countdel])
    // console.log(document.querySelectorAll("#delthis")[countdel])
}
// console.log(creaseValue)
// console.log(del);
// console.log("GAY");
let countdel = document.querySelectorAll(".openbtn").length;
increasecountdel += countdel;
for(let c = 0;c<countdel;c++){
    let del = "#delthis";
    let delbtn = "#btnfordeldataout";
    let thisdel = document.querySelectorAll(del)[c];
    let btndel = document.querySelectorAll(delbtn)[c];
    btndel.addEventListener('click', () => {
        thisdel.remove();
        increasecountdel--;
        Swal.fire({
            position: "top-end",
            width: "25em",
            icon: "success",
            title: "ลบเรียบร้อยแล้ว",
            showConfirmButton: false,
            timer: 1000
          });          
        if(increasecountdel<=0){
              document.querySelector("#btnform").classList.add("d-none");
        }
        // console.log(increasecountdel)
    })
    
}
})
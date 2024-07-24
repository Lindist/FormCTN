Editproject = (idp) => {
    const checkid = "editpro" + idp.toString();
    const editManager = document.querySelectorAll(".editManager");
    document.querySelectorAll(".isEdit").forEach((e,index) => {
        if(e.id === checkid){
            let pname = e.querySelectorAll("#p1");
            editManager[index].classList.add("editColor");
            e.innerHTML = `
            <div for="" style="text-align: center; width: 100%;"><h3>หน้าแก้ไข</h3></div>
            <div for="" style="text-align: center; width: 100%;" class="alertedit">#เมื่ออยู่หน้าแก้ไขจะไม่สามารถแก้ไขข้อมูลส่วนอื่นได้จนกว่าจะกดยืนยันหรือยกเลิกการแก้ไขข้อมูล!!!</div><br>
            <label for="" style="color: red; font-size: 20px;"><b>*</b></label>
            <label for=""><b>ชื่อโครงการ</b></label>
            <input type="text" id="p1" class="p1" value="${pname[0].value}">
            <label for="" style="color: red; font-size: 20px;"><b>*</b></label>
            <label for=""><b>วันหมดอายุ</b></label><br>
            <input type="text" id="pdate${idp}" class="p1" value="${pname[1].value}">
            <label for="" style="color: red; font-size: 20px;"><b>*</b></label>
            <label for=""><b>ระดับการศึกษา</b></label><br>
            <div class="dropdownforaddintro">
            <input type="text" id="p1" class="input-editbox input-boxA${idp} p1" value="${pname[2].value}" readonly>
                <div class="list1">
                    <input type="radio" name="dropD${idp}" id="ideditA${idp}" class="radio7 radio_A${idp}" />
                    <label for="ideditA${idp}">
                    <span class="material-symbols-outlined">person</span>
                        <span class="name ideditA${idp}" id="">ปวช.</span>
                    </label>

                    <input type="radio" name="dropD${idp}" id="idedit1A${idp}" class="radio7 radio_A${idp}" />
                    <label for="idedit1A${idp}">
                    <span class="material-symbols-outlined">person_4</span>
                        <span class="name idedit1A${idp}" id="">ปวส.</span>
                    </label>
                </div>
            </div>
            <label for="" style="color: red; font-size: 20px;"><b>*</b></label>
            <label for=""><b>ปีการศึกษา</b></label><br>
            <div class="dropdownforaddintro">
                <input type="text" id="p1" class="input-editbox input-boxB${idp} p1" value="${pname[3].value}" readonly>
                <div class="list1">
                        <input type="radio" name="dropE${idp}" id="idedit14${idp}" class="radio8 radioB${idp}" />
                        <label for="idedit14${idp}">
                            <span class="namedate1 idedit14${idp}" id=""></span>
                        </label>

                        <input type="radio" name="dropE${idp}" id="idedit15${idp}" class="radio8 radioB${idp}" />
                        <label for="idedit15${idp}">
                            <span class="namedate1 idedit15${idp}" id=""></span>
                        </label>

                        <input type="radio" name="dropE${idp}" id="idedit16${idp}" class="radio8 radioB${idp}" />
                        <label for="idedit16${idp}">
                            <span class="namedate1 idedit16${idp}" id=""></span>
                        </label>
                </div>
            </div>
            `;
        }
    });
    let year1 = new Date().getFullYear();
    let fixednum1 = 0;
    document.querySelectorAll(".namedate1").forEach((e) => {
        if(fixednum1 < 3){
            e.textContent = year1+(fixednum1 -1)+543;
            e.value = year1+(fixednum1 -1)+543;
            fixednum1++;
        }
        else{
            fixednum1 = 0;
            e.textContent = year1+(fixednum1 -1)+543;
            e.value = year1+(fixednum1 -1)+543;
            fixednum1++;
        }
    })
    const input_1 = document.querySelectorAll(".input-editbox");
    let list_1 = document.querySelectorAll(".list1");
    for(let i = 0;i < input_1.length;i++){
            input_1[i].addEventListener('click', () => {
            input_1[i].classList.toggle("open");
              if (list_1[i].style.maxHeight) {
                  list_1[i].style.maxHeight = null;
                  list_1[i].style.boxShadow = null;
              } else {
                  list_1[i].style.maxHeight = list_1[i].scrollHeight + "px";
                  list_1[i].style.boxShadow =
                  "0 1px 2px 0 rgba(0, 0, 0, 0.15),0 1px 3px 1px rgba(0, 0, 0, 0.1)";
              }
        
        });
      
    }
    let addrad2 = ".radio_A" + idp.toString();
    let addrad3 = ".radioB" + idp.toString();

    var rad2 = document.querySelectorAll(addrad2);
    var rad3 = document.querySelectorAll(addrad3);

    let addinputrad2 = ".input-boxA"+ idp.toString();
    let addinputrad3 = ".input-boxB" + idp.toString();

    rad2.forEach((item) => {
        item.addEventListener("change", () => {
          let x1 = "." + item.id;
          var inputrad2 = document.querySelector(addinputrad2);
          inputrad2.value = document.querySelector(x1).textContent;
          inputrad2.click();
        })
    });
      
      
      
    rad3.forEach((item) => {
        item.addEventListener("change", () => {
            let x1 = "." + item.id; 
            var inputrad3 = document.querySelector(addinputrad3);
            inputrad3.value = document.querySelector(x1).textContent;
            inputrad3.click();
        })
    });


}
cancelEditproject = (idp,name,expired,leveledu,yearedu) => {
    const checkid = "editpro" + idp.toString();
    const editManager = document.querySelectorAll(".editManager");
    document.querySelectorAll(".isEdit").forEach((e,index) => {
        if(e.id === checkid){
            editManager[index].classList.remove("editColor");
            e.innerHTML = `
            <label for=""><b>ชื่อโครงการ</b></label>
            <input type="text" id="p1" value="${name}" readonly>
            <div>
                <button type="button" class="confirmbtn" id="addper_" onclick="nextToper()">เพิ่มแบบฟอร์มประเมินประสิทธิภาพ</button>
                <button type="button" class="confirmbtn" id="addsta_" onclick="nextTosta()">เพิ่มแบบฟอร์มประเมินความพึงพอใจ</button>
            </div>
            <label for=""><b>วันหมดอายุ</b></label><br>
            <input type="hidden" name="" id="p1" value="${expired}">
            <input type="text" id="" value="${expired}" readonly>
            <label for=""><b>ระดับการศึกษา</b></label><br>
            <input type="text" id="p1" value="${leveledu}" readonly>
            <label for=""><b>ปีการศึกษา</b></label><br>
            <input type="text" id="p1" value="${yearedu}" readonly>
            `;
        }
    });
}

Editformcomfirm = (idp) =>{
    let pname = document.querySelectorAll(".p1");
    let str = "update_project.php?pro_id=" + idp.toString();
    let arr = ["&name=","&expired=","&leveledu=","&yearedu="]
    pname.forEach((e,i) => {
        str += arr[i] + e.value.toString()
    })
    window.location.href = str;
}
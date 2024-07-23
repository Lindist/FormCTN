Editproject = (idp) => {
    const checkid = "editpro" + idp.toString();
    document.querySelectorAll(".isEdit").forEach((e) => {
        if(e.id === checkid){
            let pname = e.querySelectorAll("#p1");
            e.innerHTML = `
            <label for=""><b>หน้าแก้ไข</b></label><br>
            <label for=""><b>ชื่อโครงการ</b></label>
            <input type="text" id="p1" value="${pname[0].value}">
            <label for=""><b>วันหมดอายุ</b></label><br>
            <input type="text" id="pdate${idp}" value="${pname[1].value}">
            <label for=""><b>ระดับการศึกษา</b></label><br>
            <input type="text" id="p1" value="${pname[2].value}">
            <label for=""><b>ปีการศึกษา</b></label><br>
            <input type="text" id="p1" value="${pname[3].value}">
            `;
        }
    });
    // console.log(idp)
}
cancelEditproject = (idp) => {
    const checkid = "editpro" + idp.toString();
    document.querySelectorAll(".isEdit").forEach((e) => {
        if(e.id === checkid){
            let pname = e.querySelectorAll("#p1");
            let pex = "#pdate" + idp.toString();
            let expired = e.querySelector(pex);
            e.innerHTML = `
            <label for=""><b>ชื่อโครงการ</b></label>
            <input type="text" id="p1" value="${pname[0].value}" readonly>
            <div>
                <button type="button" class="confirmbtn" id="addper_">เพิ่มแบบฟอร์มประเมินประสิทธิภาพ</button>
                <button type="button" class="confirmbtn" id="addsta_">เพิ่มแบบฟอร์มประเมินความพึงพอใจ</button>
            </div>
            <label for=""><b>วันหมดอายุ</b></label><br>
            <input type="hidden" name="" id="p1" value="${expired.value}">
            <input type="text" id="" value="${expired.value}" readonly>
            <label for=""><b>ระดับการศึกษา</b></label><br>
            <input type="text" id="p1" value="${pname[1].value}" readonly>
            <label for=""><b>ปีการศึกษา</b></label><br>
            <input type="text" id="p1" value="${pname[2].value}" readonly>
            `;
        }
    });
    // console.log(idp)
}
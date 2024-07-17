const searchInput = document.querySelectorAll("[data-search]")
searchInput.forEach((childsearch,indexchild) => {

    let indexedform = "#data" + indexchild.toString()
    let without_data_all = `[without-data${indexchild.toString()}]`
    let disimg = `.disimg${indexchild.toString()}`
    const data = document.querySelectorAll(indexedform);
    let form = []
    childsearch.addEventListener("input", (e) => {
        const value = e.target.value.toLowerCase()
        const isVisiblearr = []

        form.forEach((f,i) => {
            const isVisible = f.name.toLowerCase().includes(value)
            isVisiblearr.push(isVisible)
            data[i].classList.toggle("d-none", !isVisible)
            })
        const decideisshow = isVisiblearr.filter(e=>e===true)
        if(!decideisshow[0]){
            document.querySelectorAll(disimg).forEach(element => {
                element.style.display = "none";
            });   
            document.querySelectorAll(without_data_all).forEach(ew => {    
                ew.insertAdjacentHTML("beforeend",`
                    <div class='disimg' style="place-self: center; position: absolute; left: 50%; transform: translateX(-50%);">
                    <img class='disimg' style="position: relative; left: 50%; transform: translateX(-50%); width: 10rem; height: 10rem;" src="picture/empty-folder.png">
                    <h3 class='disimg' style="text-align: center;">ไม่มีข้อมูลแบบสอบถาม</h3>
                    </div>
                    `  );
                }) 
        }
        else{
            document.querySelectorAll(".disimg").forEach(element => {
                element.style.display = "block";
            });
            document.querySelectorAll(without_data_all + " > .disimg").forEach(ew => { ew.remove(); })
        }
        
    })

    data.forEach(element => {
        const header = element.querySelector(".text").textContent
        form.push({name: header})
        
    });
    // console.log(form)
})
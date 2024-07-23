const tabs12 = document.querySelectorAll(".tab_btn_pro");
const all_content12 = document.querySelectorAll(".tab_content_for_project");
tabs12.forEach((tab,index) => {
    tab.addEventListener('click', () => {
        tabs12.forEach(tab=>{tab.classList.remove('active')})
        tab.classList.add('active');
        
        all_content12.forEach(content=>{content.classList.remove('active')});
        all_content12[index].classList.add('active');
    })
})
tabs12[1].addEventListener('click', () => {
    document.querySelector("#btnform").classList.add("d-none");
})
tabs12[0].addEventListener('click', () => {
    if(document.querySelectorAll(".openbtn").length > 0){
        document.querySelector("#btnform").classList.remove("d-none");
    }
})

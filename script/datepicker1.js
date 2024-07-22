// let d = new Date();
// console.log(d)
// let day22 = ;
document.querySelector(".btncrease").addEventListener('click', () => {
let day = new Date().getDate();
let moth = new Date().getMonth()+1;
let year = new Date().getFullYear();
// console.log(year)
let mothstr = ""
let daystr = ""
if(moth < 10){
    mothstr = "0"+moth.toString();
}else{
    mothstr = moth.toString();
}
if(day < 10){
    daystr = "0"+day.toString();
}else{
    daystr = day.toString();
}

let today = `${daystr}/${mothstr}/${(year+543).toString()}`;
document.querySelectorAll(".datepicker").forEach(e => {
    e.value = today;
})
// console.log(moment(new Date()).format("YYYY-MM-DD-dddd"));
// console.log(` ${year-1}-${year}-${year+1}`);

let fixednum = 0;
document.querySelectorAll(".namedate").forEach((e) => {
    if(fixednum < 3){
        e.textContent = year+(fixednum -1)+543;
        e.value = year+(fixednum -1)+543;
        fixednum++;
    }
    else{
        fixednum = 0;
        e.textContent = year+(fixednum -1)+543;
        e.value = year+(fixednum -1)+543;
        fixednum++;
    }
})
// console.log(document.querySelectorAll(".namedate"))
})
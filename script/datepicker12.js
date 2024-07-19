// let d = new Date();
// console.log(d)
// let day22 = ;
let day = new Date().getDate();
let moth = new Date().getMonth()+1;
let year = new Date().getFullYear();
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

let today = `${(year+543).toString()}-${mothstr}-${daystr}`;
document.getElementById("date-time").value = today;
// console.log(moment(new Date()).format("YYYY-MM-DD-dddd"));
// console.log(` ${year-1}-${year}-${year+1}`);
document.querySelectorAll(".namedate").forEach((e,i) => {
    e.value = year+(i-1)+543
    e.textContent = year+(i-1)+543
})
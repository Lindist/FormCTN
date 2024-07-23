let count = 1;
let countforradio = new Array(0,0);

document.querySelector(".btncrease").addEventListener('click', () => {
const input = document.querySelectorAll(".input-box");
let list = document.querySelectorAll(".list");

let creaseValue2 = document.querySelector('.dropdownforaddproject > .input-box').textContent
creaseValue2 = parseInt(creaseValue2, 10)

for(let i = 1;i < input.length;i++){
  if(i >= count){
    count++;
    input[i].addEventListener('click', () => {
      input[i].classList.toggle("open");
        if (list[i].style.maxHeight) {
            list[i].style.maxHeight = null;
            list[i].style.boxShadow = null;
        } else {
            list[i].style.maxHeight = list[i].scrollHeight + "px";
            list[i].style.boxShadow =
            "0 1px 2px 0 rgba(0, 0, 0, 0.15),0 1px 3px 1px rgba(0, 0, 0, 0.1)";
        }
  
    });
  }

}

for(let i =0;i<creaseValue2;i++){

countforradio[0]++;
let addrad = ".radio" + "_" + countforradio[0].toString();
let addrad1 = ".radio1" + countforradio[0].toString();
var rad = document.querySelectorAll(addrad);
var rad1 = document.querySelectorAll(addrad1);


let addinputrad = ".input-box"+ countforradio[0].toString();
let addinputrad1 = ".input-boxY" + countforradio[0].toString();
// addinputrad.push();
// addinputrad1.push();


// console.log(addinputrad)
// console.log(addinputrad1)
// console.log("KUY")


rad.forEach((item) => {
  item.addEventListener("change", () => {
    let x = "." + item.id; 
    var inputrad = document.querySelector(addinputrad);
    inputrad.value = document.querySelector(x).textContent;
    inputrad.click();
    // console.log(2)
  })
  // console.log(1)
});



  rad1.forEach((item) => {
    item.addEventListener("change", () => {
        let x = "." + item.id; 
        var inputrad1 = document.querySelector(addinputrad1);
        inputrad1.value = document.querySelector(x).textContent;
        inputrad1.click();
        // console.log(2)
      })
    // console.log(1)
  });
  // countforradio[1]+=1;
}
})

const inputadd = document.querySelectorAll(".input-box")[0];
const listadd = document.querySelectorAll(".list")[0];

inputadd.addEventListener('click', () => {
  inputadd.classList.toggle("open");
    if (listadd.style.maxHeight) {
        listadd.style.maxHeight = null;
        listadd.style.boxShadow = null;
    } else {
        listadd.style.maxHeight = listadd.scrollHeight + "px";
        listadd.style.boxShadow =
         "0 1px 2px 0 rgba(0, 0, 0, 0.15),0 1px 3px 1px rgba(0, 0, 0, 0.1)";
    }
});



var rad1_p = document.querySelectorAll(".radio1_p");
rad1_p.forEach((item) => {
    item.addEventListener("change", () => {
      inputadd.innerHTML = item.nextElementSibling.innerHTML;
      inputadd.click();
    });
});
document.querySelector(".btncrease").addEventListener('click', () => {
const input = document.querySelectorAll(".input-box");
let list = document.querySelectorAll(".list");

input.forEach((item,i) => {
  item.addEventListener('click', function () {
    item.classList.add("open");
      if (list[i].style.maxHeight) {
          list[i].style.maxHeight = null;
          list[i].style.boxShadow = null;
      } else {
          list[i].style.maxHeight = list[i].scrollHeight + "px";
          list[i].style.boxShadow =
          "0 1px 2px 0 rgba(0, 0, 0, 0.15),0 1px 3px 1px rgba(0, 0, 0, 0.1)";
      }

  });
})
console.log(input);
console.log(list);

// const input = document.querySelectorAll(".input-box");


// var rad = document.querySelectorAll(".radio");
// var rad1 = document.querySelectorAll(".radio1");
// var rad1_p = document.querySelectorAll(".radio1_p");

// // if(document.querySelector(".dropdownforaddpriject .list").classList.contains("after")){
//   rad1_p.forEach((item) => {
//     item.addEventListener("change", () => {
//         input[0].innerHTML = item.nextElementSibling.innerHTML;
//         input[0].click();
//     });
//   });

// // }


// rad.forEach((item) => {
//   item.addEventListener("change", () => {
//       input[1].innerHTML = item.nextElementSibling.innerHTML;
//       input[1].click();
//   });
// });

// rad1.forEach((item) => {
//   item.addEventListener("change", () => {
//       input[2].innerHTML = item.nextElementSibling.innerHTML;
//       input[2].click();
//   });
// });

})
var input = document.querySelectorAll(".input-box");
let list = document.querySelectorAll(".list");

  input[0].addEventListener('click', function () {
    input[0].classList.toggle("open");
      if (list[0].style.maxHeight) {
          list[0].style.maxHeight = null;
          list[0].style.boxShadow = null;
      } else {
          list[0].style.maxHeight = list[0].scrollHeight + "px";
          list[0].style.boxShadow =
          "0 1px 2px 0 rgba(0, 0, 0, 0.15),0 1px 3px 1px rgba(0, 0, 0, 0.1)";
      }

  });
  input[1].addEventListener('click', function () {
    input[1].classList.toggle("open");
      if (list[1].style.maxHeight) {
          list[1].style.maxHeight = null;
          list[1].style.boxShadow = null;
      } else {
          list[1].style.maxHeight = list[1].scrollHeight + "px";
          list[1].style.boxShadow =
          "0 1px 2px 0 rgba(0, 0, 0, 0.15),0 1px 3px 1px rgba(0, 0, 0, 0.1)";
      }
      

  });

var rad = document.querySelectorAll(".radio");
var rad1 = document.querySelectorAll(".radio1");
rad.forEach((item) => {
  item.addEventListener("change", () => {
      input[0].innerHTML = item.nextElementSibling.innerHTML;
      input[0].click();
  });
});

rad1.forEach((item) => {
  item.addEventListener("change", () => {
      input[1].innerHTML = item.nextElementSibling.innerHTML;
      input[1].click();
  });
});
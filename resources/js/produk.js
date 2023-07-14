// const optionMenu = document.querySelector(".select-menu"),
//     selectBtn = optionMenu.querySelector(".select-btn"),
//     options = optionMenu.querySelectorAll(".option"),
//     sBtn_text = optionMenu.querySelector(".sBtn-text");

// selectBtn.addEventListener("click", () => optionMenu.classList.toggle("active"));

// options.forEach(option => {
//     option.addEventListener("click", () => {
//         let selectedOption = option.querySelector(".option-text").innerText;
//         sBtn_text.innerText = selectedOption;

//         optionMenu.classList.remove("active");
//     });
// })

const optionMenu = document.querySelector(".select-menu");
const selectBtn = optionMenu.querySelector(".select-btn");
const options = optionMenu.querySelectorAll(".option");
const sBtn_text = optionMenu.querySelector(".sBtn-text");

selectBtn.addEventListener("click", () => optionMenu.classList.toggle("active"));

options.forEach(option => {
    option.addEventListener("click", () => {
        let selectedOption = option.querySelector(".option-text").innerText;
        let selectedValue = option.querySelector(".option-text").getAttribute("data-value");

        sBtn_text.innerText = selectedOption;
        sBtn_text.setAttribute("data-value", selectedValue);

        optionMenu.classList.remove("active");
        console.log(selectedValue);
        window.location.href = '/Produk/' + selectedValue;

    });
});

// document.addEventListener('DOMContentLoaded', function() {
//     var optionList = document.getElementById('option-list');
//     optionList.addEventListener('change', function() {
//         var selectedOption = optionList.querySelector('.option-text:checked');
//         var selectedValue = selectedOption.getAttribute('value');

//         // Mengirim nilai ke rute dengan metode GET
//         window.location.href = '/produk/' + selectedValue;
//     });
// });

// document.addEventListener('DOMContentLoaded', function() {
//     var optionList = document.getElementsByClassName('option-text');
//     for (var i = 0; i < optionList.length; i++) {
//         optionList[i].addEventListener('click', function() {
//             var selectedValue = this.getAttribute('data-value');
//             // Mengirim nilai ke rute dengan metode GET
//             window.location.href = '/produk/' + selectedValue;
//         });
//     }
// });


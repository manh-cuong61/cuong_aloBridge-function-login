// let btns = document.querySelectorAll(".el");
// for(let i = 0; i < btns.length; i++) {
//     btns[i].addEventListener("click", function(){
//         current = document.querySelector(".acctive");
//         if(current) {
//             current.classList.remove("acctive");
//         }
//         btns[i].classList.add("acctive");
//     });
// };

let pic = document.querySelector("#picture")

function readURL(input) {
    if (input.files[0]) {
        console.log(input.files[0]);
        var reader = new FileReader();
        reader.onload = function () {
            pic.setAttribute('src', reader.result);  
        };

        reader.readAsDataURL(input.files[0]);
    }
}

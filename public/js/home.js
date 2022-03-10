let btns = document.querySelectorAll(".el");
for(let i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function(){
        current = document.querySelector(".acctive");
        if(current) {
            current.classList.remove("acctive");
        }
        btns[i].classList.add("acctive");
    });
}

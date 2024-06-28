const showcnt = document.getElementById("nav-cnt");
const showadd = document.getElementById("nav-add");
const showprsnl = document.getElementById("nav-prsnl");

const divcnt = document.getElementById("cnt");
const divadd = document.getElementById("add");
const divprsnl = document.getElementById("prsnl"); 

function dsply(displaydiv){
    cnt.style.display = "none";
    add.style.display = "none";
    prsnl.style.display = "none";
    displaydiv.style.display = "block";
}

showcnt.addEventListener('click', function(){
    dsply(divcnt);
})

showadd.addEventListener('click', function(){
    dsply(divadd);
})

showprsnl.addEventListener('click', function(){
    dsply(divprsnl);
})

dsply(divcnt);


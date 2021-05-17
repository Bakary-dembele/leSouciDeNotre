let slideIndexs = 0;
let sliders = document.querySelector(".sliderNews");
let slidess = document.querySelector(".slidesNews");
let slides = document.querySelectorAll(".slideNews");
let dotss = document.querySelectorAll(".dotss span")

showslides();

function plusslide(position) {
    slideIndexs += position;

    if (slideIndexs > slides.length) {
        slideIndexs = 1;
    }
    else if (slideIndexs < 1) {
        slideIndexs = slides.length;
    }

    // Defaultly active class is removed from all dots
    for (let i = 0; i < dotss.length; i++) {
        const element = dotss[i];
        element.classList.remove("dot-active");
    }

    slidess.style.left = `-${slideIndexs - 1}00%`;
    dotss[slideIndexs - 1].classList.add("dot-active");
}

function currentslide(index) {
    if (index > slides.length) {
        index = 1;
    }
    else if (index < 1) {
        index = slides.length;
    }

    // Defaultly active class is removed from all dots
    for (let i = 0; i < dotss.length; i++) {
        const element = dotss[i];
        element.classList.remove("dot-active");
    }

    slidess.style.left = `-${index - 1}00%`;
    dotss[index - 1].classList.add("dot-active");

    slideIndexs = index;
}

function showslides() {
    slideIndexs++;

    if (slideIndexs > slides.length) {
        slideIndexs = 1;
    }
    else if (slideIndexs < 1) {
        slideIndexs = slides.length;
    }

    // Defaultly active class is removed from all dots
    for (let i = 0; i < dotss.length; i++) {
        const element = dotss[i];
        element.classList.remove("dot-active");
    }

    slidess.style.left = `-${slideIndexs - 1}00%`;
    dotss[slideIndexs - 1].classList.add("dot-active");
}


let interval = setInterval(()=> {
    showslides();
} , 3000);   // Change every image after 3 seconds

sliders.addEventListener("mouseover" , ()=> {
    clearInterval(interval);     // onHover Stop Changing every image after 3 seconds
});

sliders.addEventListener("mouseout" , ()=> {
    interval = setInterval(()=> {
        showslides();
    } , 3000);    // on mouseout from slide then again start Changing every image after 3  seconds
});


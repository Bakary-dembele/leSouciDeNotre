let slideIndex = 0;
let slider = document.querySelector(".sliderNew");
let slides = document.querySelector(".slidesNew");
let slide = document.querySelectorAll(".slideNew");
let dots = document.querySelectorAll(".dot span")

showslide();

function plusslide(position) {
    slideIndex += position;

    if (slideIndex > slide.length) {
        slideIndex = 1;
    }
    else if (slideIndex < 1) {
        slideIndex = slide.length;
    }

    // Defaultly active class is removed from all dots
    for (let i = 0; i < dots.length; i++) {
        const element = dots[i];
        element.classList.remove("dot-active");
    }

    slides.style.left = `-${slideIndex - 1}00%`;
    dots[slideIndex - 1].classList.add("dot-active");
}

function currentslide(index) {
    if (index > slide.length) {
        index = 1;
    }
    else if (index < 1) {
        index = slide.length;
    }

    // Defaultly active class is removed from all dots
    for (let i = 0; i < dots.length; i++) {
        const element = dots[i];
        element.classList.remove("dot-active");
    }

    slides.style.left = `-${index - 1}00%`;
    dots[index - 1].classList.add("dot-active");

    slideIndex = index;
}

function showslide() {
    slideIndex++;

    if (slideIndex > slide.length) {
        slideIndex = 1;
    }
    else if (slideIndex < 1) {
        slideIndex = slide.length;
    }

    // Defaultly active class is removed from all dots
    for (let i = 0; i < dots.length; i++) {
        const element = dots[i];
        element.classList.remove("dot-active");
    }

    slides.style.left = `-${slideIndex - 1}00%`;
    dots[slideIndex - 1].classList.add("dot-active");
}


let interval = setInterval(()=> {
    showslide();
} , 3000);   // Change every image after 3 seconds

slider.addEventListener("mouseover" , ()=> {
    clearInterval(interval);     // onHover Stop Changing every image after 3 seconds
});

slider.addEventListener("mouseout" , ()=> {
    interval = setInterval(()=> {
        showslide();
    } , 3000);    // on mouseout from slide then again start Changing every image after 3  seconds
});


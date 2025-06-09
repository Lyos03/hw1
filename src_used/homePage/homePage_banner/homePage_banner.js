let slideIndex = 1;

showSlides(slideIndex);

function nextSlide() {
    showSlides(slideIndex += 1);
}

function prevSlide() {
    showSlides(slideIndex -= 1)
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    const slidesList = document.querySelectorAll(".banner_container");
    const progressList=document.querySelectorAll(".banner_slideIndex_progress");
    if (n > slidesList.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slidesList.length }

    for (let slide of slidesList) {
        enableHidden(slide);
    }
    for(let progress of progressList){
        progress.classList.add("progress_inactive");
    }

    disableHidden(slidesList[slideIndex - 1]);
    let current_progress=progressList[slideIndex -1];
    current_progress.classList.remove("progress_inactive");
    current_progress.classList.add("progress_active");
}

const prevButton = document.querySelector("#banner_arrow_prev");
prevButton.addEventListener("click", prevSlide);

const nextButton = document.querySelector("#banner_arrow_next");
nextButton.addEventListener("click", nextSlide);

let allCircleItems;
let allCheckboxItems;
let allTextItems;
let allPathItems;
let allLabelBoxItems;


function collectProgressItems() {
    allCircleItems = document.querySelectorAll('.progress-circle');
    allCheckboxItems = document.querySelectorAll('.progress-checkbox');
    allTextItems = document.querySelectorAll('.progress-text');
    allPathItems = document.querySelectorAll('.progress-path');
    allLabelBoxItems = document.querySelectorAll('.progress-label-box');
}

function handleProgressNumber(step) {
    const listOfNumber = Array.from(allTextItems);
    const listOfLabelBoxes = Array.from(allLabelBoxItems);

    listOfNumber.forEach((number, index) => {
        number.classList.remove('show-number');     
        allCircleItems[index].classList.remove('step-circle-border-orange');

        if(step === index) {
            number.classList.add('show-number');
            allLabelBoxItems[index]?.classList.add('step-circle-border-orange'); 
        }
    });

    listOfLabelBoxes.forEach((box, index) => {
        box.classList.remove('show-label-box');
        if(step === index) {
            box.classList.add('show-label-box');
        }
    });
}

function handleProgressCheckbox(step) {
    const listOfCheckbox = Array.from(allCheckboxItems);
    const listOfCircles = Array.from(allCircleItems);
    const listOfPath = Array.from(allPathItems);

    listOfCheckbox.forEach((checkbox, index) => {
        checkbox.classList.remove('show-checkbox');     
        if(step > index) {
            checkbox.classList.add('show-checkbox');
        }
    });

    listOfCircles.forEach((circle, index) => {
        circle.classList.remove('step-circle-fill-green');             
        if(step > index) {
            circle.classList.add('step-circle-fill-green');     
        }
    });

    listOfPath.forEach((path, index) => {
        path.setAttribute('stroke', `#314C65`);
        path.classList.remove('step-path-fill-green');     

        if(step > index + 1) {
            path.classList.add('step-path-fill-green');     
        }

        if(step === index + 1) {
            path.setAttribute('stroke', `url(#gradient${index + 1})`);
        }
    });
}

function removeProgressBar() {
    const progressBar = document.querySelector('.hot-or-not-progress-bar-svg');
    if (progressBar) {
        progressBar.style.display = 'none';
    }
}

function removeadvertisementBanner() {
    const advertisementBanner = document.querySelectorAll('.add-banner-card');
    if (advertisementBanner) {
        advertisementBanner.forEach(banner => banner.style.display = 'none')
    }
}

function addAdvertisementBanner() {
    const advertisementBanner = document.querySelectorAll('.add-banner-card');
    if (advertisementBanner) {
        advertisementBanner.forEach(banner => banner.style.display = 'block')
    }
}

export { collectProgressItems, handleProgressNumber, handleProgressCheckbox, removeProgressBar, removeadvertisementBanner, addAdvertisementBanner };
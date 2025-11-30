// SVG Progress Items
let allCircleItems;
let allCheckboxItems;
let allTextItems;
let allPathItems;
let allLabelBoxItems; // For label boxes

console.log("radi");

function collectProgressItems() {
    allCircleItems = document.querySelectorAll('.progress-circle');
    allCheckboxItems = document.querySelectorAll('.progress-checkbox');
    allTextItems = document.querySelectorAll('.progress-text');
    allPathItems = document.querySelectorAll('.progress-path');
    allLabelBoxItems = document.querySelectorAll('.progress-label-box'); // Collect label boxes
}

function handleProgressNumber(step) {
    const listOfNumber = Array.from(allTextItems);
    const listOfLabelBoxes = Array.from(allLabelBoxItems);

    listOfNumber.forEach((number, index) => {
        number.classList.remove('show-number');     
        allCircleItems[index].classList.remove('step-circle-border-orange');

        if(step === index) {
            number.classList.add('show-number');
            allLabelBoxItems[index]?.classList.add('step-circle-border-orange'); // Safe check
            // allPathItems[index]?.setAttribute('style', 'display:none'); // Hide path for current step
        }
    });

    // Show only current step's label box
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

    // Checkboxes
    listOfCheckbox.forEach((checkbox, index) => {
        checkbox.classList.remove('show-checkbox');     
        if(step > index) {
            checkbox.classList.add('show-checkbox');
        }
    });

    // Circles
    listOfCircles.forEach((circle, index) => {
        circle.classList.remove('step-circle-fill-green');             
        if(step > index) {
            circle.classList.add('step-circle-fill-green');     
        }
    });

    // Paths
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
    const advertisementBanner = document.querySelector('.single_blog_banner_holder');
    if (advertisementBanner) {
        advertisementBanner.style.display = 'none';
    }
}

// Initialize when DOM is loaded
collectProgressItems();

// Example usage - set5 to step 2 (third step)
handleProgressNumber(0);
handleProgressCheckbox(0);

export { collectProgressItems, handleProgressNumber, handleProgressCheckbox, removeProgressBar, removeadvertisementBanner };

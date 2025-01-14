// SVG Progress Items
let allCircleItems;
let allCheckboxItems;
let allTextItems;
let allPathItems;

function collectProgressItems() {
    allCircleItems = document.querySelectorAll('.progress-circle');
    allCheckboxItems = document.querySelectorAll('.progress-checkbox');
    allTextItems = document.querySelectorAll('.progress-text');
    allPathItems = document.querySelectorAll('.progress-path');
    
}

function handleProgressNumber(step) {
    let listOfNumber = Array.from(allTextItems);

    listOfNumber.forEach((number, index) => {
        number.classList.remove('show-number');     
        allCircleItems[index].classList.remove('step-circle-border-orange');
        if(step === index) {
            number.classList.add('show-number');
            allCircleItems[index].classList.add('step-circle-border-orange');
            return;
        }
    });
}

function handleProgressCheckbox(step) {
    let listOfCheckbox = Array.from(allCheckboxItems);
    let listOfCircles = Array.from(allCircleItems);
    let listOfPath = Array.from(allPathItems);

    listOfCheckbox.forEach((checkbox, index) => {
        checkbox.classList.remove('show-checkbox');     
        if(step > index) {
            checkbox.classList.add('show-checkbox');;
        }
    });
    listOfCircles.forEach((circle, index) => {
        circle.classList.remove('step-circle-fill-green');             
        if(step > index) {
            circle.classList.add('step-circle-fill-green');     
        }
    });
    listOfPath.forEach((path, index) => {
        // path.classList.remove('step-path-fill-orange');     
        // path.removeAttribute(stroke)
        path.setAttribute('stroke', `#314C65`)
        path.classList.remove('step-path-fill-green');     
        
        if(step > index + 1) {
            // path.classList.remove('step-path-fill-orange');     
            // path.removeAttribute(stroke)
            path.classList.add('step-path-fill-green');     
        }

        if(step === index + 1) {
            path.setAttribute('stroke', `url(#gradient${index + 1})`)
            // path.classList.add('step-path-fill-orange');     
        }
    });
}

function removeProgressBar() {
    const progressBar = document.querySelector('.progress-bar');

    if (progressBar) {
        progressBar.style.display = 'none';
    }
}


export { collectProgressItems, handleProgressNumber, handleProgressCheckbox, removeProgressBar };
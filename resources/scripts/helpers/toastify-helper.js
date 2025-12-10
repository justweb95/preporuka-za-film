import Toastify from 'toastify-js';
import 'toastify-js/src/toastify.css'; // Importing CSS for Toastify


// Toster
function showToast(message, duration) {
  Toastify({
    text: message,
    duration: 3000,
    gravity: 'top', 
    position: 'right', 
    stopOnFocus: true,
    style: {
      background: "linear-gradient(90deg, #172938 70%, #172938 100%)",
      fontFamily: "Red Hat Display",
      fontSize: "16px",
    }
  }).showToast();
}

export { showToast };
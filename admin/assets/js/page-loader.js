// console.log('api page is loaded');
function showNotification(message, type = 'success') {
  const container = document.getElementById('notification-container');
  const notification = document.createElement('div');
  notification.className = `notification ${type}`;
  notification.textContent = message;
  container.appendChild(notification);

  // Show notification
  setTimeout(() => {
      notification.classList.add('show');
  }, 100);

  // Hide and remove notification after 3 seconds
  setTimeout(() => {
      notification.classList.remove('show');
      setTimeout(() => {
          container.removeChild(notification);
      }, 500); // Match the transition duration
  }, 3000);
}



function checkNetworkSpeed() {
  if ('connection' in navigator) {
    const connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
    const effectiveType = connection.effectiveType;
    
    // Check if the connection is slow
    if (effectiveType === '2g' || effectiveType === 'slow-2g' || effectiveType === '3g') {
      const lastShown = localStorage.getItem('networkSpeed');
      const now = Date.now();

      // Only show notification if it hasn't been shown in the last hour (3600000 ms)
      if (!lastShown || now - lastShown > 3600000) {
        showNotification3('⚠️ Your connection is slow. Some features might not work as expected.', 'info');
        localStorage.setItem('networkSpeed', now);
      }
    }
  }
}

window.addEventListener('load', checkNetworkSpeed);

// function checkNetworkSpeed() {
//   if ('connection' in navigator) {
//     const connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
//     const effectiveType = connection.effectiveType;
//     // console.log(effectiveType);
//     if (effectiveType === '2g' || effectiveType === 'slow-2g' || effectiveType === '3g') {
//       showNotification3('⚠️ Your connection is slow. Some features might not work as expected.', 'info',true); // Show notification
//       // showNotification3('You are back online.', 'success', true);
//     }
//   }
// }
// window.addEventListener('load', checkNetworkSpeed); // Check network speed when the page loads

let offlineNotification; // To hold the offline notification element
let wasOffline = false; // Flag to track if the user was previously offline

// Function to show notifications
function showNotification3(message, type = 'success', autoHide = true) {
  const container = document.getElementById('notification-container');
  const notification = document.createElement('div');
  notification.className = `notification ${type}`;
  notification.textContent = message;
  container.appendChild(notification);
  
  // Show notification
  setTimeout(() => {
    notification.classList.add('show');
  }, 100);

  // Auto-hide logic for online notification
  if (autoHide) {
    setTimeout(() => {
      notification.classList.remove('show');
      setTimeout(() => {
        container.removeChild(notification);
      }, 500); // Match the transition duration
    }, 5000); // Notification duration (5 seconds)
  } else {
    offlineNotification = notification; // Keep track of the offline notification
  }
}


document.addEventListener("DOMContentLoaded", function () {
    const progressBar = document.querySelector(".progress-bar");
    
    let progress = 0;
    const interval = setInterval(function () {
      progress += 1; // Adjust the increment as needed
      progressBar.style.width = progress + "%";
      if (progress >= 100) {
        clearInterval(interval);
        setTimeout(function () {
          document.querySelector(".progress-container").style.display = "none";
        }, 200); // Adjust the delay as needed
      }
    }, 50); // Adjust the interval as needed
  });



  // Function to update connection status
function updateConnectionStatus() {
  if (!navigator.onLine) {
    // Handle offline status
    document.body.classList.add('offline');
    if (!offlineNotification) { // Ensure no duplicate offline notifications
      showNotification3('⚠️ You are offline. Please check your internet connection.', 'info', false);
    }
    wasOffline = true; // Mark that the user is offline
  } else {
    // Handle online status
    document.body.classList.remove('offline');
    if (offlineNotification) {
      // Remove offline notification when back online
      offlineNotification.classList.remove('show');
      setTimeout(() => {
        offlineNotification.remove();
        offlineNotification = null; // Reset offline notification tracking
      }, 500); // Match the transition duration
    }

    // Show "back online" notification only if the user was previously offline
    if (wasOffline) {
      showNotification3('You are back online.', 'success', true);
      wasOffline = false; // Reset the flag as the user is now online
    }
  }
}

// Listen for online and offline events
window.addEventListener('online', updateConnectionStatus);
window.addEventListener('offline', updateConnectionStatus);

// Initial check on page load
window.addEventListener('load', () => {
  // On page load, only check for offline status
  if (!navigator.onLine) {
    updateConnectionStatus();
  }
});
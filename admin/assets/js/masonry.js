document.addEventListener("DOMContentLoaded", function() {
    const gallery = document.querySelector('.gallery');
    const images = JSON.parse(gallery.getAttribute('data-images'));  // Get images from data attribute
  
    // Check the images array
    console.log(images);  // Ensure it's an array of valid paths
    
    const popup = document.getElementById("imagePopup");
    const popupImage = document.getElementById("popupImage");
    const closeBtn = document.getElementById("closePopup");
    const nextBtn = document.getElementById("nextBtn");
    const prevBtn = document.getElementById("prevBtn");
  
    let currentIndex = 0; // Track the currently displayed image
  
    // When an image is clicked, display the larger version in the popup
    document.querySelectorAll('.popup-trigger').forEach((img, index) => {
      img.addEventListener('click', () => {
        console.log("Clicked image index:", index); // Check index
        currentIndex = index;  // Set the current index
        if (currentIndex >= images.length || currentIndex < 0) {
          currentIndex = 0;  // Ensure the index is within bounds
        }
        console.log("Current Image Path:", images[currentIndex]);  // Check the image path
        popupImage.src = images[currentIndex];  // Set the image source in the popup
        popup.style.display = "flex";  // Show the popup
      });
    });
  
    // Close the popup when the close button is clicked
    closeBtn.addEventListener('click', () => {
      popup.style.display = "none";  // Hide the popup
    });
  
    // Show the next image in the popup
    nextBtn.addEventListener('click', () => {
      currentIndex = (currentIndex + 1) % images.length;  // Loop back to the first image if at the end
      console.log("Next Image Path:", images[currentIndex]);  // Check the image path
      popupImage.src = images[currentIndex];  // Update the image
    });
  
    // Show the previous image in the popup
    prevBtn.addEventListener('click', () => {
      currentIndex = (currentIndex - 1 + images.length) % images.length;  // Loop to the last image if at the start
      console.log("Previous Image Path:", images[currentIndex]);  // Check the image path
      popupImage.src = images[currentIndex];  // Update the image
    });
  });
  
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
// Format number as Nigerian currency (₦)
function formatCurrency(amount) {
    return new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN' }).format(amount);
}

// Apply formatting to all elements with class "price"
function formatAllPrices() {
    $('.price').each(function () {
        var priceText = $(this).text().replace(/[₦,]/g, ''); // Remove existing commas and ₦
        $(this).text(formatCurrency(priceText));
    });
}

function copyButton() {
    $('.copyButton').click(function () {
        // $(document).on('click', '.copyButton', function() {
        let textToCopy = $(this).data('link');
        let info = $(this).data('info');
        let tempInput = $('<input>');
        $('body').append(tempInput);
        tempInput.val(textToCopy).select();
        document.execCommand('copy');
        tempInput.remove();
        // alert('Copied: ' + textToCopy);
        showNotification(info, 'info');
    });
}

$(document).ready(function () {
    formatAllPrices(); // Ensure all prices are formatted
    copyButton();

});

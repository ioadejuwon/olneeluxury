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

function formatCompactCurrency(amount) {
    amount = parseFloat(amount);
    if (isNaN(amount)) return ''; // Prevent display of 'NaN' or '₦NaN'

    let formattedAmount;
    if (amount >= 1000000000) {
        formattedAmount = (amount / 1000000000).toFixed(1).replace(/\.0$/, '') + 'B';
    } else if (amount >= 1000000) {
        formattedAmount = (amount / 1000000).toFixed(1).replace(/\.0$/, '') + 'M';
    } else if (amount >= 1000) {
        formattedAmount = (amount / 1000).toFixed(1).replace(/\.0$/, '') + 'K';
    }else if (amount < 1000) {
        formattedAmount = (amount).toFixed(2).replace(/\.0$/, '');
    } else {
        formattedAmount = amount;
    }

    return '₦' + formattedAmount;
}

function formatPrices() {
    $('.priceAll').each(function () {
        var priceText = $(this).text().replace(/[₦,]/g, '').trim(); // Clean ₦, commas, spaces
        var formatted = formatCompactCurrency(priceText);

        // Debugging
        console.log('Original:', $(this).text(), '| Cleaned:', priceText, '| Formatted:', formatted);

        // Apply if valid
        // if (formatted !== '') {
        //     $(this).text(formatted);
        // }
        $(this).text(formatted);

        
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
    formatPrices(); // Ensure all prices are formatted
    // setTimeout(formatAllPrices, 500); // Slight delay in case prices are dynamically loaded
    copyButton();

});

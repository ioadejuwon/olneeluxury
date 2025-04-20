
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
        formattedAmount = (amount / 1000000000).toFixed(2).replace(/\.0$/, '') + 'B';
    } else if (amount >= 1000000) {
        formattedAmount = (amount / 1000000).toFixed(2).replace(/\.0$/, '') + 'M';
    } else if (amount >= 1000) {
        formattedAmount = (amount / 1000).toFixed(2).replace(/\.0$/, '') + 'K';
    } else if (amount < 1000) {
        formattedAmount = (amount).toFixed(2).replace(/\.0$/, '');
    } else {
        formattedAmount = amount;
    }

    console.log('Original: ', amount, '| Cleaned:', '| Formatted:', formattedAmount);
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



function getLastPathSegment() {
    const pathSegments = window.location.pathname.split('/').filter(Boolean);
    return pathSegments.length > 0 ? pathSegments[pathSegments.length - 1] : 'home';
}

function hasVisitedRecently(key, expirationTime = 120000) {
    const visitData = localStorage.getItem(key);
    const now = Date.now();

    if (visitData) {
        const parsed = JSON.parse(visitData);
        return (now - parsed.timestamp) < expirationTime;
    }
    return false;
}

// function markVisit(key) {
//     localStorage.setItem(key, JSON.stringify({ timestamp: Date.now() }));
// }

// function trackVisit() {
//     const backhalf = getLastPathSegment();
//     const visitKey = 'visited_' + backhalf;

//     if (!hasVisitedRecently(visitKey)) {
//         fetch('admin/inc/storevisits.php?ref=' + encodeURIComponent(backhalf))
//             .then(response => {
//                 if (response.ok) {
//                     console.log('Tracked visit:', backhalf);
//                     markVisit(visitKey);
//                 } else {
//                     console.error('Failed to track visit.');
//                 }
//             })
//             .catch(error => {
//                 console.error('Error:', error);
//             });
//     } else {
//         console.log('Visit already tracked recently:', backhalf);
//     }
// }

// Run it on page load
// document.addEventListener("DOMContentLoaded", trackVisit);


// document.addEventListener("DOMContentLoaded", function () {
//     const banner = document.getElementById("scrollingMessage");
//     const closeBtn = document.getElementById("closeBanner");

//     // Check if banner was closed within the past hour
//     const hideUntil = localStorage.getItem("olnee_hideBannerUntil");
//     const now = new Date().getTime();

//     if (hideUntil && now < parseInt(hideUntil)) {
//       banner.style.display = "none";
//     }

//     closeBtn.addEventListener("click", function () {
//       banner.style.display = "none";
//       const oneHourLater = now + 3600000; // 1 hour in ms
//       localStorage.setItem("olnee_hideBannerUntil", oneHourLater);
//     });
//   });

function capitalizeEachWordByClass(className) {
    // console.log('I got heeree...')
    const elements = document.querySelectorAll(`.${className}`);

    elements.forEach(element => {
        element.textContent = element.textContent
            .split(' ')
            .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase())
            .join(' ');
    });
}

$(document).ready(function () {
    // trackVisit(); // Track the visit
    formatAllPrices(); // Ensure all prices are formatted
    formatPrices(); // Ensure all prices are formatted
    // setTimeout(formatAllPrices, 500); // Slight delay in case prices are dynamically loaded
    copyButton();

    capitalizeEachWordByClass('capitalize-each');

    // $('.close-btn-notification').on('click', function () {
    //     $('.scrolling-message').fadeOut();
    // });
});

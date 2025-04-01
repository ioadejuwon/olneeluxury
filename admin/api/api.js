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

$(document).ready(function() {

    $('.copyButton').click(function() {
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
});

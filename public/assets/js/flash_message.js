let message = document.getElementsByClassName('flash')[0];

if (message) {
    message.style.top = "0";
    setTimeout(() => {
        message.style.top = "-10em";
    }, 4000);
    setTimeout(() => {
        message.remove();
    }, 5000)
}
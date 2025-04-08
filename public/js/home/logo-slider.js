const logosContainer = document.querySelector('.logos');

if (logosContainer) {
    const logosWidth = logosContainer.scrollWidth;
    logosContainer.innerHTML += logosContainer.innerHTML;

    let currentScroll = 0;

    function slide() {
        currentScroll += 2; // Adjust speed
        if (currentScroll >= logosWidth) {
            currentScroll = 0;
        }
        logosContainer.style.transform = `translateX(-${currentScroll}px)`;
    }

    setInterval(slide, 30);
}

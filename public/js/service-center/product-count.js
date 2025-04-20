document.addEventListener("DOMContentLoaded", function () {
    fetch('/cart-item-count')
        .then(res => res.json())
        .then(data => {
            const cartCountEl = document.getElementById('cart-count');
            if (data.count > 0) {
                cartCountEl.textContent = data.count;
                cartCountEl.style.display = 'inline-block';
            } else {
                cartCountEl.style.display = 'none';
            }
        })
        .catch(err => {
            console.error('Error fetching cart count:', err);
        });
});
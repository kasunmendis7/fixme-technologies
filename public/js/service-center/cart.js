document.querySelectorAll('.add-to-cart-btn').forEach(button => {
    button.addEventListener('click', ()=>{
        const product_id = button.getAttribute('data-product-id');
        console.log(product_id)

        fetch('/add-to-cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({product_id: product_id, quantity: 1})
        })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
            })
            .catch(error => console.error('Error:', error))
    })
})
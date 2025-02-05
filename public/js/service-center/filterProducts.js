document.querySelectorAll('.category-link').forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault(); // Prevent default link behavior

        const selectedCategory = link.getAttribute('data-category');
        const productsGrid = document.getElementById('products-grid');

        // Fetch products from the server
        fetch(`/get-products-by-category?category=${selectedCategory}`)
            .then(response => response.json())
            .then(products => {
                // Clear existing products
                productsGrid.innerHTML = '';

                // Render new products
                if (products.length > 0) {
                    products.forEach(product => {
                        productsGrid.innerHTML += `
                            <div class="product-card">
                                <img class="product-image"
                                     src="/assets/uploads/${product.media}"
                                     alt="Product Image">
                                <div class="product-details">
                                    <h2 class="product-title">${product.description}</h2>
                                    <p class="product-price">Rs. ${product.price}</p>
                                    <p class="product-seller">Sold by: ${product.seller_name}</p>
                                </div>
                                <a href="/check-out-page" class="product-btn">View Details</a>
                            </div>
                        `;
                    });
                } else {
                    productsGrid.innerHTML = '<p class="no-products">No products are available in this category.</p>';
                }
            })
            .catch(error => console.error('Error fetching products:', error));
    });
});
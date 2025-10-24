// Sample Products Data
let products = [
    {
        id: 1,
        name: "Classic Handbag",
        category: "bags",
        price: 45000,
        image: "https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=500",
        description: "Premium leather handbag with elegant design"
    },
    {
        id: 2,
        name: "Luxury Watch",
        category: "watches",
        price: 85000,
        image: "https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500",
        description: "Swiss made luxury timepiece"
    },
    {
        id: 3,
        name: "Designer Shoes",
        category: "shoes",
        price: 35000,
        image: "https://images.unsplash.com/photo-1543163521-1bf539c55dd2?w=500",
        description: "Handcrafted Italian leather shoes"
    },
    {
        id: 4,
        name: "Gold Bracelet",
        category: "accessories",
        price: 65000,
        image: "https://images.unsplash.com/photo-1611591437281-460bfbe1220a?w=500",
        description: "18k gold plated bracelet"
    }
];

// Load from localStorage if exists
if (localStorage.getItem('products')) {
    products = JSON.parse(localStorage.getItem('products'));
}

// Display Products
function displayProducts(productsToShow = products) {
    const container = document.getElementById('featured-products') || document.getElementById('all-products');
    if (!container) return;

    container.innerHTML = '';
    
    productsToShow.forEach(product => {
        const productCard = `
            <div class="product-card" onclick="viewProduct(${product.id})">
                <img src="${product.image}" alt="${product.name}" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">${product.name}</h3>
                    <p class="product-price">₹${product.price.toLocaleString()}</p>
                    <button class="btn-add-cart" onclick="addToCart(${product.id}, event)">
                        Add to Cart
                    </button>
                </div>
            </div>
        `;
        container.innerHTML += productCard;
    });
}

// Add to Cart
let cart = JSON.parse(localStorage.getItem('cart')) || [];

function addToCart(productId, event) {
    if (event) event.stopPropagation();
    
    const product = products.find(p => p.id === productId);
    const existingItem = cart.find(item => item.id === productId);
    
    if (existingItem) {
        existingItem.quantity++;
    } else {
        cart.push({ ...product, quantity: 1 });
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
    alert('Product added to cart!');
}

// Update Cart Count
function updateCartCount() {
    const cartCount = document.querySelector('.cart-count');
    if (cartCount) {
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        cartCount.textContent = totalItems;
    }
}

// Filter by Category
function filterCategory(category) {
    window.location.href = `products.html?category=${category}`;
}

// View Product Details
function viewProduct(productId) {
    window.location.href = `product-detail.html?id=${productId}`;
}

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    displayProducts();
    updateCartCount();
    
    // Category filter
    const categoryFilter = document.getElementById('category-filter');
    if (categoryFilter) {
        categoryFilter.addEventListener('change', (e) => {
            const category = e.target.value;
            if (category === 'all') {
                displayProducts(products);
            } else {
                displayProducts(products.filter(p => p.category === category));
            }
        });
    }
    
    // Sort filter
    const sortFilter = document.getElementById('sort-filter');
    if (sortFilter) {
        sortFilter.addEventListener('change', (e) => {
            let sorted = [...products];
            switch(e.target.value) {
                case 'price-low':
                    sorted.sort((a, b) => a.price - b.price);
                    break;
                case 'price-high':
                    sorted.sort((a, b) => b.price - a.price);
                    break;
                case 'name':
                    sorted.sort((a, b) => a.name.localeCompare(b.name));
                    break;
            }
            displayProducts(sorted);
        });
    }
});
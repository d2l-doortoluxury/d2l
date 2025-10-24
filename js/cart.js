let cart = JSON.parse(localStorage.getItem('cart')) || [];

function displayCart() {
    const cartItemsContainer = document.getElementById('cart-items');
    const subtotalElement = document.getElementById('subtotal');
    const totalElement = document.getElementById('total');
    
    if (cart.length === 0) {
        cartItemsContainer.innerHTML = '<p style="text-align:center; padding:40px;">Your cart is empty</p>';
        subtotalElement.textContent = '₹0';
        totalElement.textContent = '₹0';
        return;
    }
    
    cartItemsContainer.innerHTML = '';
    let subtotal = 0;
    
    cart.forEach((item, index) => {
        subtotal += item.price * item.quantity;
        
        const cartItemHTML = `
            <div class="cart-item">
                <img src="${item.image}" alt="${item.name}">
                <div class="cart-item-info">
                    <h3>${item.name}</h3>
                    <p class="product-price">₹${item.price.toLocaleString()}</p>
                    <div style="display: flex; gap: 10px; align-items: center; margin-top: 10px;">
                        <button onclick="updateQuantity(${index}, -1)" style="padding: 5px 10px;">-</button>
                        <span>${item.quantity}</span>
                        <button onclick="updateQuantity(${index}, 1)" style="padding: 5px 10px;">+</button>
                        <button onclick="removeFromCart(${index})" style="padding: 5px 15px; background: #e74c3c; color: white; border: none; cursor: pointer;">Remove</button>
                    </div>
                </div>
                <div>
                    <strong>₹${(item.price * item.quantity).toLocaleString()}</strong>
                </div>
            </div>
        `;
        cartItemsContainer.innerHTML += cartItemHTML;
    });
    
    subtotalElement.textContent = `₹${subtotal.toLocaleString()}`;
    totalElement.textContent = `₹${subtotal.toLocaleString()}`;
}

function updateQuantity(index, change) {
    cart[index].quantity += change;
    if (cart[index].quantity <= 0) {
        cart.splice(index, 1);
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    displayCart();
}

function removeFromCart(index) {
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart));
    displayCart();
}

function orderViaWhatsApp() {
    if (cart.length === 0) {
        alert('Your cart is empty!');
        return;
    }
    
    let message = '🛍️ *New Order*\n\n';
    let total = 0;
    
    cart.forEach(item => {
        message += `📦 ${item.name}\n`;
        message += `   Quantity: ${item.quantity}\n`;
        message += `   Price: ₹${(item.price * item.quantity).toLocaleString()}\n\n`;
        total += item.price * item.quantity;
    });
    
    message += `💰 *Total: ₹${total.toLocaleString()}*`;
    
    const whatsappNumber = '91XXXXXXXXXX'; // Replace with your number
    const url = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`;
    
    window.open(url, '_blank');
}

document.addEventListener('DOMContentLoaded', displayCart);
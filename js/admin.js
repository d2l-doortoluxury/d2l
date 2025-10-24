// Admin Login
document.getElementById('login-form')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    
    if (username === 'admin' && password === 'admin123') {
        localStorage.setItem('adminLoggedIn', 'true');
        window.location.href = 'dashboard.html';
    } else {
        alert('Invalid credentials!');
    }
});

// Check Login
if (window.location.pathname.includes('dashboard.html')) {
    if (!localStorage.getItem('adminLoggedIn')) {
        window.location.href = 'login.html';
    }
}

// Load Products in Admin
function loadAdminProducts() {
    const products = JSON.parse(localStorage.getItem('products')) || [];
    const tbody = document.getElementById('products-list');
    
    if (!tbody) return;
    
    tbody.innerHTML = '';
    products.forEach((product, index) => {
        tbody.innerHTML += `
            <tr>
                <td><img src="${product.image}" alt="${product.name}"></td>
                <td>${product.name}</td>
                <td>${product.category}</td>
                <td>₹${product.price.toLocaleString()}</td>
                <td>
                    <button class="btn-edit" onclick="editProduct(${index})">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn-delete" onclick="deleteProduct(${index})">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
    });
}

// Add/Edit Product
let editingIndex = null;

function openProductModal(index = null) {
    const modal = document.getElementById('product-modal');
    modal.style.display = 'block';
    
    if (index !== null) {
        editingIndex = index;
        const products = JSON.parse(localStorage.getItem('products')) || [];
        const product = products[index];
        
        document.getElementById('modal-title').textContent = 'Edit Product';
        document.getElementById('product-name').value = product.name;
        document.getElementById('product-category').value = product.category;
        document.getElementById('product-price').value = product.price;
        document.getElementById('product-image').value = product.image;
        document.getElementById('product-description').value = product.description;
    } else {
        editingIndex = null;
        document.getElementById('modal-title').textContent = 'Add New Product';
        document.getElementById('product-form').reset();
    }
}

function closeProductModal() {
    document.getElementById('product-modal').style.display = 'none';
}

document.getElementById('product-form')?.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const products = JSON.parse(localStorage.getItem('products')) || [];
    
    const product = {
        id: editingIndex !== null ? products[editingIndex].id : Date.now(),
        name: document.getElementById('product-name').value,
        category: document.getElementById('product-category').value,
        price: parseInt(document.getElementById('product-price').value),
        image: document.getElementById('product-image').value,
        description: document.getElementById('product-description').value
    };
    
    if (editingIndex !== null) {
        products[editingIndex] = product;
    } else {
        products.push(product);
    }
    
    localStorage.setItem('products', JSON.stringify(products));
    closeProductModal();
    loadAdminProducts();
    alert('Product saved successfully!');
});

function editProduct(index) {
    openProductModal(index);
}

function deleteProduct(index) {
    if (confirm('Are you sure you want to delete this product?')) {
        const products = JSON.parse(localStorage.getItem('products')) || [];
        products.splice(index, 1);
        localStorage.setItem('products', JSON.stringify(products));
        loadAdminProducts();
    }
}

function showSection(section) {
    document.querySelectorAll('.admin-section').forEach(s => s.style.display = 'none');
    document.getElementById(section + '-section').style.display = 'block';
}

function saveSettings() {
    const settings = {
        storeName: document.getElementById('store-name').value,
        whatsappNumber: document.getElementById('whatsapp-number').value,
        email: document.getElementById('store-email').value,
        currency: document.getElementById('currency').value
    };
    
    localStorage.setItem('settings', JSON.stringify(settings));
    alert('Settings saved successfully!');
}

function logout() {
    localStorage.removeItem('adminLoggedIn');
    window.location.href = 'login.html';
}

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    loadAdminProducts();
});
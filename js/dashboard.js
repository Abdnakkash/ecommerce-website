function loadContent(action) {
    // Load content based on the selected action
    var dynamicContent = document.getElementById('dynamic-content');

    switch (action) {
        case 'editProduct':
            dynamicContent.innerHTML = '<h2>Edit Product</h2>';
            break;
        case 'addProduct':
            dynamicContent.innerHTML = '<h2>Add Product</h2>';
            break;
        case 'deleteProduct':
            dynamicContent.innerHTML = '<h2>Delete Product</h2>';
            break;
        case 'editCategories':
            dynamicContent.innerHTML = '<h2>Edit Categories</h2>';
            break;
        case 'orders':
            dynamicContent.innerHTML = '<h2>Orders</h2>';
            break;
    }
}

function logout() {
    // Implement logout logic here
    alert('Logout successful!');
    // Redirect to login page or perform other logout actions
}

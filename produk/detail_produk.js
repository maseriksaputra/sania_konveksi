// Fungsi untuk memperbarui jumlah produk
function updateQuantity(change) {
    var quantityInput = document.getElementById('quantity');
    var currentQuantity = parseInt(quantityInput.value);
    var newQuantity = currentQuantity + change;

    // Menambahkan maxQuantity dan harga dari data PHP
    var maxQuantity = maxStock;  // Data ini akan diteruskan dari PHP
    if (newQuantity >= 1 && newQuantity <= maxQuantity) {
        quantityInput.value = newQuantity;
        updateTotalPrice();
    }
}

// Fungsi untuk memperbarui harga total
function updateTotalPrice() {
    var quantity = parseInt(document.getElementById('quantity').value);
    var price = productPrice;  // Data ini juga diteruskan dari PHP
    var totalPrice = quantity * price;
    document.getElementById('totalPrice').value = 'Rp ' + totalPrice.toLocaleString();

    var whatsappLink = document.querySelector('.secondary-btn');
    
    var url = 'https://wa.me/082250791395?text=Halo,%20saya%20tertarik%20untuk%20membeli%20produk%20anda.%0A%0A%2A%20Nama%20Produk%3A%20' + encodeURIComponent(productName) +
              '%0A%2A%20Jenis%20Produk%3A%20' + encodeURIComponent(productType) +
              '%0A%2A%20Ukuran%3A%20' + encodeURIComponent(document.getElementById('ukuran').value) +
              '%0A%2A%20Warna%3A%20' + encodeURIComponent(document.getElementById('warna').value) +
              '%0A%2A%20Jumlah%3A%20' + encodeURIComponent(quantity) +
              '%20buah%0A%2A%20Harga%20Total%3A%20Rp%20' + encodeURIComponent(totalPrice.toLocaleString()) +
              '%0A%2A%20Keterangan%3A%20' + encodeURIComponent(productDescription);

    whatsappLink.href = url;
}

// Fungsi yang dipanggil saat halaman dimuat
window.onload = function() {
    updateTotalPrice();
};

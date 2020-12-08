setTimeout(function() {
$('#loading').detach();
}, 4800);
index = 0;
setInterval(function() {
$('#load_dashboard').load('load_dashboard.php');
index = index + 1;
console.log(index + ' update');
}, 5000);

# https://dzone.com/articles/whats-new-in-php-7-and-php-7-new-features

if orders are cancelled return back all the qty in products

# cancelled and done cannot be modify orders

# cancel in orders.php button and edit, cannot edit if already cancelled/

# if cancelled by user return all items to products and sales/

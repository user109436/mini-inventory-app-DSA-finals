setTimeout(function() {
$('#loading').detach();
}, 4800);
index = 0;
setInterval(function() {
$('#load_dashboard').load('load_dashboard.php');
index = index + 1;
console.log(index + ' update');
}, 5000);

#https://dzone.com/articles/whats-new-in-php-7-and-php-7-new-features

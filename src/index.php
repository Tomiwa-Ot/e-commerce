<?php

require __DIR__ . '/router.php';

Route::add('/', function() {
    require __DIR__ . '/views/home.php';
});

Route::add('/login', function() {
    require __DIR__ . '/views/login.php';
});

Route::add('/register', function() {
    require __DIR__ . '/views/register.php';
});

Route::add('/logout', function() {
    require __DIR__ . '/views/logout.php';
});

Route::add('/item', function() {
    require __DIR__ . '/views/item.php';
});

Route::add('/products', function() {
    require __DIR__ . '/views/products.php';
});

Route::add('/profile', function() {
    require __DIR__ . '/views/profile.php';
});

Route::add('/orders', function() {
    require __DIR__ . '/views/orders.php';
});

Route::add('/order-details', function() {
    require __DIR__ . '/views/order-details.php';
});

Route::add('/cart', function() {
    require __DIR__ . '/views/cart.php';
});

Route::add('/cart-remove-item', function() {
    require __DIR__ . '/views/cart-remove-item.php';
});

Route::add('/confirmation', function() {
    require __DIR__ . '/views/confirmation.php';
});

Route::add('/faq', function() {
    require __DIR__ . '/views/faq.php';
});

Route::add('/about', function() {
    require __DIR__ . '/views/about.php';
});

Route::add('/privacy-policy', function() {
    require __DIR__ . '/views/privacy-policy.php';
});

Route::add('/forgot-password', function() {
    require __DIR__ . '/views/forgot-password.php';
});

Route::add('/reset', function() {
    require __DIR__ . '/views/reset.php';
});

Route::add('/400', function() {
    require __DIR__ . '/views/400.php';
});

Route::add('/robots.txt', function() {
    require __DIR__ . '/views/robots.txt';
});

Route::add('/sitemap.xml', function() {
    require __DIR__ . '/views/sitemap.xml';
});

Route::add('/admin/home', function() {
    require __DIR__ . '/views/admin/home.php';
});

Route::add('/admin/login', function() {
    require __DIR__ . '/views/admin/login.php';
});

Route::add('/admin/logout', function() {
    require __DIR__ . '/views/admin/logout.php';
});

Route::add('/admin/reset-password', function() {
    require __DIR__ . '/views/admin/reset-password.php';
});

Route::add('/admin/products', function() {
    require __DIR__ . '/views/admin/products.php';
});

Route::add('/admin/customers', function() {
    require __DIR__ . '/views/admin/customers.php';
});

Route::add('/admin/orders', function() {
    require __DIR__ . '/views/admin/orders.php';
});

Route::add('/admin/faq', function() {
    require __DIR__ . '/views/admin/faq.php';
});

Route::add('/admin/settings', function() {
    require __DIR__ . '/views/admin/settings.php';
});

Route::add('/admin/products/create', function() {
    require __DIR__ . '/views/admin/create-product.php';
});

Route::add('/admin/customers/create', function() {
    require __DIR__ . '/views/admin/create-customer.php';
});

Route::add('/admin/faq/create', function() {
    require __DIR__ . '/views/admin/create-faq.php';
});

Route::add('/admin/stats', function() {
    require __DIR__ . '/views/admin/stats.php';
});

Route::submit();
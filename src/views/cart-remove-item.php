<?php
session_start();

if(isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    unset($_SESSION['cart'][$id]);
}

header('Location: /cart');
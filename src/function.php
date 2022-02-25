<?php

namespace App;

session_start();
require('classes/products.php');
require('classes/cart.php');

$products = array(array("id" => 101, "name" => "Basket Ball", "image" => "basketball.png", "price" => 150, "qnty" => 1, 'tPrice' => 150), array("id" => 102, "name" => "Football", "image" => "football.png", "price" => 120, "qnty" => 1, 'tPrice' => 120), array("id" => 103, "name" => "Soccer", "image" => "soccer.png", "price" => 110, "qnty" => 1, 'tPrice' => 110), array("id" => 104, "name" => "Table Tennis", "image" => "table-tennis.png", "price" => 130, "qnty" => 1, 'tPrice' => 130), array("id" => 105, "name" => "Tennis", "image" => "tennis.png", "price" => 100, "qnty" => 1, 'tPrice' => 100));


if (isset($_REQUEST['action'])) {
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "404";
    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : "404";
    $qnty = isset($_REQUEST['qnty']) ? $_REQUEST['qnty'] : "404";

    switch ($action) {
        case 'add':
            addProduct($id, $products);
            break;
        case 'remove':
            removeProduct($id);
            break;
    }
}

//add product to cart
function addProduct($id, $products)
{
    $cart = new cart();
    $cartData = isset($_SESSION['cart']) ? json_decode($_SESSION['cart']) : array();
    $cart->setCart($cartData);
    foreach ($products as $product) {
        if ($product['id'] == $id) {
            $p  = new products($product['id'], $product['name'], $product['price']);
            $cart->addToCart($p);
            $_SESSION['cart'] = json_encode($cart->getCart());
            echo $_SESSION['cart'];
            break;
        }
    }
}

// //remove product from cart
function removeProduct($id)
{
    $cart = new cart();
    $cartData = isset($_SESSION['cart']) ? json_decode($_SESSION['cart']) : array();
    $cart->setCart($cartData);
    $cart->removeProductFromCart($id);
    $_SESSION['cart'] = json_encode($cart->getCart());
    echo $_SESSION['cart'];
}

// //product Listing
function productListing($products)
{
    $row = "";

    foreach ($products as $product) {
        $row .= '<div id="' . $product['id'] . '" class="product">
            <img src="./images/' . $product['image'] . '"/>
            <h3 class="title"><a href="#">' . $product['name'] . '</a></h3>
            <span>' . $product['price'] . '</span>
            <a class="add-to-cart" data-id="' . $product['id'] . '" href="products.php?id=' . $product['id'] . '&action=addProduct" >Add To Cart</a>
            </div>';
    }
    return $row;
}

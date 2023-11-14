<?php
require_once('vendor/autoload.php');

$price = $_POST['price'];
$name = $_POST['name'];
$stripeKey = "sk_test_51LlCYIGFTiLdSOQGu8djLe18RDFKGFElDKgDiJkVex1ytTQhX2KhgBuKpQOwMD2YgBVVfIkhmEuHmdHmoUeglN6u00OMaC3YXA";

\Stripe\Stripe::setApiKey($stripeKey);
$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost:4208/richRicosso/vue/index.php",
    "line_items" => [
        [
            'price_data' => [
                'currency' => 'cad',
                'product_data' => ['name' => $name, 'description' => 'Nous ne vous promettons pas que vous allez recevoir vos articles, a vos risques et perils.'],
                'unit_amount' => $price,


            ],
            'quantity' => 1,

        ]
    ]
]);
http_response_code(303);
header("Location: " . $checkout_session->url);
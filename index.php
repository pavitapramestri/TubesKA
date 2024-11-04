<?php
// start session
session_start();

require_once('./components/Generate.php');
require_once('./components/card.php');

// create instance of generate class
$database = new Generate("cart_php", "product");

// Create add to cart
if (isset($_POST['add'])) {
    // create session cart
    if (isset($_SESSION['cart'])) {
        $item_array_id = array_column($_SESSION['cart'], "product_id");
        // print_r($item_array_id);

        // if product already added
        if (in_array($_POST['product_id'], $item_array_id)) {
            echo "<script>alert('product alredy added!')</script>";
            echo "<script>window.location='index.php'</script>";
        } else {
            // count how many product id in the cart
            $count = count($_SESSION['cart']);

            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            // call session cart again with count item product
            $_SESSION['cart'][$count] = $item_array;
            // print_r($_SESSION['cart']);
        }
    } else {

        $item_array = array(
            'product_id' => $_POST['product_id']
        );

        // create new session variable
        $_SESSION['cart'][0] = $item_array;
        // print_r($_SESSION['cart']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Style CSS -->
    <link rel="stylesheet" href="style.css">

    <title>4S Moto Shop</title>
</head>

<body>
    <?php require_once("./components/header.php"); ?>

    <div class="container">
        <div class="row text-center py-5">
            <?php
            $result = $database->getData();
            while ($row = mysqli_fetch_assoc($result)) {
                card($row['product_name'], $row['product_image'], $row['product_price'], $row['id']);
            }
            // card("product1", './upload/kacamata.png', 59);
            // card("product2", './upload/jam.png', 99);
            ?>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>
<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for snap popup:
// https://docs.midtrans.com/en/snap/integration-guide?id=integration-steps-overview

namespace Midtrans;

require_once dirname(__FILE__) . '/../../Midtrans.php';
// Set Your server key
// can find in Merchant Portal -> Settings -> Access keys
Config::$serverKey = 'SB-Mid-server-_NIUKVktNCJWaY1mHpFmw8gs';
Config::$clientKey = 'SB-Mid-client-IsNK_9LIA4qZ81B7';

// non-relevant function only used for demo/example purpose
printExampleWarningMessage();

// Uncomment for production environment
// Config::$isProduction = true;
Config::$isSanitized = Config::$is3ds = true;

include "../../../admin/koneksi.php";
$order_id = $_GET['order_id'];

// $query = "SELECT * FROM transaksi WHERE order_id='" . $order_id . "'";
$sql = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE order_id='" . $order_id . "'");
$data = mysqli_fetch_array($sql);

$nama = $data['nama'];
$email = $data['email'];
$biaya = $data['biaya'];
$transaction_details = array(
    'order_id' => $order_id,
    'gross_amount' => $biaya, // no decimal allowed for creditcard
);
// Optional
$item_details = array(
    array(
        'id' => 'a1',
        'price' => $biaya,
        'quantity' => 1,
        'name' => "Pembayaran Barang"
    ),
);
// Optional
$customer_details = array(
    'first_name'    => "$nama",
    'last_name'     => "",
    'email'         => "$email",
    'phone'         => "",
    // 'billing_address'  => $billing_address,
    // 'shipping_address' => $shipping_address
);
// Fill transaction details
$transaction = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
);

$snap_token = '';
try {
    $snap_token = Snap::getSnapToken($transaction);
} catch (\Exception $e) {
    echo $e->getMessage();
}
echo "snapToken = " . $snap_token;

function printExampleWarningMessage()
{
    if (strpos(Config::$serverKey, 'your ') != false) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'SB-Mid-server-_NIUKVktNCJWaY1mHpFmw8gs\';');
        die();
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
    <title>Document</title>
</head>

<body>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <p>Registrasi Berhasil, selesaikan pembayaran sekarang</p>
                <button id="pay-button" class="btn btn-primary">Pilih Metode Pembayaran</button>
                <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey; ?>"></script>
                <script type="text/javascript">
                    document.getElementById('pay-button').onclick = function() {
                        // SnapToken acquired from previous step
                        snap.pay('<?php echo $snap_token ?>');
                    };
                </script>
            </div>
        </div>
    </div>

</body>

</html>
<?php
// include "admin/koneksi.php";

// $nama = $_POST['nama'];
// $alamat = $_POST['alamat'];
// $email = $_POST['email'];
// $biaya = $_POST['biaya'];
// $tgl_transaksi = $_POST['tgl_transaksi'];
// $order_id = rand();
// $status_transaksi = 1;


// insert database
// mysqli_query($koneksi, "INSERT INTO transaksi VALUES('', '$nama', '$alamat', '$biaya', '$order_id', '$status_transaksi', '$email', '$tgl_transaksi')");

// header("location:./midtrans/examples/snap/checkout-process-simple-version.php?order_id='$order_id'");

include "admin/koneksi.php";

$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$email = $_POST['email'];
$biaya = $_POST['biaya'];
$tgl_transaksi = $_POST['tgl_transaksi'];
$order_id = rand();
$status_transaksi = 1;

// Gunakan prepared statements untuk keamanan
$stmt = $koneksi->prepare("INSERT INTO transaksi (nama, alamat, biaya, order_id, status_transaksi, email, tgl_transaksi) 
                           VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssdiiss", $nama, $alamat, $biaya, $order_id, $status_transaksi, $email, $tgl_transaksi);

if ($stmt->execute()) {
    header("location:./midtrans/examples/snap/checkout-process-simple-version.php?order_id=$order_id");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
?>
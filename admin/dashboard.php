<?php include "header_admin.php" ?>

<?php
// session_start();
if ($_SESSION['status'] != "login") {
    header("location:login.php?pesan=belum_login");
}
?>

<!-- <h4>Selamat datang, <?php echo $_SESSION['username']; ?>! anda telah login.</h4> -->

<div class="container my-5">
    <h3>Data Pembayaran</h3>
    <table class="table table-striped table-bordered table-hover mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Item Price</th>
                <th>Alamat</th>
                <th>Tanggal Checkout</th>
                <th>Status Transaksi</th>
                <th>Id Order</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "koneksi.php";
            error_reporting(0);
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM transaksi ORDER BY id ASC");
            while ($data = mysqli_fetch_array($query)) {
                $status = $data['status_transaksi'];
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $data['nama'] . "</td>";
                echo "<td>" . $data['biaya'] . "</td>";
                echo "<td>" . $data['alamat'] . "</td>";
                echo "<td>" . $data['tgl_transaksi'] . "</td>";
                if ($status >= 3) {
                    echo "<td><span class='badge badge-success'>Pembayaran Sukses</span></td>";
                } else if ($status >= 2) {
                    echo "<td><span class='badge badge-warning'>Pembayaran Pending</span></td>";
                } else {
                    echo "<td><span class='badge badge-danger'>Pembayaran Belum Dilakukan</span></td>";
                }
                echo "<td>" . $data['order_id'] . "</td>";
                echo "<td><a href='hapus.php?id=" . $data['id'] . "' class='btn btn-danger btn-sm'><i class='fas fa-trash'></i> Hapus</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>


<?php include "footer_admin.php" ?>
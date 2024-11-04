<?php include "header_admin.php" ?>

<?php
// session_start();
if ($_SESSION['status'] != "login") {
    header("location:login.php?pesan=belum_login");
}
?>

<div class="container my-5">
    <h3>Data Produk</h3>
    <a href="tambah_produk.php" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
    <table class="table table-striped table-bordered table-hover mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga Produk</th>
                <th>Gambar Produk</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "koneksi.php";
            error_reporting(0);
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id ASC");
            while ($data = mysqli_fetch_array($query)) {
                $status = $data['status_transaksi'];
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $data['product_name'] . "</td>";
                echo "<td>" . $data['product_price'] . "</td>";
                echo "<td>" . $data['product_image'] . "</td>";
                echo "<td>
                <a href='edit_produk.php?id=" . $data['id'] . "' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i> Edit</a>
                <a href='hapus_produk.php?id=" . $data['id'] . "' class='btn btn-danger btn-sm'><i class='fas fa-trash'></i> Hapus</a>
                </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include "footer_admin.php" ?>
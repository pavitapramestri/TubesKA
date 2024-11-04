<?php include "header_admin.php" ?>

<?php
// memanggil file koneksi.php untuk membuat koneksi
include 'koneksi.php';

// mengecek apakah di url ada nilai GET id
if (isset($_GET['id'])) {
    // ambil nilai id dari url dan disimpan dalam variabel $id
    $id = ($_GET["id"]);

    // menampilkan data dari database yang mempunyai id=$id
    $query = "SELECT * FROM product WHERE id='$id'";
    $result = mysqli_query($koneksi, $query);
    // jika data gagal diambil maka akan tampil error berikut
    if (!$result) {
        die("Query Error: " . mysqli_errno($koneksi) .
            " - " . mysqli_error($koneksi));
    }
    // mengambil data dari database
    $data = mysqli_fetch_assoc($result);
    // apabila data tidak ada pada database maka akan dijalankan perintah ini
    if (!count($data)) {
        echo "<script>alert('Data tidak ditemukan pada database');window.location='index.php';</script>";
    }
} else {
    // apabila tidak ada data GET id pada akan di redirect ke index.php
    echo "<script>alert('Masukkan data id.');window.location='index.php';</script>";
}
?>


<div class="container my-5">
    <h3 class="mb-3">Form Update Produk</h3>
    <form action="proses_edit.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" name="product_name" class="form-control" value="<?= $data['product_name'] ?>">
            <input type="hidden" name="id" value="<?= $data['id'] ?>">
        </div>
        <div class="form-group">
            <label>Harga Produk</label>
            <input type="number" name="product_price" class="form-control" value="<?= $data['product_price'] ?>">
        </div>
        <div class="form-group">
            <label>Gambar Produk</label>
            <input type="file" name="product_image" class="form-control mb-2">
            <?= "<img src='../upload/" . $data['product_image'] . "' width='150px' height='150px'/>" ?>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
    </form>
</div>

<?php include "footer_admin.php" ?>
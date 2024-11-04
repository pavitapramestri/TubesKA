<?php include "header_admin.php" ?>

<?php
if (isset($_GET['product_name'])) {
    if ($_GET['product_name'] == "kosong") {
        echo "<h4 style='color:red'>Nama Produk Belum Di Masukkan !</h4>";
    } else if ($_GET['product_price'] == "kosong") {
        echo "<h4 style='color:red'>Harga Produk Belum Di Masukkan !</h4>";
    }
}
?>

<div class="container my-5">
    <h3 class="mb-3">Form Tambah Produk</h3>
    <form action="controller.php" method="post" enctype="multipart/form-data"> 
        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" name="product_name" class="form-control">
        </div>
        <div class="form-group">
            <label>Harga Produk</label>
            <input type="number" name="product_price" class="form-control">
        </div>
        <div class="form-group">
            <label>Gambar Produk</label>
            <input type="file" name="product_image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
    </form>
</div>

<?php include "footer_admin.php" ?>
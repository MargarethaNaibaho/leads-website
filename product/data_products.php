<?php
session_start();
error_reporting(0);

include 'connection/connection.php';

if(!isset($_SESSION['admin'])) {
	echo "<script>alert('Hei, kamu! Kamu belum login. Silahkan login terlebih dahulu.');</script>";
	echo "<script>location='index.php';</script>";
	exit();
}

$queryProducts = "SELECT * FROM produk";

$result = mysqli_query($connection, $queryProducts);
?>


<div class="main">
    <div class="mb-3"></div>
    <h1>Selamat Datang di Leads Website</h1>
    <div class="mb-3"></div>
    <div class="mb-5">
        <button type="button" class="btn btn-primary">
            <a href="./home.php?halaman=tambahproduk" class="text-white text-decoration-none">Tambah Produk</a>
        </button>
    </div>

    <table id="data" class="table table-striped text-center" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">ID Input</th>
                <th class="text-center">Nama Produk</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $no = 1;
            while($row = mysqli_fetch_assoc($result)):
                $id_input = str_pad($row['id_produk'], 3, '0', STR_PAD_LEFT);
            
            ?>

            <tr>
                <td class="text-center"><?php echo $no++; ?></td>
                <td class="text-center"><?php echo htmlspecialchars($id_input); ?></td>
                <td class="text-center"><?php echo htmlspecialchars($row['nama_produk']); ?></td>
                <td class="text-center">
                    <a href="./home.php?halaman=ubahproduk&id=<?php echo $row['id_produk']; ?>"><i class="lni lni-write"></i></a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>


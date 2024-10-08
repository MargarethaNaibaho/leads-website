<?php
session_start();
error_reporting(0);

include 'connection/connection.php';

if(!isset($_SESSION['admin'])) {
	echo "<script>alert('Hei, kamu! Kamu belum login. Silahkan login terlebih dahulu.');</script>";
	echo "<script>location='index.php';</script>";
	exit();
}

$queryLeads = "SELECT
                    l.id_leads,
                    l.tanggal,
                    l.no_wa,
                    l.nama_lead,
                    l.kota,
                    s.nama_sales,
                    p.nama_produk
                FROM leads l
                JOIN sales s ON l.id_sales = s.id_sales
                JOIN produk p ON l.id_produk = p.id_produk
                ORDER BY l.tanggal DESC";

$result = mysqli_query($connection, $queryLeads);
?>


<div class="main">
    <div class="mb-3"></div>
    <h1>Selamat Datang di Leads Website</h1>
    <div class="mb-3"></div>
    <div class="mb-5">
        <button type="button" class="btn btn-primary">
            <a href="./home.php?halaman=tambahleads" class="text-white text-decoration-none">Tambah Leads</a>
        </button>
    </div>

    <table id="data" class="table table-striped text-center" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">ID Input</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Sales</th>
                <th class="text-center">Produk</th>
                <th class="text-center">Nama Leads</th>
                <th class="text-center">No Wa</th>
                <th class="text-center">Kota</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $no = 1;
            while($row = mysqli_fetch_assoc($result)):
                $id_input = str_pad($row['id_leads'], 3, '0', STR_PAD_LEFT);
            
            ?>

            <tr>
                <td class="text-center"><?php echo $no++; ?></td>
                <td class="text-center"><?php echo htmlspecialchars($id_input); ?></td>
                <td class="text-center"><?php echo htmlspecialchars($row['tanggal']); ?></td>
                <td class="text-center"><?php echo htmlspecialchars($row['nama_sales']); ?></td>
                <td class="text-center"><?php echo htmlspecialchars($row['nama_produk']); ?></td>
                <td class="text-center"><?php echo htmlspecialchars($row['nama_lead']); ?></td>
                <td class="text-center"><?php echo htmlspecialchars($row['no_wa']); ?></td>
                <td class="text-center"><?php echo htmlspecialchars($row['kota']); ?></td>
                <td class="text-center">
                    <a href="./home.php?halaman=ubahleads&id=<?php echo $row['id_leads']; ?>"><i class="lni lni-write"></i></a>
                    <a href="./home.php?halaman=hapusleads&id=<?php echo $row['id_leads']; ?>"><i class="lni lni-trash-can"></i></a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>


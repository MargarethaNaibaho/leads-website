<?php
session_start();
error_reporting(0); // Show all errors

include 'connection/connection.php';

if(!isset($_SESSION['admin'])) {
    echo "<script>alert('Hei, kamu! Kamu belum login. Silahkan login terlebih dahulu.');</script>";
    echo "<script>location='index.php';</script>";
    exit();
}

$id_produk = '';
$nama_produk = '';

if(isset($_GET['id'])){
    $id_produk = (int) $_GET['id'];

    $ambil = $connection->prepare("SELECT * FROM produk WHERE id_produk = ?");
    $ambil->bind_param("i", $id_produk);
    $ambil->execute();
    $result = $ambil->get_result();

    if($result->num_rows > 0){
        $data = $result->fetch_assoc();
        $id_produk = $data['id_produk'];
        $nama_produk = $data['nama_produk'];
    } else{
        echo "<script>alert('Data tidak ditemukan');</script>";
        echo "<script>location='./home.php?halaman=dataproduk';</script>";
        exit();
    }

    $ambil->close();
} else{
    echo "<script>alert('ID tidak valid');</script>";
    echo "<script>location='./home.php?halaman=dataproduk';</script>";
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_produk = mysqli_real_escape_string($connection, $_POST['nama_produk']);

    // Validasi inputan
    $errors = [];
    if (empty($nama_produk)) $errors[] = "Nama Produk harus diisi!";

    if (!empty($errors)) {
        echo "<script>alert('" . implode("\\n", $errors) . "');</script>";
    } else {
        $query = "UPDATE produk SET nama_produk = ? WHERE id_produk = ?";
        $stmt = $connection->prepare($query);
        
        if ($stmt === false) {
            echo "<script>alert('Gagal mempersiapkan statement: " . mysqli_error($connection) . "');</script>";
            exit();
        }

        $stmt->bind_param("si", $nama_produk, $id_produk);

        if (!$stmt->execute()) {
            echo "<script>alert('Gagal memperbarui data Produk: " . $stmt->error . "');</script>";
        } else {
            echo "<script>alert('Data Produk berhasil diperbarui');</script>";
            echo "<script>location='./home.php?halaman=dataproduk';</script>";
        }

        $stmt->close();
    }
}
?>
        <div class="main">
            <div class="mb-3"></div>
            <h1>Selamat Datang di Leads Website</h1>
            <div class="mb-3"></div>

            <div class="mb-5">
                <button type="button" class="btn btn-success">
                    <a href="./home.php?halaman=dataproduk" class="text-white text-decoration-none">
                        Kembali <i class="lni lni-reply ms-2"></i>
                    </a>
                </button>
            </div>

            <form action="" method="POST">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="textInput" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="textInput" placeholder="Nama Produk" aria-label="Nama Produk" name="nama_produk" value="<?php echo htmlspecialchars($nama_produk); ?>" required>
                    </div>
                </div>

                <div class="mb-5"></div>
                <div class="mb-5 d-flex justify-content-center gap-2 mt-3">
                    <button type="submit" class="btn btn-success w-20" style="background-color: #6f42c1; padding: 10px 40px; border-radius: 20px;">
                            Simpan
                    </button>

                    <button type="button" class="btn btn-light w-10" style="background-color: #F3F3F3; padding: 10px 40px; border-radius: 20px;">
                        <a href="./home.php?halaman=dataproduk" class="text-black text-decoration-none">
                            Cancel
                        </a>
                    </button>
                </div>
            </form>
        </div>
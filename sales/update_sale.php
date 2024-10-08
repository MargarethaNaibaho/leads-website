<?php
session_start();
error_reporting(0); // Show all errors

include 'connection/connection.php';

if(!isset($_SESSION['admin'])) {
    echo "<script>alert('Hei, kamu! Kamu belum login. Silahkan login terlebih dahulu.');</script>";
    echo "<script>location='index.php';</script>";
    exit();
}

$id_sales = '';
$nama_sales = '';

if(isset($_GET['id'])){
    $id_sales = (int) $_GET['id'];

    $ambil = $connection->prepare("SELECT * FROM sales WHERE id_sales = ?");
    $ambil->bind_param("i", $id_sales);
    $ambil->execute();
    $result = $ambil->get_result();

    if($result->num_rows > 0){
        $data = $result->fetch_assoc();
        $id_sales = $data['id_sales'];
        $nama_sales = $data['nama_sales'];
    } else{
        echo "<script>alert('Data tidak ditemukan');</script>";
        echo "<script>location='./home.php?halaman=datasales';</script>";
        exit();
    }

    $ambil->close();
} else{
    echo "<script>alert('ID tidak valid');</script>";
    echo "<script>location='./home.php?halaman=datasales';</script>";
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_sales = mysqli_real_escape_string($connection, $_POST['nama_sales']);

    // Validasi inputan
    $errors = [];
    if (empty($nama_sales)) $errors[] = "Nama Produk harus diisi!";

    if (!empty($errors)) {
        echo "<script>alert('" . implode("\\n", $errors) . "');</script>";
    } else {
        $query = "UPDATE sales SET nama_sales = ? WHERE id_sales = ?";
        $stmt = $connection->prepare($query);
        
        if ($stmt === false) {
            echo "<script>alert('Gagal mempersiapkan statement: " . mysqli_error($connection) . "');</script>";
            exit();
        }

        $stmt->bind_param("si", $nama_sales, $id_sales);

        if (!$stmt->execute()) {
            echo "<script>alert('Gagal memperbarui data Sales: " . $stmt->error . "');</script>";
        } else {
            echo "<script>alert('Data Sales berhasil diperbarui');</script>";
            echo "<script>location='./home.php?halaman=datasales';</script>";
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
                    <a href="./home.php?halaman=datasales" class="text-white text-decoration-none">
                        Kembali <i class="lni lni-reply ms-2"></i>
                    </a>
                </button>
            </div>

            <form action="" method="POST">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="textInput" class="form-label">Nama Sales</label>
                        <input type="text" class="form-control" id="textInput" placeholder="Nama Sales" aria-label="Nama Sales" name="nama_sales" value="<?php echo htmlspecialchars($nama_sales); ?>" required>
                    </div>
                </div>

                <div class="mb-5"></div>
                <div class="mb-5 d-flex justify-content-center gap-2 mt-3">
                    <button type="submit" class="btn btn-success w-20" style="background-color: #6f42c1; padding: 10px 40px; border-radius: 20px;">
                            Simpan
                    </button>

                    <button type="button" class="btn btn-light w-10" style="background-color: #F3F3F3; padding: 10px 40px; border-radius: 20px;">
                        <a href="./home.php?halaman=datasales" class="text-black text-decoration-none">
                            Cancel
                        </a>
                    </button>
                </div>
            </form>
        </div>
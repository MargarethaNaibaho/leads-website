<?php
session_start();
error_reporting(0); // Show all errors

include 'connection/connection.php';

if(!isset($_SESSION['admin'])) {
    echo "<script>alert('Hei, kamu! Kamu belum login. Silahkan login terlebih dahulu.');</script>";
    echo "<script>location='index.php';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil dan sanitasi data input
    $tanggal = mysqli_real_escape_string($connection, $_POST['tanggal']);
    $id_sales = mysqli_real_escape_string($connection, $_POST['id_sales']);
    $nama_lead = mysqli_real_escape_string($connection, $_POST['nama_lead']);
    $id_produk = mysqli_real_escape_string($connection, $_POST['id_produk']);
    $no_wa = mysqli_real_escape_string($connection, $_POST['no_wa']);
    $kota = mysqli_real_escape_string($connection, $_POST['kota']);
    $id_user = (int)$_SESSION['id_user'];

    // Validasi inputan
    $errors = [];
    if (empty($tanggal)) $errors[] = "Tanggal harus diisi!";
    if (empty($id_sales)) $errors[] = "Sales harus dipilih!";
    if (empty($nama_lead)) $errors[] = "Nama Lead harus diisi!";
    if (empty($id_produk)) $errors[] = "Produk harus dipilih!";
    if (empty($no_wa)) $errors[] = "No. Whatsapp harus diisi!";
    if (empty($kota)) $errors[] = "Kota harus diisi!";

    if (!empty($errors)) {
        echo "<script>alert('" . implode("\\n", $errors) . "');</script>";
    } else {
        // Siapkan statement untuk memasukkan data
        $query = "INSERT INTO leads (tanggal, id_sales, nama_lead, id_produk, no_wa, kota, id_user) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($query);
        
        if ($stmt === false) {
            echo "<script>alert('Gagal mempersiapkan statement: " . mysqli_error($connection) . "');</script>";
            exit();
        }

        $stmt->bind_param("sisissi", $tanggal, $id_sales, $nama_lead, $id_produk, $no_wa, $kota, $id_user);

        if (!$stmt->execute()) {
            echo "<script>alert('Gagal menyimpan data Leads: " . $stmt->error . "');</script>";
        } else {
            echo "<script>alert('Data Leads berhasil disimpan');</script>";
            echo "<script>location='./home.php';</script>";
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
                    <a href="./home.php" class="text-white text-decoration-none">
                        Kembali <i class="lni lni-reply ms-2"></i>
                    </a>
                </button>
            </div>

            <form action="" method="POST">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="dateInput" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="dateInput" aria-label="Tanggal" name="tanggal" required>
                    </div>
                    <div class="col-md-4">
                        <label for="dropdownInput" class="form-label">Sales</label>
                        <select class="form-select" id="dropdownInput" aria-label="Sales" name="id_sales" required>
                            <option selected disabled>--Pilih Sales--</option>
                            <?php
                            
                            $querySales = "SELECT * FROM sales";
                            $resultSales = mysqli_query($connection, $querySales);
                            while ($rowSales = mysqli_fetch_assoc($resultSales)){
                                echo '<option value="'.htmlspecialchars($rowSales['id_sales']).'">'.htmlspecialchars($rowSales['nama_sales']).'</option>';
                            }

                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="textInput" class="form-label">Nama Lead</label>
                        <input type="text" class="form-control" id="textInput" placeholder="Nama Lead" aria-label="Nama Lead" name="nama_lead" required>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="dropdownInput" class="form-label">Produk</label>
                        <select class="form-select" id="dropdownInput" aria-label="Produk" name="id_produk" required>
                            <option selected disabled>--Pilih Produk--</option>
                            <?php
                            
                            $queryProduct = "SELECT * FROM produk";
                            $resultProduct = mysqli_query($connection, $queryProduct);
                            while($rowProduct = mysqli_fetch_assoc($resultProduct)){
                                echo '<option value="'.htmlspecialchars($rowProduct['id_produk']).'">'.htmlspecialchars($rowProduct['nama_produk']).'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="textInput" class="form-label">No. Whatsapp</label>
                        <input type="text" class="form-control" id="textInput" placeholder="No. Whatsapp" aria-label="No. Whatsapp" name="no_wa" required>
                    </div>
                    <div class="col-md-4">
                        <label for="textInput" class="form-label">Kota</label>
                        <input type="text" class="form-control" id="textInput" placeholder="Asal Kota" aria-label="Kota" name="kota" required>
                    </div>
                </div>

                <div class="mb-5"></div>
                <div class="mb-5 d-flex justify-content-center gap-2 mt-3">
                    <button type="submit" class="btn btn-success w-20" style="background-color: #6f42c1; padding: 10px 40px; border-radius: 20px;">
                            Simpan
                    </button>

                    <button type="button" class="btn btn-light w-10" style="background-color: #F3F3F3; padding: 10px 40px; border-radius: 20px;">
                        <a href="./home.php" class="text-black text-decoration-none">
                            Cancel
                        </a>
                    </button>
                </div>
            </form>
        </div>
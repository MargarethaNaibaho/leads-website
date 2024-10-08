<?php
// Session admin
session_start();
error_reporting(0);
include './connection/connection.php';

if(!isset($_SESSION['admin'])) {
	echo "<script>alert('Hei, kamu! Kamu belum login. Silahkan login terlebih dahulu.');</script>";
	echo "<script>location='index.php';</script>";
	exit();
}

if(isset($_GET['id'])){
    $id_leads = (int) $_GET['id'];

    $ambil = $connection->prepare("SELECT * FROM leads WHERE id_leads = ?");
    $ambil->bind_param("i", $id_leads);
    $ambil->execute();
    $result = $ambil->get_result();

    if($result->num_rows > 0){
        $deleteStmt = $connection->prepare("DELETE FROM leads WHERE id_leads = ?");
        $deleteStmt->bind_param("i", $id_leads);

        if($deleteStmt->execute()){
            echo "<script>alert('Leads Berhasil Dihapus');</script>";
        } else{
            echo "<script>alert('Gagal menghapus Leads: " . $deleteStmt->error . "');</script>";
        }

        $deleteStmt->close();
    } else{
        echo "<script>alert('Data tidak ditemukan');</script>";
    }

    $ambil->close();
} else{
    echo "<script>alert('ID tidak valid');</script>";
}

echo "<script>location='./home.php';</script>";
exit();
?> 
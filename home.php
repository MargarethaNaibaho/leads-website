<?php
session_start();
error_reporting(0);

include 'connection/connection.php';

if(!isset($_SESSION['admin'])) {
	echo "<script>alert('Hei, kamu! Kamu belum login. Silahkan login terlebih dahulu.');</script>";
	echo "<script>location='index.php';</script>";
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leads Website</title>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style2.css">
    
</script>

<style>
    .dataTables_wrapper .row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .dataTables_length select {
        display: inline-block;
        width: auto;
        margin-left: 0.5rem;
    }

    .dataTables_length{
        float: left !important;
    }

    .dataTables_filter {
        float: right !important;
        text-align: right;
        margin-bottom: 10px;
    }
    .dataTables_filter label {
        display: flex;
        align-items: center;
    }

    .dataTables_paginate {
        float: right !important;
        margin-top: 20px;
    }

    .dataTables_filter input {
        width: auto;
        margin-left: 10px;
    }

    .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter {
        display: inline-block;
        margin-top: 0.5rem;
    }
</style>
</head>
<body>

    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button id="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>   
                </button>
                <div class="sidebar-logo">
                    <a href="#">United Tractor</a>
                </div>
            </div>

            <ul class="sidebar-nav">

                <li class="sidebar-item active" id="leads-sidebar">
                    <a href="home.php?halaman=dataleads" class="sidebar-link">
                    <i class="lni lni-calculator-alt"></i>
                        <span>Leads</span>
                    </a>
                </li>

                <li class="sidebar-item" id="products-sidebar">
                    <a href="home.php?halaman=dataproduk" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Products</span>
                    </a>
                </li>

                <li class="sidebar-item" id="sales-sidebar">
                    <a href="home.php?halaman=datasales" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Sales</span>
                    </a>
                </li>

            </ul>

            <div class="sidebar-footer">
                <a href="home.php?halaman=logout" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>

        </aside>

        <?php
        if(isset($_GET['halaman'])){
            if($_GET['halaman'] == 'dataleads'){
                include 'leads/data_leads.php';
            }
            else if($_GET['halaman'] == 'tambahleads'){
                include 'leads/add_new_leads.php';
            } else if($_GET['halaman'] == 'hapusleads'){
                include 'leads/delete_lead.php';
            } else if($_GET['halaman'] == 'ubahleads'){
                include 'leads/update_lead.php';
            } else if($_GET['halaman'] == 'dataproduk'){
                include 'product/data_products.php';
            } else if($_GET['halaman'] == 'tambahproduk'){
                include 'product/add_new_product.php';
            } else if($_GET['halaman'] == 'ubahproduk'){
                include 'product/update_product.php';
            } else if($_GET['halaman'] == 'datasales'){
                include 'sales/data_sales.php';
            } else if($_GET['halaman'] == 'tambahsales'){
                include 'sales/add_new_sales.php';
            } else if($_GET['halaman'] == 'ubahsales'){
                include 'sales/update_sale.php';
            } else if($_GET['halaman'] == 'logout'){
                include 'logout.php';
            }
        } else{
            include 'leads/data_leads.php';
        }
        
        ?>
    </div>

<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap5.min.js"></script>

<!-- Script custom -->
<script src="js/script.js"></script>

    <script>
    $(document).ready(function() {
        $('#data').DataTable();

        $('.sidebar-item a').on('click', function() {
            $('.sidebar-item').removeClass('active');
            $(this).closest('.sidebar-item').addClass('active');
        });

        var currentPage = new URLSearchParams(window.location.search).get('halaman');
        $('.sidebar-item').removeClass('active');

        if (!currentPage || currentPage === 'dataleads' || currentPage === "tambahleads" || currentPage === "hapusleads" || currentPage === "ubahleads") {
            $('#leads-sidebar').addClass('active');
        } else if (currentPage === 'dataproduk' || currentPage === "tambahproduk" || currentPage === "ubahproduk") {
            $('#products-sidebar').addClass('active'); 
        } else if (currentPage === 'datasales' || currentPage === "tambahsales" || currentPage === "ubahsales") {
            $('#sales-sidebar').addClass('active'); 
        }
    });
    </script>
</body>
</html>
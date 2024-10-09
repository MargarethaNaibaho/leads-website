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
        /* Custom CSS for DataTables */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5rem 1rem;
            margin: 0 0.1rem;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #007bff;
            color: white;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #0056b3;
            color: white;
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
    
    <script src="js/datatables/jquery-3.7.1.js"></script>
    <!-- <script src="js/datatables/bootstrap.bundle.min.js"></script> -->
    <script src="js/datatables/dataTables.bootstrap5.js"></script>
    <script src="js/datatables/dataTables.js"></script>
    <script src="js/script.js"></script>

    <script>
    $(document).ready(function() {
        $('#data').DataTable();

        // Remove active class from all sidebar items and add it to the clicked item
        $('.sidebar-item a').on('click', function() {
            $('.sidebar-item').removeClass('active');
            $(this).closest('.sidebar-item').addClass('active');
        });

        // Set the active sidebar item based on the current URL parameters
        var currentPage = window.location.search;
        if (currentPage === '') {
            $('#leads-sidebar').addClass('active'); // Keep Leads active by default
        } else if (currentPage.includes('halaman=dataproduk')) {
            $('#products-sidebar').addClass('active'); // Products active
        } else if (currentPage.includes('halaman=datasales')) {
            $('#sales-sidebar').addClass('active'); // Sales active
        }
    });
    </script>
</body>
</html>
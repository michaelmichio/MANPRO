<?php
 error_reporting(0);
 include_once('conect.php');
?>


<!DOCTYPE html>
<html>

<head>
    <link href="DataSection.css" rel="stylesheet">
    <link href="Form.css" rel="stylesheet">
    <link href="HeaderSection.css" rel="stylesheet">
    <link href="HeaderStyle.css" rel="stylesheet">
    <link href="./asset/css/bootstrap.css" rel="stylesheet">
    <link href="./asset/css/bootstrap.css" rel="stylesheet">
    <script src="./asset/js/bootstrap.bundle.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | DataTables</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="header-section-wraper">
            <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
                <div class="container px-4 px-lg-5">
                    <a class="navbar-brand" href="#page-top">Home</a>
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                        aria-label="Toggle navigation">
                        Menu
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Graph</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Search</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class='container'>
                <div class='header-section-title-wraper'>
                    <div class='row'>
                        <div class='col-sm-12 col-md-6 col-lg-6'>
                            <div class='header-section-margin'>
                                <h1 class='header-section-title'>Game</h1>
                                <h1 class='header-section-title'>Of Thrones</h1>
                            </div>

                            <div class="space">
                                <form action="" method="post">
                                    <label class='label-header'>Search Interaksi Karakter tertentu </label>
                                    <select name="buku">
                                        <option selected="true" value="0">
                                            Pilih Buku Yang Di Inginkan
                                        </option>
                                        <option value='1'>A Game Of Thrones</option>
                                        <option value='2'>A Clash Of Kings</option>
                                        <option value='3'>A Strom Of Swords</option>
                                        <option value='4'>A Feast For Crows</option>
                                        <option value='5'>A Dance With Dragons</option>
                                    </select>
                                    <input name="source" type="text"
                                        placeholder="Ketik Interaksi Karakter Yang Di Inginkan.." />
                                    <button type="submit" value="kirim">SUBMIT</button>
                                </form>
                            </div>
                        </div>
                        <div class='col-sm-12 col-md-6 col-lg-6'>
                            <div class='header-section-image'>
                                <img src='asset/image/header2.png' alt='headerimage' />
                            </div>
                        </div>
                    </div>
                </div>


                <div class='data-title-wraper'>
                    <h1 class='data-title-list'>Daftar Data Interaksi</h1>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">


                            <!-- Main content -->
                            <section class="content">
                                <div class="row">
                                    <div class="col-12">

                                        <!-- /.card -->

                                        <div class="card">

                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>NO</th>
                                                            <th>Berinteraksi</th>
                                                            <th>Total Interaksi</th>

                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php  
                                 
                                                        //end pagination 
                                                        $query = "SELECT * FROM interaksi WHERE source like '$a' AND book = '$b'";
                                                        if ($query === false){
                                                            die("error");
                                                        }
                                                    $res = mysqli_query($conn, $query);
                                                    $no = 1;
                                                    while($data =  mysqli_fetch_array($res)){
                                                    if ($data["buku"] == 1){
                                                    $buku = "Games of thrones";
                                                    }else if ($data["buku"] == 2){
                                                    $buku = "Clash of kings";
                                                    }else if ($data["buku"] == "3"){
                                                    $buku = "Strom of Swords";
                                                    }else if ($data["buku"] == 4){
                                                    $buku = "Feast for crows";
                                                    }else {
                                                    $buku = "Dance with dragons";
                                                    }
                                                    ?>

                                                        
                                                            <tr>
                                                                <td><?php echo $no++; ?></td>
                                                                <td><?php echo $data["target"]; ?></td>
                                                                <td><?php echo $data["weight"]; ?></td>
                                                            </tr>
                                                        <?php 

                                                            }
                                                            ?>
                                                    </tbody>

                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </section>
                            <!-- /.content -->

                            <!-- /.content-wrapper -->


                            <!-- Control Sidebar -->
                            <aside class="control-sidebar control-sidebar-dark">
                                <!-- Control sidebar content goes here -->
                            </aside>
                            <!-- /.control-sidebar -->

                        </div>
                    </div>
                </div>

            </div>
        </div>






    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- page script -->
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script src="js/scripts.js"> </script>
</body>

</html>
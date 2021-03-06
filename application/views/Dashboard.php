<!DOCTYPE html>
<html lang="en">
<head>
    <title>Kasir | Dashboard</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">

    <!-- Linearicons CDN -->
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <style type="text/css" media="all">
        .ui-autocomplete.ui-widget {
            font-family: Verdana,Arial,sans-serif,Segoe UI;
            font-size: 12px;
        }
        .w-25 {
            float: left;
            border: none;
            font-size: 40px;
        }
        p {
            font-family: Verdana,Arial,sans-serif,Segoe UI;
            font-size: 12px;
            color: #999;
        }
        .table-wrapper-2 {
            display: block;
            max-height: 300px;
            overflow-y: auto;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }
    </style>

    <?php
    foreach($data as $data){
        $tanggal[] = $data->tanggal;
        //echo $data->tanggal."<br>";
        $total[] = (float) $data->total;
    }

    foreach($layanan as $data){
        $tanggalLayanan[] = $data->tanggal;
        //echo $data->tanggal."<br>";
        $totalLayanan[] = (float) $data->total;
    }
    ?>
</head>
<body>
<div id="wrapper">

    <nav class="navbar navbar-expand-lg fixed-top">
        <a class="navbar-brand" href="#">ServiceCorner</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

        </div>
    </nav>

    <div class="row">

        <div class="col-xs-4">
            <div class="col-xs-12" id="sidebar-wrapper">
                <div class="sidebar">
                    <ul class="sidebar-nav">
                        <li class="active">
                            <a href="<?php echo base_url()?>"><span class="lnr lnr-home"></span>Dashboard</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('kasir/transaksi')?>"><span class="lnr lnr-cart"></span>Penjualan</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('partstok')?>"><span class="lnr lnr-database"></span>Stok</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('kasir/logout')?>"><span class="lnr lnr-exit"></span>Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xs-8">
            <div id="page-content-wrapper">
                <h3>Dashboard</h3>
                <?php if ($user_role == 'admin') { ?>
                    <div class="row container-fluid p-4 ml-1 rounded mt-4" style="background-color: whitesmoke">
                        <div class="col-md-6">
                            <h4>Grafik Penjulanan</h4>
                            <canvas id="penjualan" width="1000" height="400"></canvas>
                        </div>

                        <div class="col-md-6">
                            <h4>Grafik Service</h4>
                            <canvas id="layanan" width="1000" height="400"></canvas>
                        </div>

                    </div>
                    <div class="row container-fluid p-4 ml-1 rounded mt-4" style="background-color: whitesmoke">
                        <div class="col-sm-3">
                            <div class="card text-right">
                                <div class="card-body">
                                    <div class="card w-25">
                                        <span class="lnr lnr-users"></span>
                                    </div>
                                    <p class="card-title">Total Pelanggan</p>
                                    <h5 class="card-text"><?php echo $countPel ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card text-right">
                                <div class="card-body">
                                    <div class="card w-25">
                                        <span class="lnr lnr-tag"></span>
                                    </div>
                                    <p class="card-title"></i>Total Omset</p>
                                    <h5 class="card-text"><?php echo "Rp" . number_format($profit->profit, 2, ',', '.') ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card text-right">
                                <div class="card-body">
                                    <div class="card w-25">
                                        <span class="lnr lnr-cart"></span>
                                    </div>
                                    <p class="card-title">Total Part Terjual</p>
                                    <h5 class="card-text"><?php echo $partsale->total ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card text-right">
                                <div class="card-body">
                                    <div class="card w-25">
                                        <span class="lnr lnr-cog"></span>
                                    </div>
                                    <p class="card-title">Total Pelayanan Service</p>
                                    <h5 class="card-text"><?php echo $countLay ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="container-fluid p-4 ml-1 rounded mt-4" style="background-color: whitesmoke">
                    <h4>Tabel Transaksi</h4>
                    <div class="mt-3 mb-3">
                        <input type="date" class="form-control" id="cari" onchange="myFunction()" placeholder="Cari tanggal">
                    </div>
                    <div class="<?php if ($user_role == 'admin') echo "table-wrapper-2"?>">
                        <table class="table table-bordered table-light" id="tabel-transaksi">
                            <tr>
                                <th style="width: 5%">No.</th>
                                <th>Tanggal</th>
                                <th>Pelanggan</th>
                                <th>No. Polisi</th>
                                <th>Telpon</th>
                                <th>Total</th>
                                <th style="width: 5%">Detail</th>
                            </tr>
                            <?php
                            $count = 0;
                            foreach ($master as $item){
                                $count++;
                                ?>
                                <tr>
                                    <td><?php echo $count?></td>
                                    <td><?php echo $item->tanggal?></td>
                                    <td><?php echo $item->nama?></td>
                                    <td><?php echo $item->nopol_kendaraan?></td>
                                    <td><?php echo $item->no_telp?></td>
                                    <td style="text-align: right"><?php echo  "Rp".number_format( $item->total_tagihan,2,',','.')?></td>
                                    <td><a href="<?php echo base_url('service/print_struk/').$item->id_master?>"><button class="btn btn-info">Lihat Detail</button></a></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS, then Linearicons JS -->
<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.linearicons.com/free/1.0.0/svgembedder.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
<script src="http://code.jquery.com/jquery-migrate-3.0.0.js" ></script>

<!--Load chart js-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>

    var ctx = document.getElementById('penjualan').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels:<?php echo json_encode($tanggal);?>,
            datasets: [{
                label: "Penjualan Sparepart",
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                data: <?php echo json_encode($total);?>
            }]
        },


        // Configuration options go here
        options: {}
    });

</script>
<script>
    // backgroundColor: ["rgb(90, 208, 226)", "rgb(255, 155, 73)", "rgb(216, 60, 60)", "rgb(173, 62, 123)"],
    //     borderColor: ["rgb(90, 208, 226)", "rgb(255, 155, 73)", "rgb(216, 60, 60)", "rgb(173, 62, 123)"],

    var ctx = document.getElementById('layanan').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels:<?php echo json_encode($tanggalLayanan);?>,
            datasets: [{
                label: "Pelayanan Service",
                backgroundColor: 'rgb(216, 60, 60)',
                borderColor: 'rgb(216, 60, 60)',
                data: <?php echo json_encode($totalLayanan);?>
            }]
        },

        // Configuration options go here
        options: {}
    });
</script>

<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("cari");
  filter = input.value.toUpperCase();
  table = document.getElementById("tabel-transaksi");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Penjualan</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/select2.min.css'); ?>">

  <!-- Linearicons CDN -->
  <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
  <div id="wrapper">
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
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
              <li>
                <a href=""><span class="lnr lnr-home"></span>Dashboard</a>
              </li>
              <li>
                <a href=""><span class="lnr lnr-cart"></span>Penjualan</a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-xs-8">
        <div id="page-content-wrapper">
          <div class="container-fluid">

            <h4>Data Pelanggan</h4>
            <form action="">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="">Telp/HP</label>
                    <input type="text" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="">Nomor Polisi</label>
                    <input type="text" class="form-control">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Merk Motor</label>
                    <input type="text" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="">Tipe motor</label>
                    <input type="text" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="">Tahun</label>
                    <input type="text" class="form-control">
                  </div>
                </div>
              </div>
            </form>
            <br>

            <h4>Spare Parts</h4>
            <div id="spare-parts">
              <form action="" class="form-inline">
                <input type="text" class="form-control" name="spare-part" id="spare-part" placeholder="cari sparepart">
                <button type="submit" class="btn btn-success" id="btn-tambah">tambah</button>
              </form>
            </div>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Spare Part</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Front Brake</td>
                  <td>1</td>
                  <td>25000</td>
                </tr>
              </tbody>
            </table>

            <h4>Service</h4>
            <div id="services">
              <form action="" class="form-inline">
                <input type="text" class="form-control" name="service" id="service" placeholder="cari service">
                <button type="submit" class="btn btn-success" id="btn-tambah">tambah</button>
              </form>
            </div>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Jenis Service</th>
                  <th>Biaya</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>ringan</td>
                  <td>100000</td>
                </tr>
              </tbody>
            </table>

            <button class="btn btn-success float-right">next</button>
          </div>
          <!-- /.container-fluid -->
        </div>  
      </div>

    </div>
  </div>
  
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS, then Linearicons JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdn.linearicons.com/free/1.0.0/svgembedder.min.js"></script>
  <script src="<?php echo base_url('assets/js/select2.min.js'); ?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
  <script>
    $('select').select2();
  </script>

  <!-- ajax typeahead -->
  <script>
    $(document).ready(function(){
  
      $('#spare-part').typeahead({
        source: function(query, result)
        {
        $.ajax({
          url:"<?php echo base_url('ajaxsearch/fetch'); ?>",
          method:"POST",
          data:{query:query},
          dataType:"json",
          success:function(data)
          {
          result($.map(data, function(item){
            return item;
          }));
          }
        })
        }
      });

      $('#service').typeahead({
        source: function(query, result)
        {
        $.ajax({
          url:"<?php echo base_url('ajaxsearch/fetch1'); ?>",
          method:"POST",
          data:{query:query},
          dataType:"json",
          success:function(data)
          {
          result($.map(data, function(item){
            return item;
          }));
          }
        })
        }
      });
    
    });
  </script>
</body>
</html>
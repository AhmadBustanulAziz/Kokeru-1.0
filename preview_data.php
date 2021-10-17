<?php include "db_login.php"; ?>
<?php include('header.php') ?>
<?php include('navbar_manajer.php') ?>

<html>
<head>
    <link rel="stylesheet" href="plugin/jquery-ui/jquery-ui.min.css" /> <!-- Load file css jquery-ui -->
    <script src="js/jquery.min.js"></script> <!-- Load file jquery -->
</head>
<body>

    <section style="margin-left: 100px; margin-right: 100px; margin-top: 25px;">
    <h5>Filter Berdasarkan</h5>
    <form style="display:flex;" method="get" action="">
        <select style="border: none; background: hsl(0 0% 93%); border-radius: .25rem; width: 110px; height: 33.38px;" name="filter" id="filter">
            <option value="">Pilih</option>
            <option value="1">Per Tanggal</option>
            <option value="2">Per Bulan</option>
            <option value="3">Per Tahun</option>
        </select>
        <br /><br />

        <div style="display:flex; margin-left: 10px;"id="form-tanggal">
            <input placeholder=" Pilih Tanggal" style="border: none; background: hsl(0 0% 93%); border-radius: .25rem; width: 110px; height: 33.38px;" value="tanggal" type="text" name="tanggal" class="input-tanggal"/>
          
        </div>
        <div>
            <div class="form-group">
                <div id="form-bulan">
                <select style="margin-left: 10px; border: none; background: hsl(0 0% 93%); border-radius: .25rem;  width: 110px; height: 33.38px;" name="bulan"  class="form-control">
                    <option value="">Pilih Bulan</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
                </div>
            </div>
        </div>

        <div id="form-tahun">
            <select style="margin-left: 10px; border: none; background: hsl(0 0% 93%); border-radius: .25rem; width: 110px; height: 33.38px;" name="tahun">
                <option value="">Pilih Tahun</option>
                <?php
                $query = "SELECT YEAR(tgl) AS tahun FROM laporan GROUP BY YEAR(tgl)"; // Tampilkan tahun sesuai di tabel transaksi
                $sql = mysqli_query($db, $query); // Eksekusi/Jalankan query dari variabel $query

                while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                    print_r( '<option value="'.$data['tahun'].'">'.$data['tahun'].'</option>';
                }
                ?>
            </select>
            <br /><br />
        </div>
         <div class="col-sm-4" >
            <button style="width: 100px;color: white;" type="submit" class="btn btn-primary"><b>Tampilkan</b></button>
            <button style="width: 100px;color: white; margin-left:5px" href="index2.php" class="btn btn-danger"><b>Reset</b></button>
        </div>
    </form>
    <hr />
    <div class="sectiontitle" style="margin-bottom:35px">
        <center>
             <h2 class="heading">Laporan Data Kontrol Kebersihan Ruangan</h2>
        </center>
    </div>
    

    <?php
    if(isset($_GET['filter']) && ! empty($_GET['filter'])){ 
        $filter = $_GET['filter']; // Ambil data filder yang dipilih user

        if($filter == '1'){ // Jika filter nya 1 (per tanggal)
            $tgl = date('d-m-y', strtotime($_GET['tanggal']));
            print_r( '<center>';
            print_r( '<h4><b>Tanggal '.$tgl.'</b></h4><br /><br />';
            print_r( '</center>';
            $query = "SELECT status, tgl, user.nama as username, ruang.nama as ruangname FROM user, ruang, laporan WHERE user.id_user = laporan.id_user AND ruang.id_ruang = laporan.id_ruang AND DATE(tgl)='".$_GET['tanggal']."' ORDER BY tgl"; // Tampilkan data  sesuai tanggal yang diinput oleh user pada filter
        }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
            $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
            print_r( '<center>';
            print_r( '<h4><b>Bulan '.$nama_bulan[$_GET['bulan']].' '.$_GET['tahun'].'</b></h4><br /><br />';
            print_r( '</center>';
             $query = "SELECT status, tgl, user.nama as username, ruang.nama as ruangname FROM user, ruang, laporan WHERE user.id_user = laporan.id_user AND ruang.id_ruang = laporan.id_ruang AND MONTH(tgl)='".$_GET['bulan']."' ORDER BY tgl"; // Tampilkan data  sesuai bulan dan tahun yang diinput oleh user pada filter
        }else{ // Jika filter nya 3 (per tahun)
            print_r( '<center>';
            print_r( '<h4><b>Tahun '.$_GET['tahun'].'</b></h4><br /><br />';
            print_r( '</center>';
             $query = "SELECT status, tgl, user.nama as username, ruang.nama as ruangname FROM user, ruang, laporan WHERE user.id_user = laporan.id_user AND ruang.id_ruang = laporan.id_ruang AND YEAR(tgl)='".$_GET['tahun']."' ORDER BY tgl"; // Tampilkan data sesuai tahun yang diinput oleh user pada filter
        }
    }else{ // Jika user tidak mengklik tombol tampilkan
        print_r( '<center>';
        print_r( '<h4>Semua Data</h4><br/><br />';
        print_r( '</center>';
         $query = "SELECT status, tgl, user.nama as username, ruang.nama as ruangname FROM user, ruang, laporan WHERE user.id_user = laporan.id_user AND ruang.id_ruang = laporan.id_ruang ORDER BY tgl"; 
    }
    ?>

    <table border="1" style="width: 100%">
   <tr>
        <th width="1%">No</th>
        <th style="text-align: center;">Tanggal</th>
        <th style="text-align: center;">Nama CS</th>
        <th style="text-align: center;">Ruangan</th>
        <th style="text-align: center;">Status</th>
    </tr>
    <?php
    $sql = mysqli_query($db, $query); // Eksekusi/Jalankan query dari variabel $query
    $row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql
    $no = 1;
    if($row > 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
        while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
            $tgl = date('d-m-Y', strtotime($data['tgl'])); // Ubah format tanggal jadi dd-mm-yyyy

            print_r( "<tr>";
            print_r( "<td>".$no++."</td>";
            print_r( "<td>".$tgl."</td>";
            print_r( "<td>".$data['username']."</td>";
            print_r( "<td>".$data['ruangname']."</td>";
            print_r( "<td>".$data['status']."</td>";
            print_r( "</tr>";
        }
    }else{ // Jika data tidak ada
        print_r( "<tr><td colspan='5'>Data tidak ada</td></tr>";
    }
    ?>
    </table>
    <a style="margin-bottom: 25px;" type="button" onclick="window.print();return false" target="_blank" id="filter" name="filter" class="btn btn-success"><b>Print</b></a>
    </section>
    <div class="clear"></div>
    <?php include('footer.php') ?>
    <script>
    $(document).ready(function(){ // Ketika halaman selesai di load
        $('.input-tanggal').datepicker({
            dateFormat: 'yy-mm-dd' // Set format tanggalnya jadi yyyy-mm-dd
        });

        $('#form-tanggal, #form-bulan, #form-tahun').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya

        $('#filter').change(function(){ // Ketika user memilih filter
            if($(this).val() == '1'){ // Jika filter nya 1 (per tanggal)
                $('#form-bulan, #form-tahun').hide(); // Sembunyikan form bulan dan tahun
                $('#form-tanggal').show(); // Tampilkan form tanggal
            }else if($(this).val() == '2'){ // Jika filter nya 2 (per bulan)
                $('#form-tanggal').hide(); // Sembunyikan form tanggal
                $('#form-bulan, #form-tahun').show(); // Tampilkan form bulan dan tahun
            }else{ // Jika filternya 3 (per tahun)
                $('#form-tanggal, #form-bulan').hide(); // Sembunyikan form tanggal dan bulan
                $('#form-tahun').show(); // Tampilkan form tahun
            }

            $('#form-tanggal input, #form-bulan select, #form-tahun select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
        })
    })
    </script>
    <script src="plugin/jquery-ui/jquery-ui.min.js"></script> <!-- Load file plugin js jquery-ui -->
</body>
</html>

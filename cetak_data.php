<?php include('header.php') ?>
<?php include('navbar_manajer.php') ?>

<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <main class="hoc container clear" style="padding-top:20px"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <section id="introblocks">
    	<h4>Filter</h4>
    	<form method="POST" action="">
        	<div class="row mb-3">
		    	<div class="col-sm-3">
			        <div class="form-group">
			            <select name="bulan" id="bulan" class="form-control">
			                <option selected="true" disabled="disabled">Bulan</option>
			                <option value="Januari">Januari</option>
			                <option value="Februari">Februari</option>
			                <option value="Maret">Maret</option>
			                <option value="April">April</option>
			                <option value="Mei">Mei</option>
			                <option value="Juni">Juni</option>
			                <option value="Juli">Juli</option>
			                <option value="Agustus">Agustus</option>
			                <option value="September">September</option>
			                <option value="Oktober">Oktober</option>
			                <option value="November">November</option>
			                <option value="Desember">Desember</option>
			            </select>
			        </div>
		   		</div>
			    <div class="col-sm-3">
			    	<div class="form-group">
			            <select name="nama_cs" id="nama_cs" class="form-control">
			                <option selected="true" disabled="disabled">Nama CS</option>
			                <option value="CS1">Novian</option>
			                <option value="CS2">Puji</option>
			            </select>
			        </div>
			    </div>
			    <div class="col-sm-4" >
			        <button id="filter" name="filter" value="filter" class="btn btn-warning">Filter</button>
			        <button style="margin-left:5px" id="filter" name="filter" value="reset" class="btn btn-danger">Reset</button>
			    </div>
			</div>
		</form>

    <div class="sectiontitle" style="margin-bottom:25px">
    	<center>
		     <h2 class="heading">Laporan Data Kontrol Kebersihan Ruangan</h2>
		     <hr />
		</center>
    </div>
	<table border="1" style="width: 100%">
			<tr>
	            <th width="1%">No</th>
	            <th style="text-align: center;">Tanggal</th>
	            <th style="text-align: center;">Nama CS</th>
	            <th style="text-align: center;">Ruangan</th>
	        </tr>
	        
 <!--   <?php 
        //include 'koneksi.php';
        //$no = 1;
        //$query = mysql_query("select * from tb_barang_masuk");
        //while($data = mysql_fetch_array($query)){
        ?>
        <tr>
            <td>
            	<?php echo $no++; ?>
            </td>
            <td><?php echo $data['tanggal']; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['jumlah']; ?></td>
        </tr>
        <?php 
        //}
    ?> -->
	</table> 
	<div class="col-sm-4" >
		<a type="button" id="filter" name="filter" class="btn btn-success">Print</a>
	</div>
		
    <script>
   		window.print();
    </script>
    </section>
    <div class="clear"></div>
  </main>
</div>
<?php include('footer.php') ?>
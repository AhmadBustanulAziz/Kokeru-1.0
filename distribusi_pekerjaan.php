<!DOCTYPE html>
<?php include('header.php')?>
<?php include('navbar_manajer.php') ?>

<?php
  include 'db_login.php';
  session_start();
  $user=$_SESSION['username'];

  $quser=mysqli_query($db,"SELECT * FROM user")or die(mysqli_error());
  $ruser=mysqli_fetch_array($quser);
  $id_user = $ruser['id_user'];
  $qlaporan=mysqli_query($db,"SELECT * FROM laporan")or die(mysqli_error());
  $rlaporan=mysqli_fetch_array($qlaporan);

  $id_ruang = $rlaporan['id_ruang'];
  $qruang=mysqli_query($db,"SELECT * FROM ruang")or die(mysqli_error());
  $rruang=mysqli_fetch_array($qruang);
  $nama_ruang = $rruang['nama'];

  $id_user = $rlaporan['id_user'];
  $nama_cs = $ruser['nama'];
  $quser=mysqli_query($db,"SELECT * FROM user")or die(mysqli_error());
  $ruser=mysqli_fetch_array($quser);
?>

<?php
if (isset($_POST["delete"])) {
    $valid = TRUE;

    if($valid){
        $query = " DELETE laporan WHERE i='$id_laporan'";
        #execute query
        $result =$db->query($query);
        if (!$result) {
            die ("could not query the database: <br>".$db->error.'<br>Query:'.$query);
        }
    
        #close connection
        $db->close();
    }
}
?>

<div class="wrapper row3">
  <main class="hoc container clear" style="padding-top:50px"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <section id="introblocks">
      <div class="sectiontitle" style="margin-bottom:25px">
        <h1 class="heading">DISTRIBUSI PEKERJAAN</h1>
        <br/>
        <h6 class="heading">Monitoring Kebersihan dan Kerapihan Ruang</h6>
        <h6 class="heading">Gedung Bersama Maju</h6><br>
      </div>
    </section>
    <!-- main body -->
    <!-- ################################################################################################ -->
    <div class="card shadow mb-4">
      <div class="table-responsive">
			<a href="update_ruang_manager.php" type="button" class="btn btn-success float-right">
				<span class="fa fa-plus"> Tambah Baru
				</span>
			</a>	  
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			  <thead>
                  <tr>
                    <th width="1%">No.</th>
                    <th style="text-align: center;">Nama Customer Services</th>
                    <th style="text-align: center;">Ruangan</th>
                    <th width="150px" style="text-align: center;">Action Ruang</th>
                  </tr>
                </thead>
                <tbody>
			  <script>
				function confirmationDelete(anchor){
				var conf = confirm('Yakin hapus cs dan ruang?');
				if(conf)
					window.location=anchor.attr("href");
				}
			  </script>
			<?php
				require_once('db_login.php');
				$query = " SELECT laporan.id_laporan as id_laporan, user.nama AS nama, ruang.nama AS ruang FROM `user`,`ruang`,`laporan` WHERE user.role=2 AND laporan.id_user=user.id_user AND laporan.id_ruang = ruang.id_ruang ";
				$result = $db->query($query);
				if (!$result){
					die ("Could not query the database: <br />". $db->error ."<br>Query: ".$query);
				}
				$i = 1;
				while ($row = $result->fetch_object()){
                  print_r('<tr>');
                    print_r('<td>'.$i. '</td>');
                    print_r('<td>'.$row->nama. '</td>');
                    print_r('<td>'.$row->ruang. '</td>');
					print_r('<td>
                      <!-- Button Edit Ruang -->
                      <button type="button" class="btn btn-danger" value="delete">
					  <a onclick="javascript:confirmationDelete($(this));return false;" class="btn btn-danger btn-sm" href="delete.php?id_laporan='.$row->id_laporan.'">
                        <span class="fa fa-trash"> Hapus
                        </span>
                      </a> </td>');
					 print_r('</tr>');
					 $i++;
				}
				  $result->free();
				  $db->close();
			?>
                </tbody>
          </table>
      </div>
    </div>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>

<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<?php include('footer.php') ?>
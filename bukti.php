<?php
  include 'db_login.php';
  session_start();
  $user=$_SESSION['username'];
  $id_laporan=$_GET['id_laporan'];

  $quser=mysqli_query($db,"SELECT * FROM user where email='$user'")or die(mysqli_error());
  $ruser=mysqli_fetch_array($quser);
  $id_user = $ruser['id_user'];
  $qlaporan=mysqli_query($db,"SELECT * FROM laporan where id_laporan ='$id_laporan'")or die(mysqli_error());
  $rlaporan=mysqli_fetch_array($qlaporan);

  $id_ruang = $rlaporan['id_ruang'];
  $qruang=mysqli_query($db,"SELECT * FROM ruang where id_ruang='$id_ruang'")or die(mysqli_error());
  $rruang=mysqli_fetch_array($qruang);

  $id_user = $rlaporan['id_user'];
  $quser=mysqli_query($db,"SELECT * FROM user where id_user='$id_user'")or die(mysqli_error());
  $ruser=mysqli_fetch_array($quser);
?>

<?php include('header.php') ?>
<?php include('navbar_manajer.php') ?>

<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->

<div class="wrapper row3">
  <main class="hoc container clear" style="padding-top:50px"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <section id="introblocks">
      <div class="sectiontitle" style="margin-bottom:25px">
        <h1 class="heading">Bukti Hasil</h1>
		<hr>
      </div>
    </section>
    <!-- main body -->
    <!-- ################################################################################################ -->
		<form method="POST" action="" enctype="multipart/form-data">
        	<div class="row mb-3">
		    	<div class="col-sm-12">
			        <div class="form-group">
					<h5>Ruang: </h5>
					<?php 
						echo '<h6 style="color:black">';
						echo $rruang['nama'];
						echo '</h6>';
					?>
			        </div>
		   		</div>
			</div>
			<div class="row mb-3">
				<div class="col-sm-12">
			        <div class="form-group">
					<h5>CS:  </h5>
					<?php 
						echo '<h6>';
						echo $ruser['nama'];
						echo '</h6>';
					?>
			        </div>
		   		</div>
			</div>
		</form>
    <div class="card shadow mb-4">
      <div class="table-responsive">    
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr>
                    <th style="text-align: center;">Bukti</th>
                  </tr>
                </thead>
                <tbody>
			<?php
				$query = " SELECT * FROM laporan WHERE id_laporan='$id_laporan'";
				$result = $db->query($query);
				$row = $result->fetch_object();
				if (!$result){
					die ("Could not query the database: <br />". $db->error ."<br>Query: ".$query);
				}
				else{
					echo '<h5>bukti 1:</h5><img src="data:image/jpeg;base64,'.base64_encode($row->bukti1).'" alt="Tidak Ada Foto"/><hr>';
					echo '<h5>bukti 2:</h5><img src="data:image/jpeg;base64,'.base64_encode($row->bukti2).'" alt="Tidak Ada Foto"/><hr>';
					echo '<h5>bukti 3:</h5><img src="data:image/jpeg;base64,'.base64_encode($row->bukti3).'" alt="Tidak Ada Foto"/><hr>';
					echo '<h5>bukti 4:</h5><img src="data:image/jpeg;base64,'.base64_encode($row->bukti4).'" alt="Tidak Ada Foto"/><hr>';
					echo '<h5>bukti 5:</h5><img src="data:image/jpeg;base64,'.base64_encode($row->bukti5).'" alt="Tidak Ada Foto"/><hr>';
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
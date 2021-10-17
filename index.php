<?php
  include 'db_login.php';
  session_start();
  $qlaporan=mysqli_query($db,"SELECT * FROM laporan")or die(mysqli_error());
  $rlaporan=mysqli_fetch_array($qlaporan);	
?>


<?php include('header.php') ?>
<?php include('navbar_all.php') ?>


<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <main class="hoc container clear" style="padding-top:50px"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <section id="introblocks">
      <div class="sectiontitle" style="margin-bottom:25px">
        <h6 class="heading">Monitoring Kebersihan dan Kerapihan Ruang</h6>
        <h6 class="heading">Gedung Bersama Maju</h6>
		<br>
		<?php
			date_default_timezone_set('Asia/Jakarta');
			$date = new DateTime();
			echo $date->format('l, d F Y H:i').' WIB';
		?>
      </div>
      <ul class="nospace group" style="color:white">
		<?php  	
			$i = 0;
				if (fmod($i,4) == 0){
					echo '<li class="one_quarter first"';
				}
				else{
					echo '<li class="one_quarter"';
				}
				if ($rlaporan['status'] == 'SUDAH'){
					echo 'style="background-color:green">';						
				}
				else{
					echo 'style="background-color:orange">';						
				}
				echo '<article style="padding:25px">';
				echo '<p style="font-size:30px">';
				$id_ruang = $rlaporan['id_ruang'];
				$qruang=mysqli_query($db,"SELECT * FROM ruang where id_ruang='$id_ruang'")or die(mysqli_error());
				$rruang=mysqli_fetch_array($qruang);
				echo $rruang['nama'];
				echo '</p>';
				
				echo '<h6 style="margin-bottom:10px;">';
				echo $rlaporan['status'];
				echo '</h6>';

				echo '<p>';
				$id_user = $rlaporan['id_user'];
				$quser=mysqli_query($db,"SELECT * FROM user where id_user='$id_user'")or die(mysqli_error());
				$ruser=mysqli_fetch_array($quser);
				echo $ruser['nama'];
				echo '</p>';
				echo '</article>';
				echo '</li>';
				$i = $i+1;			
			while ($row = $qlaporan->fetch_object()){
				if (fmod($i,4) == 0){
					echo '<li class="one_quarter first"';
				}
				else{
					echo '<li class="one_quarter"';
				}
				if ($row->status == 'SUDAH'){
					echo 'style="background-color:green">';						
				}
				else{
					echo 'style="background-color:orange">';						
				}
				echo '<article style="padding:25px">';
				echo '<p style="font-size:30px">';
				$id_ruang = $row->id_ruang;
				$qruang=mysqli_query($db,"SELECT * FROM ruang where id_ruang='$id_ruang'")or die(mysqli_error());
				$rruang=mysqli_fetch_array($qruang);
				echo $rruang['nama'];
				echo '</p>';
				
				echo '<h6 style="margin-bottom:10px;">';
				echo $row->status;
				echo '</h6>';

				echo '<p>';
				$id_user = $row->id_user;
				$quser=mysqli_query($db,"SELECT * FROM user where id_user='$id_user'")or die(mysqli_error());
				$ruser=mysqli_fetch_array($quser);
				echo $ruser['nama'];
				echo '</p>';
			
				echo '</article>';
				echo '</li>';
				$i = $i+1;
			}
		?>
      </ul>
    </section>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>

<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<?php include('footer.php') ?>
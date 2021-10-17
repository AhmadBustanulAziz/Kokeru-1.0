<?php
  include 'db_login.php';
  session_start();
  $user=$_SESSION['username'];
  $qlaporan=mysqli_query($db,"SELECT * FROM laporan")or die(mysqli_error());
  $rlaporan=mysqli_fetch_array($qlaporan);	
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
        <h6 class="heading">Monitoring Kebersihan dan Kerapihan Ruang</h6>
        <h6 class="heading">Gedung Bersama Maju</h6>
		<br>
		<?php
			date_default_timezone_set('Asia/Jakarta');
			$date = new DateTime();
			print_r( $date->format('l, d F Y H:i').' WIB';
		?>
      </div>
      <ul class="nospace group" style="color:white">
		<?php  	
			$i = 0;
				if (fmod($i,4) == 0){
					print_r( '<li class="one_quarter first"';
				}
				else{
					print_r( '<li class="one_quarter"';
				}
				if ($rlaporan['status'] == 'SUDAH'){
					print_r( 'style="background-color:green">';						
				}
				else{
					print_r( 'style="background-color:orange">';						
				}
				print_r( '<article style="padding:25px">';
				print_r( '<p style="font-size:30px">';
				$id_ruang = $rlaporan['id_ruang'];
				$qruang=mysqli_query($db,"SELECT * FROM ruang where id_ruang='$id_ruang'")or die(mysqli_error());
				$rruang=mysqli_fetch_array($qruang);
				print_r( $rruang['nama'];
				print_r( '</p>';
				
				print_r( '<h6 style="margin-bottom:10px;">';
				print_r( $rlaporan['status'];
				print_r( '</h6>';

				print_r( '<p>';
				$id_user = $rlaporan['id_user'];
				$quser=mysqli_query($db,"SELECT * FROM user where id_user='$id_user'")or die(mysqli_error());
				$ruser=mysqli_fetch_array($quser);
				print_r( $ruser['nama'];
				print_r( '</p>';
				if ($rlaporan['status'] == 'SUDAH'){
					print_r( '<footer><a class="btn btn-primary btn-sm" href="bukti.php?id_laporan='.$rlaporan['id_laporan'].'">Detail</a></footer>';
				}
				else{
					print_r( '<button onclick="warning()" class="btn btn-danger btn-sm">Detail</button>&nbsp;&nbsp';
				}
				print_r( '</article>';
				print_r( '</li>';
				$i = $i+1;			
			while ($row = $qlaporan->fetch_object()){
				if (fmod($i,4) == 0){
					print_r( '<li class="one_quarter first"';
				}
				else{
					print_r( '<li class="one_quarter"';
				}
				if ($row->status == 'SUDAH'){
					print_r( 'style="background-color:green">';						
				}
				else{
					print_r( 'style="background-color:orange">';						
				}
				print_r( '<article style="padding:25px">';
				print_r( '<p style="font-size:30px">';
				$id_ruang = $row->id_ruang;
				$qruang=mysqli_query($db,"SELECT * FROM ruang where id_ruang='$id_ruang'")or die(mysqli_error());
				$rruang=mysqli_fetch_array($qruang);
				print_r( $rruang['nama'];
				print_r( '</p>';
				
				print_r( '<h6 style="margin-bottom:10px;">';
				print_r( $row->status;
				print_r( '</h6>';

				print_r( '<p>';
				$id_user = $row->id_user;
				$quser=mysqli_query($db,"SELECT * FROM user where id_user='$id_user'")or die(mysqli_error());
				$ruser=mysqli_fetch_array($quser);
				print_r( $ruser['nama'];
				print_r( '</p>';
				if ($row->status == 'SUDAH'){
					print_r( '<footer><a class="btn btn-primary btn-sm" href="bukti.php?id_laporan='.$row->id_laporan.'">Detail</a></footer>';
				}
				else{
					print_r( '<button onclick="warning()" class="btn btn-danger btn-sm">Detail</button>&nbsp;&nbsp';
				}
				print_r( '</article>';
				print_r( '</li>';
				$i = $i+1;
			}
		?>
		<script>
		function warning() {
		  alert("Belum Ada Bukti");
		}
		</script>
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
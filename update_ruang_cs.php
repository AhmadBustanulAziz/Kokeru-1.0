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
<?php include('navbar_cs.php') ?>

<?php

if (isset($_POST["submit"])) {
    $valid = TRUE;
	
    if($valid){
		$imgData1 = addslashes(file_get_contents($_FILES['upload1']['tmp_name']));
		$imgData2 = addslashes(file_get_contents($_FILES['upload2']['tmp_name']));
		$imgData3 = addslashes(file_get_contents($_FILES['upload3']['tmp_name']));
		$imgData4 = addslashes(file_get_contents($_FILES['upload4']['tmp_name']));
		$imgData5 = addslashes(file_get_contents($_FILES['upload5']['tmp_name']));
        #assign a query
        $query = " UPDATE laporan SET status='SUDAH', bukti1='{$imgData1}', bukti2='{$imgData2}', bukti3='{$imgData3}', bukti4='{$imgData4}', bukti5='{$imgData5}' WHERE id_laporan='$id_laporan'";
        #execute query
        $result =$db->query($query);
        if (!$result) {
            die ("could not query the database: <br>".$db->error.'<br>Query:'.$query);
        }
        else {
            header('Location: index_cs.php');
        }
        #close connection
        $db->close();
    }
}
?>

<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <main class="hoc container clear" style="padding-top:20px"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <section id="introblocks">
		<div class="sectiontitle" style="margin-bottom:25px">
			<center>
				<h2 class="heading">Update Ruang</h2>
		     <hr />
			</center>
		</div>
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
			<div class="row mb-3">
				<div class="col-sm-12">
			        <div class="form-group">
						<label for="upload"><h5>Upload Bukti</h5></label>
						<br>bukti 1
						<input class="inputFile" type="file" id="upload1" name="upload1">
						<br>bukti 2
						<input class="inputFile" type="file" id="upload2" name="upload2">
						<br>bukti 3
						<input class="inputFile" type="file" id="upload3" name="upload3">
						<br>bukti 4
						<input class="inputFile" type="file" id="upload4" name="upload4">
						<br>bukti 5
						<input class="inputFile" type="file" id="upload5" name="upload5">
					</div>
		   		</div>
			</div>
			<div class="row mb-3">
			    <div class="col-sm-12" >
					<input type="submit" class="btn btn-success btn-lg btn-block" name="submit" value="submit">
			    </div>
			</div>
		</form>
    </section>
    <div class="clear"></div>
  </main>
</div>
<?php include('footer.php') ?>
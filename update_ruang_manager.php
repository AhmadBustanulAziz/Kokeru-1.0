<?php
  include 'db_login.php';
  session_start();
  $user=$_SESSION['username'];
?>

<?php include('header.php') ?>
<?php include('navbar_manajer.php') ?>

<?php
if (isset($_POST["submit"])) {
    $valid = TRUE;
	$cs = test_input($_POST['cs']);
	$ruang = test_input($_POST['ruang']);

    if($valid){
        $query = " INSERT INTO laporan(id_user,id_ruang, status) VALUES($cs, $ruang, 'BELUM')"; 
        #execute query
        $result =$db->query($query);
        if (!$result) {
            die ("could not query the database: <br>".$db->error.'<br>Query:'.$query);
        }
        else {
            header('Location: distribusi_pekerjaan.php');
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
				<h2 class="heading">Tambah Distribusi</h2>
		     <hr />
			</center>
		</div>
    	<form method="POST" action="">
        	<div class="row mb-3">
		    	<div class="col-sm-12">
			        <div class="form-group">
					<h5>CS: </h5>
					<select id="cs" name="cs" class="form-control"> 
					<?php
					$query = " SELECT * FROM user WHERE role=2";
					#execute query
					$result =$db->query($query);
					if (!$result) {
						die("Could not query the database: <br>".$db->error);
					}
					while ($row=$result->fetch_object()) {
						echo'<option value="'.$row->id_user.'">'.$row->nama.'</option>';
					}
					$result->free();
				?>
					</select>
			        </div>
		   		</div>
			</div>
			<div class="row mb-3">
		    	<div class="col-sm-12">
			        <div class="form-group">
					<h5>Ruang: </h5>
					<select id="ruang" name="ruang" class="form-control"> 
					<?php
					$query = " SELECT * FROM ruang ";
					#execute query
					$result =$db->query($query);
					if (!$result) {
						die("Could not query the database: <br>".$db->error);
					}
					while ($row=$result->fetch_object()) {
						echo'<option value="'.$row->id_ruang.'">'.$row->nama.'</option>';
					}
					$result->free();
					$db->close();
				?>
					</select>
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
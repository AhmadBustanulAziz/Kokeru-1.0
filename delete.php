<?php
  include 'db_login.php';
  session_start();
	$query=mysqli_query($db,"SELECT * FROM laporan where id_laporan='$id_laporan'")or die(mysqli_error());
	$row=mysqli_fetch_array($query);
    if(isset($_GET['id_laporan']))
      {
        $id_laporan=$_GET['id_laporan'];
        $query = " delete from laporan where id_laporan='$id_laporan' ";
        $result =$db->query($query);
        if($result)
          {
          header('location:distribusi_pekerjaan.php');
          }
      }
?>
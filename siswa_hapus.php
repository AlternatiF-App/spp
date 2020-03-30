<?php
if( empty( $_SESSION['iduser'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['submit'] )){
		$nis = $_REQUEST['nis'];
		$sql = mysqli_query($con, "DELETE FROM siswa WHERE nis='$nis'");
		if($sql > 0){
			header('Location: ./admin.php?hlm=master&sub=siswa');
			die();
		} else {
			echo 'ada ERROR dengan query';
		}
	} else {
		$nis = $_REQUEST['nis'];
		$sql = mysqli_query($con, "SELECT * FROM siswa WHERE nis='$nis'");
		list($nis,$siswa,$idrombel,$idjk) = mysqli_fetch_array($sql);
		
		echo '<div class="alert alert-danger">Yakin akan menghapus Siswa:';
		echo '<br>Nama  : <strong>'.$siswa.'</strong>';
		echo '<br>NIS   : '.$nis;
		
		$qrombel = mysqli_query($con, "SELECT rombel FROM rombel WHERE idrombel='$idrombel'");
		list($rombel) = mysqli_fetch_array($qrombel);
		
		echo '<br>Prodi : '.$rombel.' ('.$idrombel.')<br><br>';

		$qjk = mysqli_query($con, "SELECT jk FROM jenis_kelamin WHERE idjk='$idjk'");
		list($jk) = mysqli_fetch_array($qjk);
		
		echo '<br>Prodi : '.$jk.' ('.$idjk.')<br><br>';

		echo '<a href="./admin.php?hlm=master&sub=siswa&aksi=hapus&submit=ya&nis='.$nis.'" class="btn btn-sm btn-success">Ya, Hapus</a> ';
		echo '<a href="./admin.php?hlm=master&sub=siswa" class="btn btn-sm btn-default">Tidak</a>';
		echo '</div>';
	}
}
?>
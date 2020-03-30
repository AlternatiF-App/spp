<?php
if( empty( $_SESSION['iduser'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['aksi'] )){
		$aksi = $_REQUEST['aksi'];
		switch($aksi){
			case 'baru':
				include 'siswa_baru.php';
				break;
			case 'edit':
				include 'siswa_edit.php';
				break;
			case 'hapus':
				include 'siswa_hapus.php';
				break;
		}
	} else {
		$sql = mysqli_query($con, "SELECT * FROM siswa ORDER BY nis");

		echo '<h2>Daftar Siswa</h2><hr>';
		echo '<a class="noprint btn btn-default">Filter</a>';
		echo '<select name="nis" class="form-control">';
			
			$qkelas = mysqli_query($con, "SELECT kelas FROM kelas");
			while(list($kelas)=mysqli_fetch_array($qkelas)){
				echo '<option value="'.$kelas.'">'.$kelas.'</option>';
			}
		echo '</select>';

     	echo '<div class="row">';
		echo '<div class="col-md-9"><table class="table table-bordered">';
		echo '<tr class="info"><th>#</th><th width="100">NIS</th><th>Nama Lengkap</th><th>Rombel</th><th>Jenis  Kelamin</th>';
		echo '<th width="200"><a href="./admin.php?hlm=master&sub=siswa&aksi=baru" class="btn btn-default btn-xs">Tambah Data</a></th></tr>';
		
		if( mysqli_num_rows($sql) > 0 ){
			$no = 1;
			while(list($nis,$nama,$idrombel,$idjk) = mysqli_fetch_array($sql)){
				echo '<tr><td>'.$no.'</td>';
				echo '<td>'.$nis.'</td>';
				echo '<td>'.$nama.'</td>';
				$qrombel = mysqli_query($con, "SELECT rombel FROM rombel WHERE idrombel='$idrombel'");
				list($rombel) = mysqli_fetch_array($qrombel);
				echo '<td>'.$rombel.'</td>';

				$qjk = mysqli_query($con, "SELECT jk FROM jenis_kelamin WHERE idjk='$idjk'");
				list($jk) = mysqli_fetch_array($qjk);
				echo '<td>'.$jk.'</td>';				

				echo '<td><a href="./admin.php?hlm=master&sub=siswa&aksi=edit&nis='.$nis.'" class="btn btn-success btn-xs">Edit</a> ';
				echo '<a href="./admin.php?hlm=master&sub=siswa&aksi=hapus&nis='.$nis.'" class="btn btn-danger btn-xs">Hapus</a></td>';
				echo '</tr>';
				$no++;
			}
		} else {
			echo '<tr><td colspan="5"><em>Belum ada data</em></td></tr>';
		}
		
		echo '</table></div></div>';
	}
}
?>
<?php
if( empty( $_SESSION['iduser'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['submit'] )){
		$nis = $_REQUEST['nis'];
		$nama = $_REQUEST['nama'];
		$idrombel = $_REQUEST['idrombel'];
		$idjk = $_REQUEST['idjk'];
		
		$sql = mysqli_query($con, "UPDATE siswa SET nama='$nama', idrombel='$idrombel', idjk='$idjk' WHERE nis='$nis'");
		
		if($sql > 0){
			header('Location: ./admin.php?hlm=master&sub=siswa');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {
		$nis = $_REQUEST['nis'];
		$sql = mysqli_query($con, "SELECT * FROM siswa WHERE nis='$nis'");
		list($nis,$nama,$idrombel,$idjk) = mysqli_fetch_array($sql);
?>
<h2>Edit Data Siswa</h2>
<hr>
<form method="post" action="admin.php?hlm=master&sub=siswa&aksi=edit" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="nis" class="col-sm-2 control-label">NIS</label>
		<div class="col-sm-2">
			<input type="text" class="form-control" id="nis" name="nis" value="<?php echo $nis; ?>" readonly>
		</div>
	</div>
	<div class="form-group">
		<label for="nama" class="col-sm-2 control-label">Nama siswa</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>">
		</div>
	</div>
	<div class="form-group">
		<label for="rombel" class="col-sm-2 control-label">Rombel Kelas</label>
		<div class="col-sm-4">
			<select name="idrombel" class="form-control">
			<?php
			$qrombel = mysqli_query($con, "SELECT * FROM rombel ORDER BY idrombel");
			while(list($id,$rombel)=mysqli_fetch_array($qrombel)){
				echo '<option value="'.$id.'"';
				echo ($id==$idrombel) ? 'selected' : '';
				echo '>'.$rombel.'</option>';
			}
			?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="jk" class="col-sm-2 control-label">Jenis Kelamin</label>
		<div class="col-sm-4">
			<select name="idjk" class="form-control">
			<?php
			$qjk = mysqli_query($con, "SELECT * FROM rombel ORDER BY idjk");
			while(list($idjk,$jk)=mysqli_fetch_array($qjk)){
				echo '<option value="'.$idjk.'">'.$jk.'</option>';
			}
			?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-default">Simpan</button>
			<a href="./admin.php?hlm=master&sub=siswa" class="btn btn-link">Batal</a>
		</div>
	</div>
</form>
<?php
	}
}
?>
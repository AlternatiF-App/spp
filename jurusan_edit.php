<?php
if( empty( $_SESSION['iduser'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['submit'] )){
		$idrombel = $_REQUEST['idrombel'];
		$rombel = $_REQUEST['rombel'];
		
		$sql = mysqli_query($con, "UPDATE rombel SET rombel='$rombel' WHERE idrombel='$idrombel'");
		
		if($sql > 0){
			header('Location: ./admin.php?hlm=master&sub=jurusan');
			die();
		} else {
			echo 'ada ERROR dengan query';
		}
	} else {
		$idrombel = $_REQUEST['idrombel'];
		$sql = mysqli_query($con, "SELECT * FROM rombel WHERE idrombel='$idrombel'");
		list($idrombel,$rombel) = mysqli_fetch_array($sql);
?>
<h2>Edit Rombel</h2>
<hr>
<form method="post" action="admin.php?hlm=master&sub=jurusan&aksi=edit" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="idprodi" class="col-sm-2 control-label">ID Rombel</label>
		<div class="col-sm-2">
			<input type="text" class="form-control" id="idrombel" name="idrombel" value="<?php echo $idrombel; ?>" readonly>
		</div>
	</div>
	<div class="form-group">
		<label for="prodi" class="col-sm-2 control-label">Rombel</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="rombel" name="rombel" value="<?php echo $rombel; ?>">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-default">Simpan</button>
			<a href="./admin.php?hlm=master&sub=jurusan" class="btn btn-link">Batal</a>
		</div>
	</div>
</form>
<?php
	}
}
?>
<?php
$current_user_id = $this->session->user_id;
$last = $this->uri->total_segments();
$tahap = $this->uri->segment($last);
?>

<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Ilmiah Baru</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Tambah</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
	<div class="row">

		<div class="col-12">
			<?php if (isset($msg) || validation_errors() !== '') : ?>
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="fa fa-exclamation"></i> Terjadi Kesalahan</h4>
					<?= validation_errors(); ?>
					<?= isset($msg) ? $msg : ''; ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="col-md-6">
			<div class="card card-success card-outline">
				<div class="card-body box-profile">

					<?= form_open_multipart(base_url('residen/ilmiah/store/' . $tahap), '') ?>

					<div class="form-group">
						<div class="mt-3">
							<label class="control-label">Judul Ilmiah</label>
							<input type="text" name="judul_ilmiah" class="form-control" id="name" placeholder="">
						</div>

						<div class="mt-3">
							<label class="control-label">Deskripsi</label>
							<textarea class="form-control" name="deskripsi" id="deskripsi"></textarea>
						</div>

						<div class="mt-3">
							<div class="form-group">
								<label for="foto_profil" class="control-label">File</label>
								<div>
									<input type="file" name="file" class="form-control" id="dokumen">
								</div>
							</div>
						</div>

						<div class="mt-3">
							<div class="form-group">
								<label for="foto_profil" class="control-label">Kategori</label>
								<select class="custom-select" name="kategori">
									<?php foreach ($query as $kategori) { ?>
										<option value="<?=$kategori['id']?>"><?=$kategori['kategori']?></option>
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="form-group mt-2">
							<input type="submit" name="submit" value="Submit" class="btn btn-info">
						</div>
					</div>

					<?php echo form_close(); ?>

				</div>
			</div>
		</div>

	</div>
</section>

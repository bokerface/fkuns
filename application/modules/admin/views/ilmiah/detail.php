<!-- Content Header (Page header) -->

<!-- <link rel="stylesheet" href="<?= base_url('public/plugins/ekko-lightbox/ekko-lightbox.css'); ?>"> -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Ilmiah</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Ilmiah</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->


<section class="content">

	<?php if ($this->session->flashdata('msg') != '') { ?>
		<div class="alert alert-success flash-msg alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4>Success!</h4>
			<?= $this->session->flashdata('msg'); ?>
		</div>
	<?php } ?>



	<div class="container-fluid">
		<div class="row">

			<div class="col-md-3">

				<!-- Profile Image -->
				<div class="card card-olive card-outline">
					<div class="card-body box-profile">
						<div class="text-center">


						</div>

						<h3 class="profile-username text-center"><?=$author?></h3>
						<p class="text-muted text-center">Kategori</p>

						<ul class="list-group list-group-unbordered mb-3">
							<li class="list-group-item">
								<b>Pengunggah</b> <a class="float-right">Pengungggah</a>
							</li>
							<li class="list-group-item">
								<b>Tanggal</b> <a class="float-right">Tanggal</a>
							</li>
							<li class="list-group-item">
								<b>Status</b> <a class="float-right">Diterima</a>
							</li>

						</ul>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->

				<div class="card card-olive card-outline">
					<div class="card-header pl-3 pt-2 pb-2">
						Penilaian Reviewer
					</div>
					<div class="card-body" style="padding-top:0;">
						<input name="id_penelitian" type="hidden" value="id penelitian" />
						<input name="file_revisi_hidden" type="hidden" value="file revisi" />
						<input name="file_akhir_hidden" type="hidden" value="file akhir" />
						<input name="id_checklist_penilaian_hidden" type="hidden" value="id checklist penelitian" />
						<input name="hasil_penilaian_hidden" type="hidden" value="hasil penilaian" />
						<input name="komentar_reviewer_hidden" type="hidden" value="komentar reviewer" />
						<br />

						<strong>Penilaian</strong>

						<hr />
						<strong>Komentar</strong> <br />

						<hr />
						<strong>Penilaian</strong>



						<hr />

						<strong>Upload Revisi Penelitian </strong><br />
						<input name="file_revisi" type="file">


						<hr />

						<div class="text-right"><button type="submit" class="btn btn-success">Update</button></div>

						</form>
					</div>
				</div>
			</div>
			<!-- /.col -->
			<div class="col-md-9">
				<div class="card">
					<div class="card-header p-3">
						<h4>Judul Penelitian</h4>
					</div><!-- /.card-header -->
				</div>
				<div class="card">
					<div class="card-header pl-3 pt-2 pb-2">
						Deskripsi
					</div><!-- /.card-header -->

					<div class="card-body">

						Deskripsi

					</div>
				</div>



				<div class="card">
					<div class="card-header pl-3 pt-2 pb-2">
						Dokumen
					</div><!-- /.card-header -->
					<div class="card-body">

						<table class="table table-bordered table-striped">
							<tr>
								<th style="width:85%">Keterangan</th>
								<th>Dokumen</th>
							</tr>
							<tr>
								<td>Proposal</td>
								<td>

								</td>
							</tr>
							<tr>
								<td>Proposal Revisi</td>
								<td>

									<a href="" class="btn btn-warning btn-sm"><i class="fa fa-download"></i> Unduh</a>

								</td>
							</tr>
							<tr>
								<td>Laporan Penelitian</td>
								<td>

									<a href="" class="btn btn-warning btn-sm"><i class="fa fa-download"></i> Unduh</a>

								</td>
							</tr>
						</table>
					</div><!-- /.card-body -->
				</div>
				<!-- /.nav-tabs-custom -->

				
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- <script src="<?= base_url('public/plugins/ekko-lightbox/ekko-lightbox.min.js'); ?>"></script> -->
<!-- <script>
	$(function() {
		$(document).on('click', '[data-toggle="lightbox"]', function(event) {
			event.preventDefault();
			$(this).ekkoLightbox({
				alwaysShowClose: true
			});
		});
	})
</script> -->

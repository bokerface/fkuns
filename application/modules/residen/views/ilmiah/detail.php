<!-- Content Header (Page header) -->
<?php foreach ($query as $ilmiah) {
} ?>

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
						<h3 class="profile-username text-center"><?= $author ?></h3>

						<ul class="list-group list-group-unbordered mb-3">
							<li class="list-group-item">
								<b>Diunggah</b> <a class="float-right"><?= $ilmiah['date'] ?></a>
							</li>
						</ul>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->

				
			</div>
			<!-- /.col -->
			<div class="col-md-9">
				<div class="card">
					<div class="card-header p-3">
						<h4><?= $ilmiah['judul_ilmiah'] ?></h4>
					</div><!-- /.card-header -->
				</div>
				<div class="card">
					<div class="card-header pl-3 pt-2 pb-2">
						Deskripsi
					</div><!-- /.card-header -->
					<div class="card-body">
						<?= $ilmiah['deskripsi'] ?>
					</div>
					<div class="card-footer">
						<a href="" style="width: 10%;" class="btn btn-warning btn-sm"><i class="fa fa-download"></i> Unduh</a>
					</div>
				</div>
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>

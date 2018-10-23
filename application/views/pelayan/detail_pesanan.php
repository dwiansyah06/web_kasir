<div class="row">
	<div class="col-md-12">
		<h1 class="page-header">List Pesanan Aktif</h1>
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Nomor</th>
						<th>Kode Pesanan</th>
						<th>Nomor Meja</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i=1;
						foreach($pesanan as $value): 
					?>
					<tr>
						<td><?= $i++ ?></td>
						<td><?= $value->kd_pesanan ?></td>
						<td><?= $value->nmr_meja ?></td>
						<td><center><a href="<?= base_url().'pelayan/list_detail_pesanan/'.$value->kd_pesanan ?>" class="btn btn-primary">Edit</a></center></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
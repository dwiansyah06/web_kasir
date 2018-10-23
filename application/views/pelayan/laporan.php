<div class="row">
	<div class="col-md-12">
		<h1 class="page-header">Laporan</h1>
		<button class="btn btn-primary btn-sm" style="margin-bottom: 10px;" onclick="window.print()"><span class="fa fa-print"></span> Print</button>
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Nomor</th>
						<th>Kode Pesanan</th>
						<th>Nama Menu</th>
						<th>Harga</th>
						<th>Qty</th>
						<th>Sub Total</th>
						<th>Nomor Meja</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i=1;
						foreach($laporan as $value):
						$sub = $value->harga * $value->qty;
					?>
					<tr>
						<td><?= $i++ ?></td>
						<td><?= $value->kd_pesanan ?></td>
						<td><?= $value->nama_menu ?></td>
						<td>Rp <?= number_format($value->harga, 0, ',', '.') ?></td>
						<td><?= $value->qty ?></td>
						<td>Rp <?= number_format($sub, 0, ',', '.') ?></td>
						<td><?= $value->nmr_meja ?></td>
					</tr>
					<?php
						error_reporting(E_ALL^(E_NOTICE|E_WARNING));
						$gt = $gt + $sub; 
						endforeach; 
					?>
					<tr>
						<td colspan="5">Grand Total</td>
						<td colspan="2">Rp <?= number_format($gt, 0, ',', '.') ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
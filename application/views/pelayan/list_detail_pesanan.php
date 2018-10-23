<div class="row">
	<div class="col-md-12">
		<h1 class="page-header">List Detail Pesanan</h1>
		<!-- <button class="btn btn-primary btn-sm" style="margin-bottom: 10px;" data-toggle='modal' data-target='#modal-add'><span class="fa fa-plus"></span> Tambah Pesanan</button> -->
		<div class="sukses"></div>
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
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i=1;
						foreach($detail as $value):
						$kode = $value->kd_pesanan;
						$nmr_meja = $value->nmr_meja;
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
						<td>
							<center>
								<a href="<?= base_url()."pelayan/hapus_pesanan/$value->id_pesanan/$value->kd_pesanan"?>" class="btn btn-danger btn-sm" OnClick="return confirm('Yakin Mau Dihapus?')"><span class="fa fa-trash"></span></a>
								<button id="edit" class="btn btn-info btn-sm" data-toggle='modal' data-target='#modal-edit' data-id="<?= $value->id_pesanan ?>" data-nama="<?= $value->nama_menu ?>" data-harga="<?= $value->harga ?>" data-qty="<?= $value->qty ?>" ><span class="fa fa-edit"></span></button>
							</center>
						</td>
					</tr>
					<?php 
						error_reporting(E_ALL^(E_NOTICE|E_WARNING));
						$gt = $gt + $sub; 
						endforeach; 
					?>
					<tr>
						<td colspan="5">Grand Total</td>
						<td colspan="3">Rp <?= number_format($gt, 0, ',', '.') ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-lg" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Item Pesanan</h4>
      </div>
      <div class="modal-body" id="modal-menu">
      	<input type="hidden" name="kode_pesanan" value="<?= $kode ?>">
      	<input type="hidden" name="nmr_meja" value="<?= $nmr_meja ?>">
		<div class="form-group">
            <label>Nama Menu</label>
            <select id="menu" class="form-control">
                <option selected disabled value="">Pilih Menu</option>
                <?php foreach($menu as $value): ?>
                	<option value="<?= $value->nama_menu ?>" data-harga="<?= $value->harga ?>"><?= $value->nama_menu ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="text" id="txt-hrg" class="form-control" name="" readonly="">
        </div>
        <div class="form-group">
            <label>Qty</label>
            <input type="number" class="form-control" name="qty" placeholder="Quantity">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Pesanan</h4>
      </div>
	  <form id="form_edit" method="post">
      <div class="modal-body" id="modal-edit">
		<div class="form-group">
            <label>Nama Menu : </label>
            <label id="nm_menu"></label>
        </div>
        <div class="form-group">
            <label>Harga : </label>
            <label id="harga"></label>
        </div>
        <div class="form-group">
            <label>Nama Menu</label>
            <select id="menu-edit" name="menu_baru" class="form-control" required>
                <option selected disabled value="">Pilih Menu</option>
                <?php foreach($menu as $value): ?>
                	<option value="<?= $value->nama_menu ?>" data-harga="<?= $value->harga ?>"><?= $value->nama_menu ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="text" id="hrg-edit" class="form-control" name="harga_baru" readonly>
        </div>
        <div class="form-group">
            <label>Qty</label>
            <input type="hidden" name="id_pesanan" id="id_pesanan">
            <input type="hidden" name="menu_lama" id="menu_txt">
            <input type="hidden" name="harga_lama" id="hrg_txt">
            <input type="number" id="qty" class="form-control" name="qty" placeholder="Quantity">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Save Changes">
      </div>
	  </form>
    </div>
  </div>
</div>

<script>
	$("#menu").on("change", function(){
	    var harga = $("#menu :selected").attr("data-harga");
	    $("#txt-hrg").val(harga);
	});

  	$("#menu-edit").on("change", function(){
	    var harga = $("#menu-edit :selected").attr("data-harga");
	    $("#hrg-edit").val(harga);
	});

	$(document).on("click", "#edit", function(){
		var id = $(this).data('id');
		var nama = $(this).data('nama');
		var hrg = $(this).data('harga');
		var qty = $(this).data('qty');

		document.getElementById("nm_menu").innerHTML=nama;
		document.getElementById("harga").innerHTML=hrg;
		$("#modal-edit #id_pesanan").val(id);
		$("#modal-edit #menu_txt").val(nama);
		$("#modal-edit #hrg_txt").val(hrg);
		$("#modal-edit #qty").val(qty);
	});

	$("#form_edit").submit(function(e){
			e.preventDefault();
			var data = $('#form_edit').serialize();
			$.ajax({
				type: 'POST',
				url: "<?= base_url().'pelayan/update_data' ?>",
				data: data,
				success: function(result) {
                		window.location=(BaseUrl+'pelayan/detailPesanan');
						$('#modal-edit').modal('hide');
				}
			});
		});
</script> 
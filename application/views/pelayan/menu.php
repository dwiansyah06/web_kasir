<div class="row">
	<div class="col-md-12">
		<h1 class="page-header">List Daftar Menu</h1>
		<button class="btn btn-primary btn-sm" style="margin-bottom: 10px;" data-toggle='modal' data-target='#modal-add'><span class="fa fa-plus"></span> Tambah Menu</button>
		<div class="sukses"></div>
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Nomor</th>
						<th>Nama Menu</th>
						<th>Kategori</th>
						<th>Harga</th>
						<th>Stok</th>
            <th>Gambar</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i=1;
						foreach($menu as $value):
					?>
					<tr>
						<td><?= $i++ ?></td>
						<td><?= $value->nama_menu ?></td>
						<td><?= $value->kategori ?></td>
						<td>Rp <?= number_format($value->harga, 0, ',', '.') ?></td>
						<td><?= $value->stok ?></td>
						<td><img src="<?= base_url().'assets/images/'.$value->gambar?>" width="100"></td>
						<td>
							<center>
								<a href="<?= base_url()."pelayan/hapus_menu/$value->id_menu"?>"" class="btn btn-danger btn-sm" OnClick="return confirm('Yakin Mau Dihapus?')"><span class="fa fa-trash"></span></a>
								<button id="edit" class="btn btn-info btn-sm" data-toggle='modal' data-target='#modal-edit' data-id="<?= $value->id_menu ?>" data-nama="<?= $value->nama_menu ?>" data-harga="<?= $value->harga ?>" data-stok="<?= $value->stok ?>" ><span class="fa fa-edit" ></span></button>
							</center>
						</td>
					</tr>
					<?php
						endforeach; 
					?>
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
      <form method="post" id="form-tambah">
      <div class="modal-body" id="modal-menu">
        <div class="form-group">
          <label>Nama</label>
          <input type="text" class="form-control" name="nm_menu" required>
        </div>
        <div class="form-group">
          <label>Kategori</label>
          <select class="form-control" name="kategori" required>
            <option value="makanan">Makanan</option>
            <option value="minuman">Minuman</option>
          </select>
        </div>
        <div class="form-group">
          <label>Harga</label>
          <input type="number" class="form-control" name="harga" required>
        </div>
        <div class="form-group">
          <label>Stok</label>
          <input type="number" class="form-control" name="stok" required>
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
          <label>Nama</label>
          <input type="hidden" id="id_menu" name="id_menu">
          <input type="text" id="nama_menu" class="form-control" name="nm_menu">
        </div>
        <div class="form-group">
          <label>Harga</label>
          <input type="text" id="harga_menu" class="form-control" name="hrg_menu">
        </div>
        <div class="form-group">
          <label>Stok</label>
          <input type="text" id="stok_menu" class="form-control" name="stok">
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
  $("#form-tambah").submit(function(e){
      e.preventDefault();
      var data = $('#form-tambah').serialize();
      $.ajax({
        type: 'POST',
        url: "<?= base_url().'pelayan/tambah_menu' ?>",
        data: data,
        success: function(result) {
                  $(".sukses").html('<div class="alert alert-info"><span class="fa fa-check"></span> Berhasil Menambah Data</div>');
                  window.location=(BaseUrl+'pelayan/menu');
                  $('#modal-add').modal('hide');
        }
      });
    });

  $(document).on("click", "#edit", function(){
    var id = $(this).data('id');
    var nama = $(this).data('nama');
    var hrg = $(this).data('harga');
    var stok = $(this).data('stok');

    $("#modal-edit #id_menu").val(id);
    $("#modal-edit #nama_menu").val(nama);
    $("#modal-edit #harga_menu").val(hrg);
    $("#modal-edit #stok_menu").val(stok);
  });

  $("#form_edit").submit(function(e){
      e.preventDefault();
      var data = $('#form_edit').serialize();
      $.ajax({
        type: 'POST',
        url: "<?= base_url().'pelayan/update_menu' ?>",
        data: data,
        success: function(result) {
                  $(".sukses").html('<div class="alert alert-info"><span class="fa fa-check"></span> Berhasil Menambah Data</div>');
                  window.location=(BaseUrl+'pelayan/menu');
                  $('#modal-edit').modal('hide');
        }
      });
    });
</script>
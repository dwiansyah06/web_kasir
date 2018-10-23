<div class="row" id="konten">
	<?php foreach($meja as $value): ?>
	<div style="margin-top: 10px;">
		<div class="col-md-4" style="margin-bottom: 20px;">
			<div class="top">
				<center><h4>Meja <?= $value->id_meja ?></h4></center>
			</div>
				<?php  
					if ($value->status == 0) {
						echo "<div class='konten available'><center><h4>KOSONG</h4></center></div>";
					} else {
						echo "<div class='konten not'><center><h4>FULL</h4></center></div>";
					}
				?>
			<div class="bottom">
				<?php
					if ($this->session->userdata('level') == 'pelayan') {
						if($value->status == 0){
							echo "
								<button class='btn btn-primary btn-block' id='order' data-toggle='modal' data-target='#modal-default' data-id='".$value->id_meja."'>Order</button>
							";
						} else {
							echo "
								<a href='".base_url('pelayan/detailPesanan/')."' class='btn btn-success btn-block'>Detail Pesanan</a>
							";
						}
					} else {
						if($value->status == 0){
							echo "
								<button class='btn btn-danger btn-block disabled'>Kosong</button>
							";
						} else {
							echo "
								<center><a href='".base_url('kasir/detailPesanan/')."' class='btn btn-success'>Detail Pesanan</a>
								<button class='btn btn-info' id='bayar' data-id='".$value->id_meja."'>Bayar</button></center>
							";
						}
					}
				?>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>

<div class="modal fade bs-example-modal-lg" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Menu Untuk Meja nomor <span id="nmr_meja"></span></h4>
      </div>
      <div class="modal-body" id="modal-menu">
		<div class="row">
			<div class="col-md-6">
				<?php foreach($menu as $row): ?>
				<div class="col-md-4" style="margin-bottom: 60px;">
					<center><img src="<?= base_url().'assets/images/'.$row->gambar ?>" width="100"></center>
					<h4><?= $row->nama_menu ?></h4>
					<p>Kategori : <?= $row->kategori ?> <br> Harga : Rp <?= $row->harga ?></p>
					<p style="margin-bottom: 0">Quantity:</p>
					<input type="number" class="form-control" id="<?= $row->id_menu ?>" value="1" name="quantity" placeholder="qty" style="margin-bottom: 15px;">
					<?php if ($row->stok == 0) {
						echo '<button class="btn btn-success disabled">Empty</button>';
					} else { ?>
					<button class="add_cart btn btn-success" data-idmenu="<?= $row->id_menu ?>" data-namamenu="<?= $row->nama_menu ?>" data-hargamenu="<?= $row->harga ?>">Order</button>
					<?php } ?>
				</div>
				<?php endforeach; ?>
			</div>
			<div class="col-md-6">
				<h4 class="text-center">Daftar Pesanan</h4>
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Nama Menu</th>
								<th>Harga</th>
								<th>Qty</th>
								<th>Sub Total</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody id="detail_cart">
							
						</tbody>
					</table>
					<div style="float: right">
						<button class="btn btn-danger" id="batal">Batal</button>
						<input type="hidden" name="" id="txt_nmr_meja">
						<button class="btn btn-primary" id="send">Pesan</button>
					</div>
				</div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
	$(document).on("click", "#order", function(){
		var id_meja = $(this).data('id');
		document.getElementById("nmr_meja").innerHTML=id_meja;
		$("#modal-menu #txt_nmr_meja").val(id_meja);
	});

	$(document).ready(function(){
        $('.add_cart').click(function(){
            var id_menu    = $(this).data("idmenu");
            var nama_menu  = $(this).data("namamenu");
            var harga_menu = $(this).data("hargamenu");
            var quantity     = $('#' + id_menu).val();
            $.ajax({
                url : "<?php echo base_url().'cart/add_to_cart'?>",
                method : "POST",
                data : {id_menu: id_menu, nama_menu: nama_menu, harga_menu: harga_menu, quantity: quantity},
                success: function(data){
                    $('#detail_cart').html(data);
                }
            });
        });
 
        // Load shopping cart
        $('#detail_cart').load("<?php echo base_url();?>cart/load_cart");
 
        //Hapus Item Cart
        $(document).on('click','.hapus_cart',function(){
            var row_id=$(this).attr("id"); //mengambil row_id dari artibut id
            $.ajax({
                url : "<?php echo base_url();?>cart/hapus_cart",
                method : "POST",
                data : {row_id : row_id},
                success :function(data){
                    $('#detail_cart').html(data);
                }
            });
        });

        //Batal Item Cart
        $(document).on('click','#batal',function(){
            $.ajax({
                url : "<?php echo base_url();?>cart/batal",
                success :function(data){
                    $('#detail_cart').html(data);
                }
            });
        });

        //Send to db
        $(document).on('click','#send',function(){
        	var nmr_meja = $("#modal-menu #txt_nmr_meja").val();
            $.ajax({
                url : "<?php echo base_url();?>cart/send_to_db",
                method : "POST",
                data : {nmr_meja : nmr_meja},
                success :function(data){
                	window.location=(BaseUrl+'dashboard');
                    $('#detail_cart').html(data);
                    $('#modal-default').modal('hide');
                }
            });
        });

        //Bayar
        $(document).on('click','#bayar',function(){
        	var nmr_meja = $(this).data('id');
            $.ajax({
                url : "<?php echo base_url();?>cart/bayar",
                method : "POST",
                data : {nmr_meja : nmr_meja},
                success :function(data){
                	window.location=(BaseUrl+'dashboard');
                }
            });
        });
    });
</script>

{{-- Modal Nama start --}}
<div class="modal fade" tabindex="-1" role="dialog" id="modalProduk">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-data" action="" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="produk_id" name="produk_id" value="">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input class="form-control" type="text" name="namaProduk" id="namaProduk" value="" required>
                    </div>
                    <div class="form-group">
                        <label>Stock Produk</label>
                        <input class="form-control" name="stock" id="stockProduk" type="number" value="" required>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Modal Nama end --}}

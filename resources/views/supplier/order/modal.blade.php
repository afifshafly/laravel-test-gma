{{-- Modal Nama start --}}
<div class="modal fade" tabindex="-1" role="dialog" id="modalApprove">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-data" action="" method="POST">
                @csrf
                <table class="table table-bordered" id="tableOrder">
                    <thead>
                        <tr>
                           <th>Produk</th>
                           <th>Qty</th>
                        </tr>
                    </thead>

                    <tbody>
                    </tbody>

                  </table>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit" class="btn btn-success">Approve</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Modal Nama end --}}

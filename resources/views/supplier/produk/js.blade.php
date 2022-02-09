<script>
    var root_url = <?php echo json_encode(route('produk.get')) ?>;
    $(document).ready(function () {

        get_produk_data()

        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        function get_produk_data() {

            $.ajax({
                url: root_url,
                type:'GET',
                data: { }
            }).done(function(data){
                table_data_row(data)
                // console.log(data);
            });
        }

        
        function table_data_row(data) {

            var	rows = '';
            // console.log(data);

            $.each( data, function( key, value ) {

                rows = rows + '<tr>';
                rows = rows + '<td>'+value.nama_produk+'</td>';
                rows = rows + '<td>'+value.stock+'</td>';
                rows = rows + '<td data-id="'+value.id+'">';
                        rows = rows + '<a class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" id="editProduk" data-id="'+value.id+'" data-toggle="modal" data-target="#modal-id">Edit</a> ';
                        rows = rows + '<a class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" id="deleteProduk" data-id="'+value.id+'" >Delete</a> ';
                        rows = rows + '</td>';
                rows = rows + '</tr>';
            });

            $("tbody").html(rows);
        }

        
        $('body').on('click','#tambahProduk', function(){

        $('.modal-title').html('Tambah Produk');
        $('.form-data').prop('method','POST').prop('action','');
        $('#modalProduk').modal('show',{ Backdrop:'static'});

        });

       
        $('body').on('click', '#submit', function (event) {
            event.preventDefault()
            var id = $("#produk_id").val();
            var namaProduk = $("#namaProduk").val();
            var stockProduk = $("#stockProduk").val();

            $.ajax({
            url: "{{ url('supplier/produk/store') }}",
            type: "POST",
            data: {
                id : id,
                nama_produk : namaProduk,
                stock : stockProduk
            },
            dataType: 'json',
            success: function (data) {

                $('.form-data').trigger("reset");
                $('#modalProduk').modal('hide');
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Success',
                    showConfirmButton: false,
                    timer: 1500
                })
                get_produk_data()
            },
            error: function (data) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Gagal Input Data',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
        });

        //Edit modal window
        $('body').on('click', '#editProduk', function (event) {

            event.preventDefault();
            var id = $(this).data('id');

            $.get('../supplier/produk/edit/'+id+'', function (data) {

                $('.modal-title').html('Edit Produk');
                $('#submit').val("Edit Produk");
                $('#modalProduk').modal('show');
                $('#produk_id').val(data.data.id);
                $('#namaProduk').val(data.data.nama_produk);
                $('#stockProduk').val(data.data.stock);
            })
        });

        //DeleteProduk
        $('body').on('click', '#deleteProduk', function (event) {
            if(!confirm("Do you really want to do this?")) {
            return false;
            }

            event.preventDefault();
            var id = $(this).attr('data-id');

            $.ajax(
                {
                url: '../supplier/produk/delete/'+id+'',
                type: 'DELETE',
                data: {
                        id: id
                },
                success: function (response){

                    Swal.fire(
                    'Remind!',
                    'Produk Berhasil di hapus',
                    'success'
                    )
                    get_produk_data()
                }
            });
            return false;
        });

    });
</script>

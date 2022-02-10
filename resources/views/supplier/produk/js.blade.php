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

            $('#tableProduk').DataTable({
                processing: true,
                destroy: true,
                type : "get",
                ajax: {
                    url:'../supplier/produk/getproduk',
                    },
                columns: [
                    { data:'nama_produk'},
                    { data:'stock'},
                    {data: "id" , render : function ( data, type, row, meta ) {
                    return type === 'display'  ?
                        '<button class="btn btn-warning btn-sm" id="editProduk" data-id="'+data+'" ><i class="fa fa-edit"> Edit</i></button><button class="btn btn-danger btn-sm" id="deleteProduk" data-id="'+data+'" ><i class="fa fa-trash"> Delete</i></button>' :
                        data;
                    }},
                ]
            });


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

        // let id = $(this).data('id');

        // swal({
        //     title: "DATA AKAN TERHAPUS PERMANEN, Apakah Anda Yakin?",
        //     text: "",
        //     icon: "warning",
        //     buttons: true,
        //     dangerMode: true,
        // })
        // .then((willDelete) => {
        //     if (willDelete) {
        //         window.location ="../pelatihanAdmin/delete/permanen/"+id+""
        //     }
        // });

        $('body').on('click', '#deleteProduk', function (event) {

            event.preventDefault();
            var id = $(this).attr('data-id');

            Swal.fire({
            title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
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
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
            })
            return false;
        });

    });
</script>

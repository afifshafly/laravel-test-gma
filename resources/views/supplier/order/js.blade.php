<script>
    var root_url = <?php echo json_encode(route('produk.get')) ?>;
    $(document).ready(function () {

        get_order_data()

        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        function get_order_data() {

            $('#tableProduk').DataTable({
                processing: true,
                destroy: true,
                type : "get",
                ajax: {
                    url:'../supplier/order/getorder',
                    },
                columns: [
                    { data:'order_no'},
                    { data:'name'},
                    { data:'nama_produk'},
                    { data:'qty'},
                    {data: "order_detail_id" , render : function ( data, type, row, meta ) {
                    return type === 'display'  ?
                        '<button class="btn btn-success btn-sm" id="approveOrder" data-id="'+data+'" >Approve</button>' :
                        data;
                    }},
                ]
            });


        }


        $('body').on('click', '#approveOrder', function (event) {
            event.preventDefault()
            var id = $(this).data('id');

            $.ajax({
            url: '../supplier/order/approve/'+id+'',
            type: "GET",
            // data: {'id': id,},
            dataType: 'json',
            success: function (data) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Success',
                    showConfirmButton: false,
                    timer: 1500
                })
                get_order_data()
                console.log(data)
            },
            error: function (data) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Gagal Input Data',
                    showConfirmButton: false,
                    timer: 1500
                })
                console.log(data)

            }
        });
        });

    });
</script>

@section('modal')
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="product-name"></h4>
                </div>
                <div class="modal-body">
                    <table class="pull-left col-md-8">
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $('#products-table').on('click', 'tbody tr', function () {
        var id = $(this).attr('id');
        var url = '{{ url('/product') }}/' + id;
        $('.modal-body').empty();
        $.get(url, function(data){
            $('#product-name').html('<strong>' + data.name + '</strong>');
            $.each(data, function( index, value ){
                $('.modal-body').append('<tr><td class="h6 td-key"><strong>' + index + '</strong></td><td class="h5">' + value + '</td></tr>');
            });
            console.log(data.id);

        });
        $('#myModal').modal('show');
    })
</script>
@endpush
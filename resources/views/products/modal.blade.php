@section('modal')
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header no-padding-bot">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="product-name"></h4>
                    <span class="pull-right nav-panel">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            <li class="active"><a href="#basic" data-toggle="tab">Basic</a></li>
                            <li><a href="#pricing" data-toggle="tab">Pricing</a></li>
                        </ul>
                    </span>
                </div>
                <div class="modal-body">
                    <div class="tab-content"></div>
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

        $('.tab-content').html(
            '<div class="tab-pane active" id="basic">' +
                '<table class="pull-left col-md-8">' +
                    '<tbody>' +
                    '</tbody>' +
                '</table>' +
            '</div>' +
            '<div class="tab-pane" id="pricing">' +
                '<table class="pull-left col-md-8">' +
                    '<tbody>' +
                    '</tbody>' +
                '</table>' +
            '</div>'
        );

        $.get(url, function(data){
            $('#product-name').html('<strong>' + data.name + '</strong>');
            $.each(data, function( tab, array ){
                if (tab !== 'name') {
                    $.each(array, function (index, value) {
                        if (value === null) {
                            value = '-';
                        }
                        $('#' + tab + ' table tbody').append('<tr><td class="h6 td-key"><strong>' + index + '</strong></td><td class="h5">' + value + '</td></tr>');
                    });
                }
            });
        });
        $('#myModal').modal('show');
    });
</script>
@endpush
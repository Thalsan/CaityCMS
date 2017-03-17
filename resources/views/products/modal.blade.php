@section('modal')
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header no-padding-bot">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="product-name"></h4>
                    <span class="pull-right nav-panel">
                        <ul class="nav panel-tabs main-tabs"></ul>
                    </span>
                </div>
                <div class="modal-body">
                    <div class="tab-content"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#products-table').on('click', 'tbody tr', function () {
            var id = $(this).attr('id');
            var url = '{{ url('/product') }}/' + id;

            $.get(url, function (data) {
                $('.main-tabs').empty();
                $('.tab-content').empty();
                $('#product-name').html('<strong>' + data.Name + '</strong>');
                $.each(data, function (tab, array) {
                    if (tab !== 'Name') {
                        set_tab('.main-tabs', tab);
                        add_container('.tab-content', tab);
                        if (tab === 'Suppliers') {
                            add_panel_tabs(tab);
                            $.each(array, function (tab_name, tab_data) {
                                set_tab('.' + tab + '-tabs', tab_name, tab_data['Status'], tab_data['Stock']);
                                add_container('#' + tab + ' .tab-content', tab_name);
                                add_content(tab_name, tab_data);
                            });
                            $('.' + tab + '-tabs li').first().toggleClass('active');
                            $('#' + tab).find('.tab-pane').first().toggleClass('active');
                        } else {
                            add_content(tab, array);
                        }
                    }
                });
                $('.modal-body .tab-pane').first().toggleClass('active');
                $('.main-tabs li').first().toggleClass('active');
            });

            $('#myModal').modal('show');
        });
    });

    function set_tab (element, tab_name, enabled_tab, active_icon) {
        var enabled_class = typeof enabled_tab === 'undefined' ? '' : (enabled_tab === 'enabled' ? 'enabled-tab' : 'disabled-tab');
        var icon = typeof active_icon === 'undefined' ? '' : (active_icon > 0 ? ' <i class="fa fa-check-square-o fa-space-left" aria-hidden="true"></i>' : ' <i class="fa fa-square-o fa-space-left" aria-hidden="true"></i>');
        $(element).append('<li class="' + enabled_class + '"><a href="#' + tab_name + '" data-toggle="tab">' + tab_name + icon + '</a></li>');
    }

    function add_container (element, name) {
        $(element).append('<div class="tab-pane" id="' + name + '"><table class="pull-left col-md-10"><tbody></tbody></table></div>');
    }

    function add_content (name, array) {
        $.each(array, function (index, value) {
            $('#' + name + ' table tbody').append('<tr><td class="h6 td-key"><strong>' + index + '</strong></td><td class="h5">' + value + '</td></tr>');
        });
    }

    function add_panel_tabs (tab) {
        $('#' + tab).empty().prepend('<span class="pull-right nav-panel"><ul class="nav panel-tabs ' + tab + '-tabs"></ul></span><div class="tab-content"></div>');
    }

</script>
@endpush
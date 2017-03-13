@extends('master')

@section('content')
    <table class="table table-striped row-border" id="products-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Unique part</th>
            <th>Brand</th>
            <th>Short description</th>
            <th>Long description</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th rowspan="1" colspan="1"><input></th>
            <th rowspan="1" colspan="1"><input></th>
            <th rowspan="1" colspan="1"><input></th>
            <th rowspan="1" colspan="1"><input></th>
            <th rowspan="1" colspan="1"><input></th>
            <th rowspan="1" colspan="1"><input></th>
            <th rowspan="1" colspan="1"><input></th>
            <th rowspan="1" colspan="1"><input></th>
        </tr>
        </tfoot>
    </table>
@stop

@push('scripts')
<script>
    $(function() {
        $('#products-table').DataTable({
            dom: 'Bfrtip',
            processing: true,
            serverSide: true,
            autoWidth: false,
            rowId: 'id',
            ajax: '{!! url('products/data') !!}',
            columns: [
                {
                    data: 'id', name: 'id',
                    width: '9%',
                    className: 'dt-center'
                },{
                    data: 'name', name: 'name',
                    width: '25%'
                },{
                    data: 'unique_part', name: 'unique_part',
                    visible: false
                },{
                    data: 'brand', name: 'brand',
                    width: '10%',
                    className: 'dt-center'
                },{
                    data: 'short_description', name: 'short_description',
                    render: $.fn.dataTable.render.ellipsis(25, false, true),
                    visible: false
                },{
                    data: 'long_description', name: 'long_description',
                    render: $.fn.dataTable.render.ellipsis(25, false, true)
                },{
                    data: 'created_at', name: 'created_at',
                    width: '14%',
                    className: 'dt-center'
                },{
                    data: 'updated_at', name: 'updated_at',
                    width: '14%',
                    className: 'dt-center'
                }
            ],
            buttons: [
                {
                    extend: 'colvis',
                    columns: ':gt(1):lt(10)'
                },
                'pageLength'
            ],
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                        .on('change', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                });
            }
        });
    });

    jQuery.fn.dataTable.render.ellipsis = function (cutoff, wordbreak, escapeHtml) {
        var esc = function (t) {
            return t
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;');
        };

        return function (d, type, row) {
            // Order, search and type get the original data
            if (type !== 'display') {
                return d;
            }

            if (typeof d !== 'number' && typeof d !== 'string') {
                return d;
            }

            d = d.toString(); // cast numbers

            if (d.length < cutoff) {
                return d;
            }

            var shortened = d.substr(0, cutoff - 1);

            // Find the last white space character in the string
            if (wordbreak) {
                shortened = shortened.replace(/\s([^\s]*)$/, '');
            }

            // Protect against uncontrolled HTML input
            if (escapeHtml) {
                shortened = esc(shortened);
            }

            return '<span class="ellipsis" title="' + esc(d) + '">' + shortened + '&#8230;</span>';
        };
    };
</script>
@endpush
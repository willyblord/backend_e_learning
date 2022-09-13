@extends('layouts.admin')
@section('content')
@can('asset_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.assets.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.asset.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.asset.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            #
                        </th>
                        <th>
                            Asset type
                        </th>
                       Action
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assets as $key => $asset)
                        <tr data-entry-id="{{ $asset->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $asset->id ?? '' }}
                            </td>
                            <td>
                                {{ $asset->name ?? '' }}
                            </td>
                            
                          
                            <td>

                                @can('asset_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.assets.edit', $asset->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('asset_delete')
                                    <form action="{{ route('admin.assets.destroy', $asset->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    // show data
    let url = window.location.origin
  function table_data_row(data) {
            var rows = '';
            var i = 0;
            $.each( data, function( key, item ) {
                console.log("item",item);
                rows = rows + '<tr>';
                rows = rows + '<td>'+ ++i +'</td>';
                rows = rows + '<td>'+ item.name +'</td>';
                rows = rows + '<td data-id="'+ item.id +'" class="text-center">';
                rows = rows + '<a class="btn btn-sm btn-info text-light" id="editRow" data-id="'+item.id+'" data-toggle="modal" data-target="#editModal">Edit</a> ';
                rows = rows + '<a class="btn btn-sm btn-danger text-light"  id="deleteRow" data-id="'+item.id+'" >Delete</a> ';                rows = rows + '</td>';
                rows = rows + '</tr>';
            });
            $("#tbody").html(rows);
    }
    
    function getAllData(){
        axios.get('http://127.0.0.1:8000/api/get-all-cat')
        .then(function(res){
            table_data_row(res.data.data)
            console.log(res.data);
        })
    }
    getAllData();
    // end
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('asset_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.assets.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Asset:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection

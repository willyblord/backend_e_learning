@extends('layouts.admin')
@section('content')
@can('stock_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12 mt-2">
            @if(session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Welcome
    </div>

    <div class="card-body">
        <div class="table-responsive">
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
            Repellat sint quod ea perspiciatis molestiae molestias, quaerat amet nesciunt cumque, numquam perferendis nisi sunt doloribus animi corrupti odit maiores laudantium dolor.
  
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
      columnDefs: [{
          orderable: true,
          className: '',
          targets: 0
      }]
  });
  $('.datatable-Stock:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection

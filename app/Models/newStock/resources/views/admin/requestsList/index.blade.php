@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
      All Request
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Asset">
                <thead>
                    <tr>
                        <th width="10">
                            No

                        </th>
                        <th>
                           Requested By
                        </th>
                        <th>
                           Item Name
                        </th>
                        <th>
                            Number f Items
                        </th>
                        <th>
                            Status
                        </th>
                        
                        <th>
                          Action
                        </th>
                    </tr>
                </thead>
                <tbody id="tbody">
            
                </tbody>
            </table>
            {{-- edit approve --}}
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Approve</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
              <div class="form-group">
                <form  id="editDataForm">
                    <div class="form-group">
                      <span id="error" class="text-danger"></span>
                      {{-- <input type="text" class="form-control" > --}}
                      <select class="form-control" id="e_name">
                        <option selected disabled>Select Approve Or Reject</option>
                        <option value="Approve">Approve</option>
                        <option value="Reject">Reject</option>
                      </select>
                      <br>
                      <textarea name="" id="e_reason" cols="30" rows="10" class="form-control">

                      </textarea>
                      <input type="hidden" id="e_id">
                                <span id="error" class="text-danger"></span>
                            </div>
                    <div class="form-group">
                        <button class="btn btn-sm  btn-primary" id="submit" name="submit" type="submit">Approve</button>
                    </div>
                    </form>
                      </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
{{-- end --}}

 
</div>
</div>
</div>
{{-- end --}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
<script>
    let url = window.location.origin
      function table_data_row(data) {
                var	rows = '';
                var i = 0;
                $.each( data, function( key, item ) {
                    console.log("item",item);
                    rows = rows + '<tr>';
                    rows = rows + '<td>'+ ++i +'</td>';
                    rows = rows + '<td>'+ item.requested_by +'</td>';
                    rows = rows + '<td> '+ item.item_name +' </td>';
                    rows = rows + '<td> '+ item.number_items +'</td>';
                    rows = rows + '<td> '+ item.status +'</td>';
                    
                 
                    rows = rows + '<td data-id="'+ item.id +'" class="text-center">';
                    @can('view_request')
                    rows = rows + '<div class="btn-group" role="group" aria-label="Button group with nested dropdown" >';
                        rows = rows +'<div class="btn-group" role="group" >';
                            rows = rows +'<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
                                rows = rows +'Action';
                                rows = rows +'</button>';
                                rows = rows +'<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">';
                                rows = rows +'<a class="dropdown-item" id="editRow" data-id="'+item.id+'" href="#" data-toggle="modal" data-target="#approveModal">Approve | Reject</a>';
                                // rows = rows +'<a class="dropdown-item" id="rejecteditRow" data-id="'+item.id+'" href="#" data-toggle="modal" data-target="#rejectapproveModal">Reject</a>';
                                rows = rows +'</div>';
                                rows = rows +'</div>';
                                @endcan
                    rows = rows + '</tr>';
                });
                $("#tbody").html(rows);
        }
        function getAllData(){
            axios.get('http://127.0.0.1:8000/api/get-all-request')
            .then(function(res){
                table_data_row(res.data.data)
                console.log(res.data);
            })

        }
        getAllData();
        
            //edit
    $('body').on('click','#editRow',function(){
    let id = $(this).data('id');
    //console.log(id)
     let edit = url + '/admin/requestList' + '/'  + id + '/edit'
       // console.log(url);
        axios.get(edit)
            .then(function(res){
               console.log(res);
              $('#e_name').val(res.data.status)
              $('#e_reason').val(res.data.reason)
              $('#e_id').val(res.data.id)
            })
})
$('body').on('submit','#editDataForm',function(e){
        e.preventDefault()
        let id = $('#e_id').val()
        let data = {
            id : id,
            status : $('#e_name').val(),
            reason : $('#e_reason').val(),

        }
        let path = url + '/admin/requestList' + '/'  + id
        axios.put(path,data)
        .then(function(res){
            getAllData();
             $('#editModal').modal('toggle')
    Swal.fire({
                icon: 'success',
                title: 'Success...',
                text: 'Data Update Successfully!',
                })
                console.log(res);
            })
        })
        
       
        </script>
                   
@endsection
@section('scripts')
@parent
<script>
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
<style type="text/css">
  
    
</style>
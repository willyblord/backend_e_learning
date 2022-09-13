@extends('layouts.admin')
@section('content')
@can('add_request')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
    Add New Request
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Request</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="addNewDataForm"> 
                @csrf
                <div class="form-group">
                    <label class="required" for="name">Requested By</label>
                    <input type="text" class="form-control" name="requested_by" id="requested_by" value="{{ Auth::user()->name }}"> 

                </div>
                <div class="form-group">
                    <label class="required" for="item_id">item_name</label>
                    <select  type="text" name="item_id" id="item_id" class="form-control">
                        <option > Select Item Name</option>
                                   
                        <option value="">JUHUHH</option>
                                   
                    </select>
                    @if($errors->has('item_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('item_name') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="name">number_items</label>
                    <input class="form-control" type="text" name="number_items" id="name" required>
                    @if($errors->has('number_items'))
                        <div class="invalid-feedback">
                            {{ $errors->first('number_items') }}
                        </div>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="reason">Reason</label>
                    <textarea class="form-control" name="reason"></textarea>
                    @if($errors->has('reason'))
                        <div class="invalid-feedback">
                            {{ $errors->first('reason') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <button class="btn btn-sm btn-block btn-success" type="submit">Add New Item</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
  <br><br><br>
  
 @endcan
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
                            
                        </th>
                    </tr>
                </thead>
                <tbody id="tbody">
            
                </tbody>
            </table>
        </div>
    </div>
</div>
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
                                rows = rows +'<a class="dropdown-item" data-id="'+item.id+'" href="#" data-toggle="modal" data-target="#approveModal">Edit</a>';
                                rows = rows +'<a class="dropdown-item" id="editRow" data-id="'+item.id+'" data-toggle="modal" data-target="#editModal" data-id="'+item.id+'" href="#">Delete</a>';
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
                //delete currency
                $('body').on('click','#deleteRow',function (e) {
                e.preventDefault();
                let id = $(this).data('id')
               // console.log(del)
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success mx-2',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                  axios.delete(`${url}/category/${id}`).then(function(r){
                    getAllData();
                     swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Your data has been deleted.',
                                'success'
                            )
                });
                } else if (
                        /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your file is safe :)',
                        'error'
                    )
                }
            })
            });
            //store
            //store
        $('body').on('submit','#addNewDataForm',function(e){
            e.preventDefault();
            axios.post("http://127.0.0.1:8000/api/post-request", {
                requested_by: $('#requested_by').val(),
                item_id: $('#item_id').val(),
                number_items: $('#number_items').val(),
                reason: $('#reason').val(),
            })
            .then(function (response) {
                getAllData();
                $('#requested_by').val('');
                $('#item_id').val('');
                $('#number_items').val('');
                $('#reason').val('');
                $('#error').text('')
               Swal.fire({
                icon: 'success',
                title: 'Success...',
                text: 'Data save Successfully!',
                })
            })
            .catch(function (error) {
                if(error.response.data.errors.name){
                    $('#error').text(error.response.data.errors.name[0]);
                }
            });
        });
    
          //delete currency
          $('body').on('click','#deleteRow',function (e) {
                e.preventDefault();
                let id = $(this).data('id')
               // let del = url + '/category/' + id
               // console.log(del)
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success mx-2',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this! ",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                  axios.delete(`http://127.0.0.1:8000/api/delete/${id}`).then(function(r){
                    getAllData();
                     swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Your data has been deleted.',
                                'success'
                            )
                });
                } else if (
                        /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your file is safe :)',
                        'error'
                    )
                }
            })
            });
            // update or
    
             
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

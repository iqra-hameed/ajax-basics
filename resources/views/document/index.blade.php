@extends('main_body')
@section('main_section')
<div class="container text-center ">
<h1 class="p-2">Document</h1>
    <a class="btn btn-success p-2" href="javascript:void(0)" id="create_image"> UploadImage</a>
    <table class="table table-bordered data-table" id="ajaxdatatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Image</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody class="text-center">
        </tbody>
    </table>
</div>
   
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="imageForm" name="imageForm" enctype="multipart/form-data"  >
                    {{ csrf_field() }}
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    
                    <input type="hidden" name="image_id" id="image_id">
                    <div class="form-group">
                      <label>Image:</label>
                      <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                        </button>
                       </div>
                
                  </form>
            </div>
        </div>
    </div>
</div>
    
</body>
<script type="text/javascript">
  $(function () {
     
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    var table = $('.data-table').DataTable({
        // processing: true,
        // serverSide: true,
        ajax: "{{ route('documents.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'image', name: 'image'},
            {data: 'action', name: 'action',
             orderable: false, searchable: false},
        ]
    });     
    $('#create_image').click(function () {
        $('#saveBtn').val("create-image");
        $('#imageForm').trigger("reset");
        $('#image_id').val('');
        $('#modelHeading').html("Create New Image");
        $('#ajaxModel').modal('show');
    });
    
    $('body').on('click', '.edit', function () {
      var image_id = $(this).data('id');
      $.get("{{ route('documents.index') }}" +'/' + image_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Image");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#image_id').val(data.id);
          $('#image').val(data.filename);
      })
   });
        $("#imageForm").on("submit",function (e) {
           e.preventDefault();
           data = new FormData($("#imageForm")[0]);
           $.ajax({
            url : '{{route('documents.store')}}',
            type : "post",
            data : data,
            dataType : 'json',
            success:function (response) { 
                console.log(response);
                if (response.status === 'success') {
                if (ajaxModel !== '') $(ajaxModel).modal('hide');
                if (ajaxdatatable !== '') $(ajaxdatatable).DataTable().ajax.reload();
                toastMessage("Successfully done", "success");
            }else{
                toastMessage("Something Went wrong", "error");
            }
            //    $('#ajaxModel').modal('hide');
            //     $(ajaxdatatable).DataTable().ajax.reload();
             
            },
        //     error: function (data) {
        //       console.log('Error:', data);
        //       $('#saveBtn').html('Save Changes');
        //   } 
            contentType: false,
            processData: false
        }); 
    }); 
    }); 
   
    $('body').on('click', '.delete1', function (e) {
       e.preventDefault();
         // var image_id = $(this).data("id");
          let image_id = '#' + $(this).data('id');
         swal.fire({
             title: "Are you sure!",
             confirmButtonClass: "btn-danger",
             confirmButtonText: "Yes!",
             showCancelButton: true,
             }).then((result) => {
             if (result.value) 
             {
             $.ajax({
             type: "DELETE",
             dataType:'json',
             url : $(this).data('url'),
             success: function (response) {
                 console.log(response);
                 if (response.status === 'success') {
                     $(ajaxdatatable).DataTable().ajax.reload();
                     toastMessage("Successfully Deleted", "success");
                 }else{
                 toastMessage("Something Went wrong", "error");
               }               
             },
             error: function (data) {
                 console.log('Error:', data);
             }
         });
       }
 });
});

            function toastMessage(message, status) {
              toastr.options.positionClass = "toast-top-center";
               if(status == "success" && message != "Something Went wrong"){
                toastr.success(message);
                 }else{
                  toastr.error(message);
             }
         }
 
</script>
@endsection
{{-- @extends('main_body')
@section('main_section')
    <div class="container">
        <h1 class="text-center">Category Details</h1>
        <a class="btn btn-success" href="javascript:void(0)" id="createNewProduct"> Create New Category</a>
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Name_En</th>
                    <th>Name_Ar</th>
                    <th>Description_En</th>
                    <th>Description_Ar</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
            </tbody>
        </table>


        <div class="modal fade" id="ajaxModel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading"></h4>
                    </div>
                    <div class="modal-body">
                        <form id="productForm" name="productForm" class="form-horizontal">
                            <input type="hidden" name="product_id" id="product_id">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-12 ">
                                    <input type="text" class="form-control" id="name_en" name="name_en"
                                        placeholder="Enter Name" value="" maxlength="50" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Ar_Name</label>
                                <div class="col-sm-12 ">
                                    <input type="text" class="form-control" id="name_ar" name="name_ar"
                                        placeholder="Enter Name" value="" maxlength="50" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-12">
                                    <textarea id="description_en" name="description_en" required="" placeholder="Enter Details" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Ar_Description</label>
                                <div class="col-sm-12">
                                    <textarea id="description_ar" name="description_ar" required="" placeholder="Enter Details" class="form-control"></textarea>
                                </div>
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
    </div>
    <script type="text/javascript">
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.data-table').DataTable({

                serverSide: true,
                ajax: "{{ route('categories.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name_en',
                        name: 'name_en'
                    },
                    {
                        data: 'name_ar',
                        name: 'name_ar'
                    },
                    {
                        data: 'description_en',
                        name: 'description_en'
                    },
                    {
                        data: 'description_ar',
                        name: 'description_ar'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#createNewProduct').click(function() {
                $('#saveBtn').val("create-product");
                $('#product_id').val('');
                $('#productForm').trigger("reset");
                $('#modelHeading').html("Create New Product");
                $('#ajaxModel').modal('show');
            });

            $('body').on('click', '.edit', function() {
                var product_id = $(this).data('id');
                $.get("{{ route('categories.index') }}" + '/' + product_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Product");
                    $('#saveBtn').val("edit-user");
                    $('#ajaxModel').modal('show');
                    $('#product_id').val(data.id);
                    $('#name_en').val(data.name_en);
                    $('#name_ar').val(data.name_ar);
                    $('#description_en').val(data.description_en);
                    $('#description_ar').val(data.description_ar);
                })
            });

            $('#saveBtn').click(function(e) {
                e.preventDefault();
                // $(this).html('Sending..');

                $.ajax({
                    data: $('#productForm').serialize(),
                    url: "{{ route('categories.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#productForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                    },
                    error: function(data) {
                        console.log('Error:', data);
                        // $('#saveBtn').html('Save Changes');
                    }
                });
            });

            $('body').on('click', '.delete', function() {

                var product_id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('categories.store') }}" + '/' + product_id,
                    success: function(data) {
                        table.draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });

        });
    </script>
@endsection --}}

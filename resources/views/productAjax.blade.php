{{-- @extends('main_body')
@section('main_section')
    <div class="container  panel panel-default">
        <div class="row">
            <div class="col-md-12">


                <h1 class="text-center">Product Details</h1>

                <a class="btn btn-info" href="javascript:void(0)" id="createNewProduct"> Create New Product</a>
                <br><br></br><br>
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Ar_Name</th>
                            <th class="text-center">description</th>
                            <th class="text-center">Ar_description</th>
                            <th class="text-center">category_id</th>
                            <th class="text-center">image</th>
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
                                <form enctype="multipart/form-data" id="productForm" name="productForm"
                                    class="form-horizontal" method="POST" class="form-outline form-white"
                                    action="javascript:void(0)">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="product_id" id="product_id">
                                    <div class="form-group">
                                        <div class="col-sm-12  p-3">
                                            <label for="name" class=" control-label ">Name</label>

                                            <input type="text" class="form-control" id="name_en" name="name_en"
                                                value="" maxlength="50" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12 p-3 ">
                                            <label for="name" class=" control-label ">Ar_Name</label>

                                            <input type="text" class="form-control" id="name_ar" name="name_ar"
                                                value="" maxlength="50" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12 p-3 ">
                                            <label class="control-label ">Description</label>

                                            <input type="text" id="description_en" name="description_en" required=""
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12 p-3">
                                            <label class=" control-label ">Ar_Description</label>

                                            <input id="description_ar" name="description_ar" required=""
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12 p-3">
                                            <label for="categories" class="text-center">Choose a category: </label>
                                            <select id="category_id" name="category_id" class="form-control js_option"
                                                id="sel1" style="padding: 1%; color:black">

                                                @forelse($categories as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->name_en }}_
                                                        {{ $category->name_ar }}</option>
                                                @empty
                                                    <option> No Category Found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12  p-4">
                                            <label class=" control-label ">Image</label>

                                            <input type="file" id="image" name="image" required
                                                class="form-control">

                                        </div>
                                    </div>
                                    <div class="col-sm-offset-2 col-sm-10 pt-4 text-center">
                                        <button type="submit" class="btn btn-primary" id="saveBtn"
                                            value="createNewProduct">Save
                                            changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // $('#image').change(function() {

            //     let reader = new FileReader();
            //     reader.onload = (e) => {
            //         $('#preview-image').attr('src', e.target.result);
            //     }
            //     reader.readAsDataURL(this.files[0]);

            // });
            var table = $('.data-table').DataTable({
                // processing: true,
                serverSide: true,
                ajax: "{{ route('products.index') }}",
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
                        data: 'category_id',
                        name: 'category_id'
                    },

                    {
                        data: 'image',
                        name: 'image',


                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [0, 'desc']
                ]
            });

            // $('#createNewProduct').click(function() {
            //     $('#saveBtn').val("create-product");
            //     $('#product_id').val('');
            //     $('#productForm').trigger("reset");
            //     $('#modelHeading').html("Create New Product");
            //     $('#ajaxModel').modal('show');
            //     $('#id').val('');
            //     $("#image").attr("required", "true");


            // });

            // $('body').on('click', '.editProduct', function() {
            //     var product_id = $(this).data('id');
            //     $.get("{{ route('products.index') }}" + '/' + product_id + '/edit', function(data) {
            //         $('#modelHeading').html("Edit Product");
            //         $('#saveBtn').val("edit-user");
            //         $('#ajaxModel').modal('show');
            //         $('#product_id').val(data.id);
            //         $('#name_en').val(data.name_en);
            //         $('#name_ar').val(data.name_ar);
            //         $('#description_en').val(data.description_en);
            //         $('#description_ar').val(data.description_ar);
            //         // $('#image').val(data.image);
            //         $('#category_id').val(data.category_id);
            //         $("#image").attr("required", "false");
            //         // $('#image').removeAttr('required', "true");

            //     })

            // });



            // $('#productForm').submit(function(e) {
            //     e.preventDefault();

            //     var formData = new FormData(this);

            //     $.ajax({
            //         type: 'POST',
            //         url: "{{ route('products.store') }}",
            //         data: formData,
            //         cache: false,
            //         contentType: false,
            //         processData: false,
            //         encode: true,
            //         success: (data) => {
            //             $('#productForm').trigger("reset");
            //             $('#ajaxModel').modal('hide');
            //             $('#saveBtn').html('Save Changes');
            //             $("#saveBtn").attr("disabled", false);
            //             table.draw();

            //         },
            //         error: function(data) {
            //             console.log(data);
            //         }
            //     });
            // });
            // $('body').on('click', '.deleteProduct', function() {

            //     var product_id = $(this).data("id");
            //     confirm("Are You sure want to delete !");

            //     $.ajax({
            //         type: "DELETE",
            //         url: "{{ route('products.store') }}" + '/' + product_id,
            //         success: function(data) {
            //             table.draw();
            //         },
            //         error: function(data) {
            //             console.log('Error:', data);
            //         }

            //     });
            // });

        });
    </script>
@endsection --}}

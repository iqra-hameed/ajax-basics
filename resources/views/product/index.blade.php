@extends('main_body')
@section('main_section')
    <div class="container  panel panel-default">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Product Details</h1>
                <button type="button" class="btn btn-success ml-4" data-act="ajax-modal" data-method="get"
                    data-action-url="{{ route('products.create') }}" data-title="Create New Product">Create New
                    Product</button>
                <div id="modal">
                </div>

                <table class="table table-bordered data-table" id="products-table">
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



        });
    </script>
@endsection

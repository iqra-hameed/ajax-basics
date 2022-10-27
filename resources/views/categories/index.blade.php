@extends('main_body')
@section('main_section')
    <div class="container  panel panel-default">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Category Details</h1>
                {{-- @can('category-create') --}}
                <button type="button" class="btn btn-success ml-4" data-act="ajax-modal" data-method="get"
                    data-action-url="{{ route('categories.create') }}" data-title="Create New Category">Create New
                    category</button>
                {{-- @endcan --}}
                <div id="modal">
                </div>

                <table class="datatable-init table table-bordered data-table" id="data-table">

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
        });
    </script>
@endsection

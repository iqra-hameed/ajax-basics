@php
$isEdit = isset($category) ? true : false;
$url = $isEdit ? route('categories.update', $category->id) : route('categories.store');
@endphp

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
            </div>
            <h4 class="modal-title" id="modelHeading"></h4>
            <div class="modal-body">

                <form action="{{ $url }}" id="productForm" enctype="multipart/form-data" name="productForm"
                    data-form="ajax-form" method="POST" data-modal="#ajaxModel"
                    data-datatable="#categories-table"class="form-horizontal" class="form-outline form-white">
                    {{ csrf_field() }}
                    @if ($isEdit)
                        @method('put')
                    @endif
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="name"
                            class="col-sm-2 control-label font-italic font-weight-bold input">Name</label>
                        <div class="col-sm-12 ">
                            <input type="text" class="form-control" id="name_en" name="name_en"
                                value="{{ $isEdit ? $category->name_en : '' }}"required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name"
                            class="col-sm-2 control-label font-italic font-weight-bold">Ar_Name</label>
                        <div class="col-sm-12 ">
                            <input type="text" class="form-control" id="name_ar" name="name_ar"
                                value="{{ $isEdit ? $category->name_ar : '' }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label font-italic font-weight-bold">Description</label>
                        <div class="col-sm-12">
                            <input id="description_en" name="description_en"
                                value="{{ $isEdit ? $category->description_en : '' }}" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label font-italic font-weight-bold">Ar_Description</label>
                        <div class="col-sm-12">
                            <input id="description_ar" name="description_ar"
                                value="{{ $isEdit ? $category->description_ar : '' }}" required class="form-control">
                        </div>
                    </div>


                    <div class="col-sm-offset-2 col-sm-10 m-3">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

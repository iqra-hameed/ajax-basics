@php
$isEdit = isset($product) ? true : false;
$url = $isEdit ? route('products.update', $product->id) : route('products.store');
@endphp
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form action="{{ $url }}"enctype="multipart/form-data" data-form="ajax-form" id="productForm"
                    name="productForm" data-modal="#ajaxModel" data-datatable="#products-table" class="form-horizontal"
                    method="POST" class="form-outline form-white">
                    {{ csrf_field() }}
                    @if ($isEdit)
                        @method('put')
                    @endif


                    <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <div class="col-sm-12  p-3">
                            <label for="name" class=" control-label  font-italic font-weight-bold">Name</label>

                            <input type="text" class="form-control input" id="name_en" name="name_en"
                                <?php if (isset($product)) { ?> value="{{ $product->name_en }}" <?php } ?> required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 p-3 ">
                            <label for="name" class=" control-label font-italic font-weight-bold ">Ar_Name</label>

                            <input type="text" class="form-control input" id="name_ar" name="name_ar"
                                value="{{ $isEdit ? $product->name_ar : '' }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12 p-3 ">
                            <label class="control-label font-italic font-weight-bold">Description</label>

                            <input type="text" id="description_en" name="description_en" class="form-control input"
                                value="{{ $isEdit ? $product->description_en : '' }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 p-3">
                            <label class=" control-label font-italic font-weight-bold">Ar_Description</label>

                            <input id="description_ar" name="description_ar" class="form-control input"
                                value="{{ $isEdit ? $product->description_ar : '' }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12 p-3">
                            <label for="categories" class="text-center">Choose a category: </label>
                            <select id="category_id" name="category_id" class="form-control js_option" id="sel1"
                                style="padding: 1%; color:black">

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

                    {{-- <div class="form-group">
                        <label class="form-label" for="category"> Category</label>
                        <div class="form-control-wrap">
                            <select class="form-select form-select-solid input " name="category_id[]" id="category_id"
                                required>
                                <option value="0" selected disabled>Select Category</option>
                                @foreach ($categories as $key => $category)
                                    <option value="{{ $category->id }}"
                                        @if ($product->category_id == $category->id) selected @endif>
                                        {{ $category->name_en }} | {{ $category->name_ar }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="select_category_error"></span>
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <div class="col-sm-12  p-4">
                            <label class=" control-label font-italic font-weight-bold ">Image</label>

                            <input type="file" id="image" name="image" class="form-control input"
                                value="{{ $isEdit ? $product->image : '' }}" required>

                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10 pt-4 text-center font-italic font-weight-bold">
                        <button type="submit" class="btn btn-primary " data-button="submit" id="saveBtn"
                            value="createNewProduct">Save
                            changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    $("#select_category").select2({
        dropdownParent: $('#ajax_general_model #ajax_model_inner_content')
    });
</script> --}}

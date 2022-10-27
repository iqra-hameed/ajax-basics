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

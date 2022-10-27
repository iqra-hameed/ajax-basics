
jQuery(document).ready(function () {
    // alert('');
    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
});


    //   $.ajaxSetup({
    //       headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    //   });

$(document).on('click', '[data-act=ajax-modal]',function(){
    const _self = $(this);
    const inner_content = $("#ajax_model_inner_content");
    inner_content.hide();
   $("#ajaxModel").modal({backdrop: 'static'});
    $("#ajax_model_title").html(_self.attr('data-title'));

    var formData = new FormData();

    $.ajax({

        type: _self.attr('data-method'),
        url: _self.attr('data-action-url'),
      //  datatype:'json',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        encode: true,

        success: function (response) {
          console.log(response);
          //  if (response.status === 200) {
                $('#modal').append(response);
               // $('#ajaxModel').append(response);
          //}
           // $("#ajaxModel").modal("show");
            $('#ajaxModel').modal('show');
        },
        error: function (data) {
            console.log(data);
        }
    });

});
$(document).on('submit', '[data-form=ajax-form]', function(e) {

    e.preventDefault();

    const form = this;

     sendAjaxForm(form);

});

function sendAjaxForm(form) {
    const _self = $(form);

    const btn = _self.find('[data-button=submit]');
     btn.attr('disabled', 'disabled');
    const modal = _self.data('modal');

    const datatable = _self.data('datatable');


    $.ajax({
        url: _self.attr('action'),
        method: _self.attr('method'),
        data: new FormData(_self[0]),
        contentType: false,
        cache: false,
        processData: false,
        dataType:"json",
        success: function (response) {
           console.log(response);

            if (response.status === 'success') {

                if (modal !== '') $(modal).modal('hide');

                if (datatable !== '') $(datatable).DataTable().ajax.reload();

            }else{
                toastMessage("Something Went wrong", "error");
            }
        }
    });
}

function toastMessage(message, status) {
    toastr.options.positionClass = "toast-top-center";
   if(status == "success" && message != "Something Went wrong"){
    toastr.success(message);
   }else{
    toastr.error(message);
   }
}
                                    //delete section

                                    $(document).on('click', '.delete', function () {

                                         let tableId = '#' + $(this).data('table');
                                        $.ajax({
                                           type: 'DELETE',
                                           dataType: "json",
                                           url : $(this).data('url'),

                                        success: function (response) {
                                            console.log(response);
                                           // alert(response.status);
                                            if (response.status === 'success') {

                                                $(tableId).DataTable().ajax.reload();

                                               // toastMessage(response.data.message, response.data.status);
                                            }
                                            else{
                                                error: ("Something Went wrong", "error");
                                            }
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





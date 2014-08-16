$(document).ready(function(){
    var rowTemplate = _.template($(".lead-row-template").html());
    var submitBtn = $(".submit_button");

    var leadStoreForm = $("#lead-store-form");

    leadStoreForm.submit(function(e){
        e.preventDefault();
        $(".lead-store-messages").html('');
        $(".lead-store-messages").hide();

        submitBtn.button('loading');
        var request = doRequest(
            leadStoreForm.attr('action'),
            leadStoreForm.serialize(),
            leadStoreForm.attr('method')
        );

        request.error(function(data){
            var errors;
            submitBtn.button('reset');
            if (data.status == 422)
            {
                errors = data.responseJSON;
                $(".lead-store-messages ").hide();
                $(".lead-store-messages").html(_.template(
                    $('.message-template').html(),
                    errors
                ));
                $(".lead-store-messages").fadeIn(400);
            }
        });

        request.done(function(data){
            submitBtn.button('reset');
            leadStoreForm[0].reset();
            injectNewCreatedData(data);
        });
    });

    function injectNewCreatedData(data)
    {
        $(".inline-form-tr").after(_.template($(".lead-row-template").html(),data));
    }
});
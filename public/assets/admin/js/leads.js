$(document).ready(function(){
    rowTemplate = _.template($(".lead-row-template").html());
    $(".lead-store-messages").html('');
    $(".lead-store-messages").hide();
    submitBtn = $(".submit_button");

    leadStoreForm = $("#lead-store-form");

    leadStoreForm.submit(function(e){
        e.preventDefault();

        submitBtn.button('loading');
        request = doRequest(
            leadStoreForm.attr('action'),
            leadStoreForm.serialize(),
            leadStoreForm.attr('method')
        );

        request.error(function(data){
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
            item = data.responseJSON;
            console.log(item);
        });

        request.always(function(){
            submitBtn.button('reset');
        })
    });
});
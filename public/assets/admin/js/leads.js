$(document).ready(function() {
    var rowTemplate = _.template($(".lead-row-template").html());
    var submitBtn = $(".submit_button");
    var leadStatuses = {
        "0": "نا مشخص",
        "1": "موفق",
        "2": "بعدا مشخص میشود",
        "-1": "نا موفق"
    };

    var leadStoreForm = $("#lead-store-form");

    leadStoreForm.submit(function (e) {
        e.preventDefault();
        $(".lead-store-messages").html('');
        $(".lead-store-messages").hide();

        submitBtn.button('loading');
        var request = doRequest(
            leadStoreForm.attr('action'),
            leadStoreForm.serialize(),
            leadStoreForm.attr('method')
        );

        request.error(function (data) {
            submitBtn.button('reset');
            if (data.status == 422) {
                errors = data.responseJSON;
                $(".lead-store-messages ").hide();
                $(".lead-store-messages").html(_.template(
                    $('.message-template').html(),
                    errors
                ));
                $(".lead-store-messages").fadeIn(400);
            }
        });

        request.done(function (data) {
            showLeadSuccessMessage(data);
            submitBtn.button('reset');
            leadStoreForm[0].reset();
            injectNewCreatedData(data);
        });
    });

    function showLeadSuccessMessage(lead) {
        $(".lead-store-messages ").hide();
        $(".lead-store-messages").html(_.template(
            $('.success-template').html(),
            lead
        ));
        $(".lead-store-messages").fadeIn(400);
    }

    function injectNewCreatedData(data) {
        data.translated_status = leadStatuses[data.status];
        $(".inline-form-tr").after(_.template($(".lead-row-template").html(), data));
    }


});

function getStatusClass(status)
{
    console.log(status);
    switch (status){
        case "0":
            return 'default';
        case "1":
            return 'success';
        case "2":
            return 'info';
        case "-1":
            return 'danger';
        default:
            return 'default';
    }
}
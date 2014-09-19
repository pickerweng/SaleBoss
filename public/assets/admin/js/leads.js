$(document).ready(function() {
    console.log('asdasdasdasdasdsada');
    var submitBtn = $(".submit_button");
    var leadStoreForm = $("#lead-store-form");

    leadStoreForm.submit(function (e) {
        e.preventDefault();
        $(".lead-store-messages").html('');
        $(".lead-store-messages").hide();

        submitBtn.button('loading');

        var request = Common.doRequest(
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
});

function getStatusClass(status) {
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

function leadUpdateClosure(elem) {
    var statuses = $(".statuses");
    var priorities = $(".priorities");
    var tags = $(".tags");
    elem = $(elem);

    statuses = setSelected(statuses, elem.attr('status'));
    priorities = setSelected(priorities, elem.attr('priority'));
    tags = setSelected(tags, elem.attr('tag'));

    var updateForm = {
        phone : elem.attr('phone'),
        tag : elem.attr('tag'),
        tags : tags.html(),
        name : elem.attr('name'),
        description : elem.attr('description'),
        status: elem.attr('status'),
        statuses: statuses.html(),
        priority : elem.attr('priority'),
        priorities : priorities.html(),
        remind_at : elem.attr('remind_at')
    }
    return _.template($(".lead-update-modal-form").html(), updateForm);
}

function setSelected(selectable, value) {
    selectable.find('select option[value=' + value  + ']').attr('selected','selected');
    return selectable;
}

function getStatuses (key) {
    return Common.getStatuses(key);
}

function showLeadSuccessMessage(lead) {
    $(".lead-store-messages ").hide();
    $(".lead-store-messages").html(_.template(
        $('.success-template').html(),
        lead
    ));
    $(".lead-store-messages").fadeIn(400);
}

function injectNewCreatedData(data) {
    data.translated_status = getStatuses(data.status);
    $(".inline-form-tr").after(_.template($(".lead-row-template").html(), data));
}


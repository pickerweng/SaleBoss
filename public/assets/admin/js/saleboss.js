function doRequest (ApiAddress,params, type, beforeSend)
{
    type = (typeof type === 'undefined') ? 'GET' : type;
    return $.ajax({
        url: ApiAddress,
        type: type,
        dataType: 'json',
        data: params
    });
}
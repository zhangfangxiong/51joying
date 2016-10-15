if (typeof iTypeID == 'undefined') var iTypeID = 0;
var saleauto = $('#sLoupanName').autocomplete({
    source: function (request, response) {
        $.get('/fangjl/admin/loupan/autocomplete.html?&key=' + request.term, function (ret) {
            response(ret.data);
        }, 'json');
    },
    select: function (event, ui) {
        $('#iLoupanID').val(ui.item.id);
        $('#sLoupanName').val(ui.item.value);
        $('#sSelectLoupanName').val(ui.item.value);
        $('#sLoupanName').blur();
        $('#sLoupanName').focus();
        $('#sLoupanName').change();
    },
    response: function (event, ui) {
    }
}).autocomplete("instance")._renderItem = function (ul, item) {
    item.label = item.sName;
    item.value = item.sName;
    item.id = item.iAutoID;
    item.data = item;
    return $("<li>")
        .append("<a>" + item.sName + "</a>("+item.sCityCode+" "+item.sRegionName+" "+item.sZoneName+")")
        .appendTo(ul);

};
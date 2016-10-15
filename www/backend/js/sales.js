if (typeof iTypeID == 'undefined') var iTypeID = 0;
var saleauto = $('#sSaleName').autocomplete({
    source: function (request, response) {
        $.get('/fangjl/admin/sales/auto/?&sKey=' + request.term, function (ret) {

            response(ret.data);
        }, 'json');
    },
    select: function (event, ui) {
        $('#iSalesID').val(ui.item.id);
        $('#sSaleName').val(ui.item.value);
        $('#sSelectSaleName').val(ui.item.value);
        $('#sSaleName').blur();
        $('#sSaleName').focus();
        $('#sSaleName').change();
    },
    response: function (event, ui) {
    }
}).autocomplete("instance")._renderItem = function (ul, item) {
    item.label = item.sName;
    item.value = item.sName;
    item.id = item.iAutoID;
    item.data = item;
    return $("<li>")
        .append("<a>" + item.sName + "</a>")
        .appendTo(ul);

};
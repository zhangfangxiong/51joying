if (typeof TYPE_CLASS == 'undefined') var TYPE_CLASS = '';
$('.autocomplete').autocomplete({
    source: function (request, response) {
    	var tclass = $(this).attr('tclass');
        $.get('/ajax/index/author/?iTypeID=' + iTypeID + '&sKey=' + request.term, function (ret) {

            response(ret.data);
        }, 'json');
    },
    select: function (event, ui) {
        $('#iAuthorID').val(ui.item.id);
        $('#sAuthor').val(ui.item.value);
        $('#sSelectAuthor').val(ui.item.value);
        $('#sAuthor').blur();
        $('#sAuthor').focus();
        $('#sAuthor').change();
    },
    response: function (event, ui) {
    }
}).autocomplete("instance")._renderItem = function (ul, item) {
    console.log(item);
    item.label = item.sAuthorName;
    item.value = item.sAuthorName;
    item.id = item.iAuthorID;
    item.data = item;
    return $("<li>")
        .append("<a>" + item.sAuthorName + " " + item.sCityName + " " + item.sPosition + "</a>")
        .appendTo(ul);

};
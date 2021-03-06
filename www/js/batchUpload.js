function initUpload(ele) {
    var ccuploader = new plupload.Uploader({
        runtimes: 'html5,flash,silverlight,html4',
        browse_button: ele,
        url: global.sUploadUrl,
        flash_swf_url: global.static_url + '/plupload/Moxie.swf',
        silverlight_xap_url: global.static_url + '/plupload/Moxie.xap',
        filters: {
            max_file_size: '2mb',
            mime_types: [
                {title: "Image files", extensions: "jpg,jpeg,gif,png"}
            ]
        },
        init: {
            FilesAdded: function (up, files) {
                // 批量上传个数限制
                if ($(ele).data('limit')) {
                    if (parseInt($($(ele).data('img')).find('img').length + files.length) > parseInt($(ele).data('limit'))) {
                        alert('上传个数限制' + $(ele).data('limit') + '个');
                        for (var i = 0; i < files.length; i++) {
                            ccuploader.removeFile(files[i]);
                        }
                        return false;
                    }
                }
                ccuploader.start();
            },
            FileUploaded: function (up, file, ret) {
                eval('var tmp=' + ret.response);
                if (tmp.iError != 0) {
                    alert(tmp.msg);
                    return true;
                }
                var file = tmp.file.sKey + '.' + tmp.file.sExt;
                if ($(ele).data('target')) {
                    $($(ele).data('target')).val(file);
                }

                if ($(ele).data('img')) {
                    var height = $(ele).data('height') || 0;
                    var width = $(ele).data('width') || 0;
                    if (!$(ele).data('limit')) {
                        $($(ele).data('img')).attr('src', getDFSViewURL(file, width, height));
                    }

                };
                var sCheck=$(ele).data("check");
                var iWidth=$(ele).data("twidth");
                var iHeight=$(ele).data("theight");
                var ret_iWidth=tmp.file.iWidth;
                var ret_iHeight=tmp.file.iHeight;
                var sBili=$(ele).data("bili");
                if(sCheck){
                   if(sCheck=="dayu") {
                       if(iWidth && iHeight ){
                       if(ret_iWidth<iWidth || ret_iHeight<iHeight){
                           alert("您上传的图片尺寸小于规定尺寸，请上传宽高大于"+iWidth+"*"+iHeight+"的图片");
                           return false;
                       }
                       if(sBili){
                           var afm=(parseFloat(ret_iWidth)/parseFloat(ret_iHeight)).toFixed(2);
                           var bfz=(parseFloat(iWidth)/parseFloat(iHeight)).toFixed(2);
                           if(afm!=bfz){
                               alert("您上传的图片尺寸比例不对");
                             return false;
                           }

                       }
                     }
                   }
                   if(sCheck=="dengyu") {
                       if(iWidth && iHeight ){
                            if(ret_iWidth!=iWidth || ret_iHeight!=iHeight){
                                alert("您上传的图片尺寸不是规定尺寸，请上传宽高等于"+iWidth+"*"+iHeight+"的图片");
                                return false;
                            }
                       }
                       else{
                        if(ret_iWidth!=iWidth){
                            alert("您上传的图片尺寸不是规定尺寸，请上传宽等于"+iWidth+"的图片");
                            return false;
                        }
                     }
                   }
                };
                if ($(ele).data('callback')) {
                    var callback = eval($(ele).data('callback'));
                   // eval($(ele).data('callback') + '("' + file + '","' + $(ele).data("img")+ '","'+$(ele)+'")');
                    callback(file,ele);
                }
            }
        }
    });
    return ccuploader;
}
$('.plupload').each(function () {
    var ele = this;
    var ccuploader = initUpload(ele);
    ccuploader.init();
});
function getDFSViewURL(p_sFileKey, p_iWidth, p_iHeight, p_sOption) {
    if (!p_sFileKey) {
        return '';
    }
    p_iWidth = p_iWidth || 0;
    p_iHeight = p_iHeight || 0;
    p_sOption = p_sOption || '';

    var tmp = p_sFileKey.split('.');
    var p_sKey = tmp[0];
    var p_sExt = tmp[1];
    if (0 == p_iWidth && 0 == p_iHeight) {
        return global.sDfsViewUrl + '/' + p_sKey + '.' + p_sExt;
    } else {
        if ('' == p_sOption) {
            return global.sDfsViewUrl + '/' + p_sKey + '/' + p_iWidth + 'x' + p_iHeight + '.' + p_sExt;
        } else {
            return global.sDfsViewUrl + '/' + p_sKey + '/' + p_iWidth + 'x' + p_iHeight + '_' + p_sOption + '.' + p_sExt;
        }
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$("#button-add").click(function () {
    url = SCOPE.add_url;
    window.location.href = url;
});

$("#singcms-button-submit").click(function () {
    url = SCOPE.save_url;
    jumpUrl = SCOPE.jump_url;
    //获取表单提交数据
    data = $('#singcms-form').serialize();
    $.post(url, data, function (result) {
        if (result.status == 1) {
            return dialog.success(result.message, jumpUrl);
        } else {
            return dialog.error(result.message);
        }
    }, "JSON");
});

$("#singcms-listorder #singcms-edit").on('click', function () {
    id = $(this).attr('attr-id');
    url = SCOPE.edit_url+'&id='+id;
    window.location.href = url;
});

$('#singcms-listorder #singcms-delete').on('click',function(){
    id = $(this).attr('attr-id');
    url = SCOPE.set_status_url;
    data = {};
    data['id'] = id;
    data['status'] = -1;
    layer.open({
            content : '是否删除',
            icon:3,
            btn : ['是','否'],
            yes : function(){
                todelete(url,data);
            },
        });
});
function todelete(url,data){
    $.post(url,data,function(res){
        if(res.status == 0){
            dialog.error(res.message);
        }
        if(res.status == 1){
            dialog.success(res.message,'');
        }
    },'JSON');
}

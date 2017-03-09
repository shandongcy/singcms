/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$("#button-add").click(function () {
    var url = SCOPE.add_url;
    window.location.href = url;
});

$("#singcms-button-submit").click(function () {
    var url = SCOPE.save_url;
    var jumpUrl = SCOPE.jump_url;
    //获取表单提交数据
    var data = $('#singcms-form').serializeArray();
    $.post(url, data, function (result) {
        if (result.status == 1) {
            return dialog.success(result.message, jumpUrl);
        } else {
            return dialog.error(result.message);
        }
    }, "JSON");
});

$("#singcms-listorder #singcms-edit").on('click', function () {
    var id = $(this).attr('attr-id');
    var url = SCOPE.edit_url+'&id='+id;
    window.location.href = url;
});

$('#singcms-listorder #singcms-delete').on('click',function(){
    var id = $(this).attr('attr-id');
    var url = SCOPE.set_status_url;
    var data = {};
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

$('#button-listorder').click(function(){
    var data = $('#singcms-listorder').serializeArray();
    var url = SCOPE.listorder_url;
    var postData = {};
    //console.log(data);
    $(data).each(function(i){
        postData[this.name] = this.value;
    });
    $.post(url,postData,function(result){
        console.log(result['data']);
        console.log(result['data']['jump_url']);
        //处理返回
        if(result.status == 1){
            return dialog.success(result.message,result['data']['jump_url']);
        }else if(result.status == 0){
            return dialog.error(result.message);
        }
    },"JSON");
});


function todelete(url,data){
    $.post(url,data,function(res){
        if(res.status == 0){
           return dialog.error(res.message);
        }
        if(res.status == 1){
           return dialog.success(res.message,'');
        }
    },'JSON');
}

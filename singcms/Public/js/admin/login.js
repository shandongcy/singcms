/* 
 *登录验证js
 */
var login = {
    check : function(){
        //获取页面表单信息
        var username = $('input[name="username"]').val();
        var password = $('input[name="password"]').val();
        if(!username){
            dialog.error("用户名不能为空");
        }
        if(!password){
            dialog.error("用户密码不能为空");
        }
        var url = "/admin.php?c=login&a=check";
        var data = {'username':username,'password':password};
        //执行异步传输 
        $.post(url,data,function(result){
            if(result.status == 0) {
                return dialog.error(result.message);
            }
            if(result.status == 1) {
                return dialog.success(result.message,'/admin.php')
            }
        },"JSON");
    }
}


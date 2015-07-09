$(function(){

var staffKey = $.cookie("staffKey");
if(staffKey) window.location.href = "index.php";

$('.loginEnter').on('click',function(){
    if($('.loginStaff').val() && $('.loginPassword').val()){
        var login = $('.loginStaff').val()+","+$('.loginPassword').val();
        $.ajax({async: false,type: 'POST',url: 'php/ajax.php',dataType: 'json',data: {"login": login},
            success: function(data){
                if(data==="No"){
                    alert('ログインパスワードが間違っています。');
                }else{
                    $.cookie("staffKey",data,{expires:7});
                    window.location.href = "index.php";
                }
            },error: function(data){
                alert('通信障害によりログインできませんでした。\n再度、ログインをお願いいたします。');
                location.reload();
            }
        });
    }
});

})
function getRequest(){
    if(location.search.length > 1) {
    var get_ = {};
    var ret = location.search.substr(1).split("&");
    for(var i = 0; i < ret.length; i++) {
      var r = ret[i].split("=");
      get_[r[0]] = r[1];
    }
    return get_;
    } else {
    return false;
    }
}
//blackSheet表示
function blackSheetDisplay(display){
    var windowWidth = $(window).width();
    var windowHeight = $(window).height();
    if(display){
        $(".blackSheet").css({'width':windowWidth,
                            'height':windowHeight});
        $(".blackSheet").show(200);
    }else{
        $(".blackSheet").css({'width':windowWidth,
                            'height':windowHeight});
    }
}
//blackSheet非表示
function blackSheetHide(){
    configSelectHide();
    taskFormReset(true);
    classFormReset(true);
    groupFormReset(true);
    $(".blackSheet").hide(200);
    location.reload();
}

//設定項目表示
function configSelectDisplay(){
    $('.configSelect').css({'margin-left':'-'+$('.configSelect').width()/2 +'px',
                            'margin-top':'-'+$('.configSelect').height()/2 +'px'
                            });
    $('.configSelect').show(200);
}
//設定項目表示
function configSelectHide(){
    $('.configSelect').hide(200);
}
function taskFormDisplay(date){
    if(!date){
        var newDate = new Date();
        var date = newDate.getFullYear()+'/'+(newDate.getMonth()+1)+'/'+newDate.getDate();
    }
    $('.taskFormDate').val(date);
    $('.taskForm').css({'margin-left':'-'+$('.taskForm').width()/2 +'px',
                        'margin-top':'-'+$('.taskForm').height()/2 +'px'
                        });
    $('.taskForm').show(200);
}
function taskFormReset(display){
    $('.taskFormTitle').val('');
    $('.taskFormDate').val('');
    $('.taskFormClass').val('');
    $('.taskFormLank').val('');
    $('.taskFormDetail').val('');
    if(display) $('.taskForm').hide(200);
}
function classFormDisplay(){
    $('.classForm').css({'margin-left':'-'+$('.classForm').width()/2 +'px',
                        'margin-top':'-'+$('.classForm').height()/2 +'px'
                        });
    $('.classForm').show(200);
}
function classFormReset(display){
    $('.classFormName').val('');
    $('.classFormColor').attr('class','classFormColor');
    if(display) $('.classForm').hide(200);
}
function groupFormDisplay(){
    $('.groupForm').css({'margin-left':'-'+$('.groupForm').width()/2 +'px',
                        'margin-top':'-'+$('.groupForm').height()/2 +'px'
                        });
    $('.groupForm').show(200);
}
function groupFormReset(display){
    $('.groupFormName').val('');
    $('.groupFormStaff').attr('class','groupFormStaff');
    if(display) $('.groupForm').hide(200);
}

//日付チェック
function dateCheck(date){
    var error = false;
    if(date){
        var dateText = date.replace('-', '/');
        var dateText = dateText.replace('　', ' ');
        var dateText = dateText.replace('：', ':');
        var timeStmp = new Date(dateText).getTime();
        if(!timeStmp) error = true;
    }else{
        error = true;
    }
    return(error);
}
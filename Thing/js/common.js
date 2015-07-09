$(function(){
    //ゲット取得
    var get = getRequest();
    //blackSheet調整
    $(window).on('resize', function(){
        blackSheetDisplay();
    });

    $('.blackSheet').on('click',function(){
        blackSheetHide();
    });
    $('.windowCancel').on('click',function(){
        blackSheetHide();
    });

    //タスクフォーム表示
    $('.taskInput').on('click', function(){
        blackSheetDisplay(true);
        taskFormDisplay(get['displayDate']);
    });
    $('.taskFormEnter').on('click', function(){
        var name = $('.taskFormTitle').val();
        var date = $('.taskFormDate').val();
        var Class = $('.taskFormClass').val();
        var lank = $('.taskFormLank').val();
        if(!lank) lank = 0;
        var detail = $('.taskFormDetail').val();
        var cText = "";
        dateError = dateCheck(date);
        if(!name) cText = cText+"タスク名を入力してください\n";
        if(dateError) cText = cText+"日付を正しく入力してください\n";
        if(!Class) cText = cText+"クラスを選択してください\n";
        if(name&&!dateError&&Class){
            $.ajax({async: false,type: 'POST',url: 'php/ajax.php',dataType: 'json',data: {"taskRegistration": name+','+date+','+Class+','+lank+','+detail},
                success: function(data){
                    taskFormReset();
                    alert('タスクを追加しました。');
                },error: function(data){
                    alert('通信障害により登録できませんでした。\n再度、登録をお願いいたします。');
                }
            });
        }else{
            alert(cText);
        }
    });

    //設定
    $('.config').on('click', function(){
        blackSheetDisplay(true);
        configSelectDisplay();
    });
    //クラス
    $('.classConfig').on('click', function(){
        configSelectHide();
        classFormDisplay();
    });
    $('.classFormColor').on('click',function(){
        $('.classFormColor').attr('class','classFormColor');
        $(this).addClass('colorCheck');
    });
    $('.classFormEnter').on('click',function(){
        var name = $('.classFormName').val();
        var color = $('.colorCheck').data('id');
        if(!color) color = 0;
        if(name){//登録
            $.ajax({async: false,type: 'POST',url: 'php/ajax.php',dataType: 'json',data: {"classRegistration": name+","+color},
                success: function(data){
                    var newData = $('<div class="classListRow"></div>');
                    $(newData).attr({'data-id':data['id'],
                                    'data-color':data['color'],
                                    'data-name':data['name']
                                    });
                    $(newData).append('<div class="classListName">'+data['name']+'</div><div class="classListEdit">編集</div><div class="classListDel">削除</div>');
                    $('.classListArea').append(newData);
                    alert('「'+data['name']+'」を追加しました。');
                    classFormReset();
                },error: function(data){
                    alert('通信障害により登録できませんでした。\n再度、登録をお願いいたします。');
                }
            });
        }else{
            alert("名前を入力してください");
        }
    });
    //グループ
    $('.gorupConfig').on('click', function(){
        configSelectHide();
        groupFormDisplay();
    });
    $('.groupFormStaff').on('click',function(){
        $(this).toggleClass('staffCheck');
    });
    $('.groupFormEnter').on('click',function(){
        console.log('aaaa');
        var name = $('.groupFormName').val();
        var staff = "";
        $('.staffCheck').each(function(index, element) {
            staff = staff+$(element).data('id')+"/";
        });
        var cText = "";
        if(!name) cText = cText+"グループ名を入力してください\n";
        if(!staff) cText = cText+"スタッフを1人以上選択してください\n";
        if(name&&staff){
            $.ajax({async: false,type: 'POST',url: 'php/ajax.php',dataType: 'json',data: {"groupRegistration": name+","+staff},
                success: function(data){
                    var newData = $('<div class="groupListRow"></div>');
                    $(newData).attr({'data-id':data['id'],
                                    'data-staff':data['staff']
                                    });
                    $(newData).append('<div class="groupListName">'+data['name']+'</div><div class="groupListEdit">編集</div><div class="groupListDel">削除</div>');
                    $('.groupListArea').append(newData);
                    alert('「'+data['name']+'」を追加しました。');
                    groupFormReset();
                },error: function(data){
                    alert('通信障害により登録できませんでした。\n再度、登録をお願いいたします。');
                }
            });
        }else{
            alert(cText);
        }
    });


});
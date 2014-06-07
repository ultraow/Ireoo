/**
 * Created with JetBrains PhpStorm.
 * User: Administrator
 * Date: 13-9-7
 * Time: 下午12:15
 * To change this template use File | Settings | File Templates.
 */
var choose = function(divID, obj) {
    var xianshi = false;
    var div = $(divID).hide();
    var s = $('<div />').css({border: '1px #CCC solid', display: 'inline-block', padding: '5px', fontSize: '14px', position: 'relative'}).width($(divID).width()).append($('<span />').text(div.val()==''?'　':div.val()));
    div.after(s);
    var list = $('<ul />').appendTo(s).width(s.width() + 10).hide().css({position: 'absolute', top: (s.height() + 10) + 'px', left: '-1px', border: '1px #CCC solid', background: '#FFF', overflowY: 'auto', zIndex: '100'}).hover(
        function() {},
        function() {
            list.hide();
            xianshi = false;
        }
    );
    var show = function(id) {
        list.find('li').remove();
        if(obj instanceof Array) {
            if(obj.length > 7) list.height(200);
            for(var i = 0; i < obj.length; i++) {
                var li = $('<li />').text(obj[i]==''?'　':obj[i]).attr('id', obj[i]).appendTo(list).css({display: 'block'}).hover(
                    function() {
                        if($(this).attr('rel') != 'active') {
                            $(this).css({background: '#CCC'});
                        }
                    },
                    function() {
                        if($(this).attr('rel') != 'active') {
                            $(this).css({background: ''});
                        }
                    }
                ).click(function() {
                        s.find('span').text($(this).text());
                        div.val($(this).text());
                        list.find('li').attr('rel', '').css({background: '', color: ''});
                        $(this).css({background: '#4898F8', color: '#FFF'}).attr('rel', 'active');
                        list.hide();
                        xianshi = false;
                        s.id = $(this).attr('id');
                    }
                );
                if(obj[i] == s.find('span').text()) {
                    li.css({background: '#4898F8', color: '#FFF'}).attr('rel', 'active');
                }
            }

        }else{
            $.ajax({
                url: '/app/basic/getCity.php?id=' + id,
                dataType: 'json',
                success: function(data) {
                    //alert(data);
                    if(data.length > 7) list.height(200);
                    for(var i =0; i < data.length; i++) {
//                    for(var key in data[i]) {
//                        alert("key："+key+",value："+data[i][key].name);
//                    }
                        var li = $('<li />').text(data[i]['region'].name==''?'　':data[i]['region'].name).attr('id', data[i]['region'].id).appendTo(list).css({display: 'block'}).hover(
                            function() {
                                if($(this).attr('rel') != 'active') {
                                    $(this).css({background: '#CCC'});
                                }
                            },
                            function() {
                                if($(this).attr('rel') != 'active') {
                                    $(this).css({background: ''});
                                }
                            }
                        ).click(function() {
                                s.find('span').text($(this).text());
                                div.val($(this).text());
                                list.find('li').attr('rel', '').css({background: '', color: ''});
                                $(this).css({background: '#4898F8', color: '#FFF'}).attr('rel', 'active');
                                list.hide();
                                xianshi = false;
                                s.id = $(this).attr('id');
                            }
                        );

                        if(data[i]['region'].name == s.find('span').text()) {
                            li.css({background: '#4898F8', color: '#FFF'}).attr('rel', 'active');
                            s.id = data[i]['region'].id;
                        }
                    }
                }
            });
        }


    }
    $('<i />').css({background: '#CCC', display: 'inline-block', width: (s.height() + 8) + 'px', height: (s.height() + 8) + 'px', cursor: 'pointer', position: 'absolute', top: '1px', right: '1px'}).click(function() {
        if(!xianshi) {
            var reg = /^(-|\+)?\d+$/;
            if(reg.test(obj.id)) {
                show(obj.id);
            }else{
                show(obj);
            }
            list.slideDown();
            xianshi = true;
        }else{
            xianshi = false;
            list.hide();
        }
    }).appendTo(s);
    s.id = 0;
    var reg = /^(-|\+)?\d+$/;
    if(reg.test(obj.id)) {
        show(obj.id);
    }else{
        show(obj);
    }

    this.showButton = function(divID) {
        $(divID).after($('<button />').text('保存'));
    }
    
    return s;
}

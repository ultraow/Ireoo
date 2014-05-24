/**
 * Created by ireoo.com on 13-12-9.
 */

var sendMessage = function(id) {
    var box = $('<div />').appendTo('body').css({position: "fixed", background: "#4898F8", padding: '3px', boxShadow: '0 0 3px RGBA(0, 0, 0, 0.6)'});

    var close = $('<a />').text('x').appendTo(box).click(function() {
        box.remove();
    }).css({background: '#4898F8', color: '#FFF', position: 'absolute', top: '0', right: '0', width: '18px', height: '18px', textAlign: 'center', lineHeight: '18px', cursor: 'pointer'}).hover(
            function() {
                $(this).css({background: 'red'});
            },
            function() {
                $(this).css({background: '#4898F8'});
            }
        );

    var textBtn = $('<button />').text('文本').appendTo(box).click(function() {
        div.empty();
        $(this).addClass('on');
        imageBtn.removeClass('on').css({background: '#4898F8', color: '#FFF'});
        newsBtn.removeClass('on').css({background: '#4898F8', color: '#FFF'});
        var text = $('<textarea />').appendTo(div).width(400).height(200).css({border: '1px #FFF solid', padding: '10px', fontSize: '14px'});
        change();
    }).css({background: '#FFF', color: '#4898F8'}).hover(
            function() {
                $(this).css({background: '#FFF', color: '#4898F8'});
            },
            function() {
                if(!$(this).hasClass('on')) $(this).css({background: '#4898F8', color: '#FFF'});
            }
    ).addClass('on');
    var imageBtn = $('<button />').text('图片').appendTo(box).click(function() {
        div.empty();
        $(this).addClass('on');
        textBtn.removeClass('on').css({background: '#4898F8', color: '#FFF'});
        newsBtn.removeClass('on').css({background: '#4898F8', color: '#FFF'});

        change();
    }).css({background: '#4898F8', color: '#FFF'}).hover(
        function() {
            $(this).css({background: '#FFF', color: '#4898F8'});
        },
        function() {
            if(!$(this).hasClass('on')) $(this).css({background: '#4898F8', color: '#FFF'});
        }
    );
    var newsBtn = $('<button />').text('新闻').appendTo(box).click(function() {
        div.empty();
        $(this).addClass('on');
        textBtn.removeClass('on').css({background: '#4898F8', color: '#FFF'});
        imageBtn.removeClass('on').css({background: '#4898F8', color: '#FFF'});

        change();
    }).css({background: '#4898F8', color: '#FFF'}).hover(
        function() {
            $(this).css({background: '#FFF', color: '#4898F8'});
        },
        function() {
            if(!$(this).hasClass('on')) $(this).css({background: '#4898F8', color: '#FFF'});
        }
    );
    //var span = $('<h1 />').appendTo(box).text('TO : ' + id).css({fontSize: '12px', background: "#FFF", color: '#4898F8'});
    var div = $('<div />').appendTo(box);
    var text = $('<textarea />').appendTo(div).width(400).height(200).css({border: '1px #FFF solid', padding: '10px', fontSize: '14px'});


    var change = function() {
        var winHeight = $(window).height();
        var winWidth = $(window).width();
        var divHeight = box.height();
        var divWidth = box.width();
        var top = (winHeight - divHeight) / 2;
        var left = (winWidth - divWidth) / 2;
        box.css({ top: top + "px", left: left + "px"});
    };

    var button = $('<button />').appendTo(box).click(function() {
        $.ajax(
            {
                url: '/app/weixin/include/sendMessage.php',
                type: 'GET',
                data: {
                    id: id,
                    txt: text.val(),
                    type: 'text'
                },
                dataTpye: 'json',
                success: function(re) {
                    var obj = JSON.parse(re);
                    if(obj.errmsg == 'ok') {
                        alert('信息已发送!');
                        box.remove();
                    }else{
                        alert(obj.errcode);
                    }
                }
            }
        );
    }).css({display: 'block', background: '#333'}).text('发送');

    change();

};
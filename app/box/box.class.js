/**
 * Created with JetBrains PhpStorm.
 * User: Administrator
 * Date: 13-9-4
 * Time: 下午2:28
 * To change this template use File | Settings | File Templates.
 */
var box = function(divID) {
    var a = $(divID).click(function() {
        //初始化元素
        var close = true;
        var bg = $('<div />').appendTo('body').click(function() {
            if(close) $(this).remove();
            close = true;
        });
        var div = $('<div />').appendTo(bg).click(function() {
            close = false;
        });
        var imgArea = $('<div />').appendTo(div);
        //var list = $('<div />').appendTo(div);
        var showcomment = $('<div />').appendTo(div);

        var i_n = $('<i />').css({backgroundImage: 'url(include/images/photo.png)', display: 'inline-block', backgroundPosition: '-267px -187px', width: '27px', height: '45px'});
        var i_p = $('<i />').css({backgroundImage: 'url(include/images/photo.png)', display: 'inline-block', backgroundPosition: '-268px -124px', width: '27px', height: '45px'});

        var next = $('<a />').append(i_n).appendTo(imgArea).css({ zIndex: 100, cursor: 'pointer', display: 'inline-block', paddingRight: '10px', width: '27px', height: '45px', position: 'absolute', opacity: '0.3', top: '0px', right: '360px'}).click(function() {
            now ++;
            if(now >= list.length) now = 0;
            src = list[now];
            showImg();
        }).hover(
            function() {
                $(this).css({opacity: '1'});
            },
            function() {
                $(this).css({opacity: '0.3'});
            }
        );
        var pre = $('<a />').append(i_p).appendTo(imgArea).css({zIndex: 100, cursor: 'pointer', display: 'inline-block', paddingLeft: '10px', width: '27px', height: '45px', position: 'absolute', opacity: '0.3', top: '0px', left: '0px'}).click(function() {
            now --;
            if(now < 0) now = list.length - 1;
            src = list[now];
            console.log(now + ':' + src);
            showImg();
        }).hover(
            function() {
                $(this).css({opacity: '1'});
            },
            function() {
                $(this).css({opacity: '0.3'});
            }
        );

        var src = $(this).attr('src');
        var list = [];
        var now = 0;

        //分配元素样式
        bg.css({background: 'RGBA(0, 0, 0, 0.94)',zIndex: 100000, position: 'fixed', top: '0px', left: '0px'}).width($(window).width()).height($(window).height());
        div.height($(window).height() - 40).css({background: '#000', zIndex:100001, position: 'absolute', top: '20px', left: '20px'});
        showcomment.height(div.height()).width(360).css({position: 'absolute', right: '0px', top: '0px'});
        imgArea.height(div.height()).css({position: 'relative', paddingRight: '360px'});
        //list.width(690).height(50).css({padding: '5px'});
        showcomment.css({background: '#FFF'});

        //获取图片大小确定显示位置
        var showImg = function() {
            imgArea.find('img').remove();
            var img = $('<img />').appendTo(imgArea).attr('src', src).css({position: 'absolute'});
            var w = img.width();
            var h = img.height();

            console.log('[w:h]' + img.width() + ':' + img.height());
            if(w > $(window).width() - 400) {
                img.width($(window).width() - 400);
                img.height(img.width()/w*h);
            }
            console.log('[w:h]' + img.width() + ':' + img.height());
            if(($(window).height() - 40) < img.height()) {
                img.height($(window).height() - 40);
                img.width(img.height()/h*w);
            }
            console.log('[w:h]' + img.width() + ':' + img.height());

            imgArea.width(img.width()<400?400:img.width());
            imgArea.height(img.height()<400?400:img.height());
            img.css({top: ((imgArea.height() - img.height())/2) + 'px', left: ((imgArea.width() - img.width())/2) + 'px'});
            div.height(img.height()<400?400:img.height());
            var l = ($(window).width() - div.width())/2;
            var t = ($(window).height() - div.height())/2;
            div.css({background: '#000', zIndex:100001, position: 'absolute', top: t, left: l});
            showcomment.height(div.height());

            next.height(imgArea.height()).css({lineHeight: imgArea.height() + 'px', paddingLeft: ((imgArea.width() - 20)/3*2 - 27) + 'px'});
            pre.height(imgArea.height()).css({lineHeight: imgArea.height() + 'px', paddingRight: ((imgArea.width() - 47)/3 - 27) + 'px'});
        };

        //获取图片列表
        var showList = function() {
            $(divID).each(function(i) {
                list.push($(this).attr('src'));
                if($(this).attr('src') == src) now = i;
            });
            console.log(list + now);
        };
        showList();

        showImg();

        //浏览器大小改变时触发
        $(window).bind("resize", function() {
            //div.height(img.height()<400?400:img.height());
            var l = ($(window).width() - div.width())/2;
            var t = ($(window).height() - div.height())/2;
            div.css({background: '#000', zIndex:100001, position: 'absolute', top: t, left: l});
            showcomment.height(div.height()).width(360).css({position: 'absolute', right: '0px', top: '0px'});
            var img = imgArea.find('img');
            img.css({top: ((imgArea.height() - img.height())/2) + 'px', left: ((imgArea.width() - img.width())/2) + 'px'});
            bg.width($(window).width()).height($(window).height());
            showImg();
        });


    });
};
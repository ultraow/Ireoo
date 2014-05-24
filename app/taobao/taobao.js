/**
 * Created with JetBrains PhpStorm.
 * User: Ultra
 * Date: 13-2-18
 * Time: 下午3:56
 * To change this template use File | Settings | File Templates.
 */

/**
 * 说明：
 * 淘宝链接转化js
 */

(function(win,doc){
    var s = doc.createElement("script"), h = doc.getElementsByTagName("head")[0];
    if (!win.alimamatk_show) {
    s.charset = "gbk";
    s.async = true;
    s.src = "http://a.alimama.cn/tkapi.js";
    h.insertBefore(s, h.firstChild);
    }
var o = {
    pid: "mm_27201356_3476513_11331535",
    appkey: "",
    unid: ""
    }
win.alimamatk_onload = win.alimamatk_onload || [];
win.alimamatk_onload.push(o);
})(window,document);


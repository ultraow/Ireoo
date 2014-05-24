<?php
/**
 * Created by PhpStorm.
 * User: Ultra
 * Date: 13-12-1
 * Time: 下午8:33
 */

class wechatCallbackapiTest
{

    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if($tmpStr == $signature) {
            return true;
        }else{
            return false;
        }
    }

    function __construct()
    {
        //valid signature , option
        if($this->checkSignature()){
            if(isset($_GET["echostr"])) die($_GET["echostr"]);    // 如果是验证消息，只打印验证信息。
            //exit;
        }

        $poststr = $GLOBALS["HTTP_RAW_POST_DATA"];
        $p = xml_parser_create();
        xml_parse_into_struct($p, $poststr, $vals, $index);
        xml_parser_free($p);

        $this->array = array();
        foreach($vals as $key => $value) {
            $this->array[$value['tag']] = $value['value'];
        }

    }

    public function text($txt = '', $now = 0) {

        if($txt == '') $txt = json_encode($this->array);
        if($now == 0) $now = time();
        echo "<xml><ToUserName><![CDATA[{$this->array['FROMUSERNAME']}]]></ToUserName><FromUserName><![CDATA[{$this->array['TOUSERNAME']}]]></FromUserName><CreateTime>{$now}</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[{$txt}]]></Content></xml>";
    }

    public function image($imageID, $now = 0) {

        if($now == 0) $now = time();
        echo "<xml><ToUserName><![CDATA[{$this->array['FROMUSERNAME']}]]></ToUserName><FromUserName><![CDATA[{$this->array['TOUSERNAME']}]]></FromUserName><CreateTime>{$now}</CreateTime><MsgType><![CDATA[image]]></MsgType><Image><MediaId><![CDATA[{$imageID}]]></MediaId></Image></xml>";

    }

    public function voice($voiceID, $now = 0) {

        if($now == 0) $now = time();
        echo "<xml><ToUserName><![CDATA[{$this->array['FROMUSERNAME']}]]></ToUserName><FromUserName><![CDATA[{$this->array['TOUSERNAME']}]]></FromUserName><CreateTime>{$now}</CreateTime><MsgType><![CDATA[voice]]></MsgType><Voice><MediaId><![CDATA[{$voiceID}]]></MediaId></Voice></xml>";

    }

    public function video($videoID, $title, $description, $now = 0) {

        if($now == 0) $now = time();
        echo "<xml><ToUserName><![CDATA[{$this->array['FROMUSERNAME']}]]></ToUserName><FromUserName><![CDATA[{$this->array['TOUSERNAME']}]]></FromUserName><CreateTime>{$now}</CreateTime><MsgType><![CDATA[video]]></MsgType><Video><MediaId><![CDATA[{$videoID}]]></MediaId><Title><![CDATA[{$title}]]></Title><Description><![CDATA[{$description}]]></Description></Video></xml>";

    }

    public function music($title, $description, $music_url, $HQ_music_url, $musicID, $now = 0) {

        if($now == 0) $now = time();
        echo "<xml><ToUserName><![CDATA[{$this->array['FROMUSERNAME']}]]></ToUserName><FromUserName><![CDATA[{$this->array['TOUSERNAME']}]]></FromUserName><CreateTime>{$now}</CreateTime><MsgType><![CDATA[music]]></MsgType><Music><Title><![CDATA[{$title}]]></Title><Description><![CDATA[{$description}]]></Description><MusicUrl><![CDATA[{$music_url}]]></MusicUrl><HQMusicUrl><![CDATA[{$HQ_music_url}]]></HQMusicUrl><ThumbMediaId><![CDATA[{$musicID}]]></ThumbMediaId></Music></xml>";

    }

    public function news($list = array(), $now = 0) {

        if($now == 0) $now = time();
        $member = count($list);
        echo "<xml><ToUserName><![CDATA[{$this->array['FROMUSERNAME']}]]></ToUserName><FromUserName><![CDATA[{$this->array['TOUSERNAME']}]]></FromUserName><CreateTime>{$now}</CreateTime><MsgType><![CDATA[news]]></MsgType><ArticleCount>{$member}</ArticleCount><Articles>";
        foreach($list as $key => $value) {
            echo "<item><Title><![CDATA[{$value['title']}]]></Title> <Description><![CDATA[{$value['description']}]]></Description><PicUrl><![CDATA[{$value['picurl']}]]></PicUrl><Url><![CDATA[{$value['url']}]]></Url></item>";
        }
        echo "</Articles></xml> ";
    }

    public function card($list = array(), $now = 0) {

        if($now == 0) $now = time();
        $member = count($list);
        echo "<xml><ToUserName><![CDATA[{$this->array['FROMUSERNAME']}]]></ToUserName><FromUserName><![CDATA[{$this->array['TOUSERNAME']}]]></FromUserName><CreateTime>{$now}</CreateTime><MsgType><![CDATA[news]]></MsgType><ArticleCount>{$member}</ArticleCount><Articles>";
        foreach($list as $key => $value) {
            echo "<item><Title><![CDATA[{$value['title']}]]></Title> <Description><![CDATA[{$value['description']}]]></Description><PicUrl><![CDATA[{$value['picurl']}]]></PicUrl><Url><![CDATA[{$value['url']}]]></Url></item>";
        }
        echo "</Articles></xml> ";
    }

    public function save($mysql, $txt = '') {
        $sql = array(
            'wid' => $this->array['TOUSERNAME'],
            'openid' => $this->array['FROMUSERNAME'],
            'msgtype' => $this->array['MSGTYPE'],
            'event' => $this->array['EVENT'],
            'array' => json_encode($this->array),
            'timer' => time()
        );
        $mysql->insert('wechatTalk', $sql);
    }

}
?>
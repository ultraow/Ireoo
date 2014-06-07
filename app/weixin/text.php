<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ultra
 * Date: 13-8-9
 * Time: 下午3:53
 * To change this template use File | Settings | File Templates.
 */

$simple = "<xml>
 <ToUserName><![CDATA[toUser]]></ToUserName>
 <FromUserName><![CDATA[fromUser]]></FromUserName>
 <CreateTime>1348831860</CreateTime>
 <MsgType><![CDATA[text]]></MsgType>
 <Content><![CDATA[this is a test]]></Content>
 <MsgId>1234567890123456</MsgId>
 </xml>";
$p = xml_parser_create();
xml_parse_into_struct($p, $simple, $vals, $index);
xml_parser_free($p);
echo "Index array\n";
print_r($index);
echo "\nVals array\n";
print_r($vals);

echo "\n\n\n" . $vals[$index['MSGTYPE'][0]]['value'];

?>
<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ultra
 * Date: 13-2-18
 * Time: 下午3:29
 * To change this template use File | Settings | File Templates.
 */
header("Content-type: text/html; charset=utf-8");

define("TAOBAO_APP_KEY", "21390994");
define("TAOBAO_APP_SECRET", "5a96274973cee8311d3a9bc2b61c16a8");
/**
 * TOP SDK 入口文件
 * 请不要修改这个文件，除非你知道怎样修改以及怎样恢复
 * @author wuxiao
 */

/**
 * 定义常量开始
 * 在include("TopSdk.php")之前定义这些常量，不要直接修改本文件，以利于升级覆盖
 */
/**
 * SDK工作目录
 * 存放日志，TOP缓存数据
 */
if (!defined("TOP_SDK_WORK_DIR"))
{
    define("TOP_SDK_WORK_DIR", "/tmp/");
}
/**
 * 是否处于开发模式
 * 在你自己电脑上开发程序的时候千万不要设为false，以免缓存造成你的代码修改了不生效
 * 部署到生产环境正式运营后，如果性能压力大，可以把此常量设定为false，能提高运行速度（对应的代价就是你下次升级程序时要清一下缓存）
 */
if (!defined("TOP_SDK_DEV_MODE"))
{
    define("TOP_SDK_DEV_MODE", true);
}
/**
 * 定义常量结束
 */

/**
 * 找到lotusphp入口文件，并初始化lotusphp
 * lotusphp是一个第三方php框架，其主页在：lotusphp.googlecode.com
 */
$lotusHome = dirname(__FILE__) . DIRECTORY_SEPARATOR . "lotusphp_runtime" . DIRECTORY_SEPARATOR;
include($lotusHome . "Lotus.php");
$lotus = new Lotus;
$lotus->option["autoload_dir"] = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'top';
$lotus->devMode = TOP_SDK_DEV_MODE;
$lotus->defaultStoreDir = TOP_SDK_WORK_DIR;
$lotus->init();

/**
 * 淘宝API接口调用初始化
 */

$c = new TopClient;
$c->appkey = TAOBAO_APP_KEY;
$c->secretKey = TAOBAO_APP_SECRET;

/**
 * 调用 ItemGetRequest 接口
 */
$req = new ItemGetRequest;
$req->setFields("detail_url,num_iid,title,nick,type,cid,seller_cids,props,input_pids,input_str,desc,pic_url,num,valid_thru,list_time,delist_time,stuff_status,location,price,post_fee,express_fee,ems_fee,has_discount,freight_payer,has_invoice,has_warranty,has_showcase,modified,increment,approve_status,postage_id,product_id,auction_point,property_alias,item_img,prop_img,sku,video,outer_id,is_virtual");

/**
 * demo
 */

//$req->setNumIid(21778076131);
//
//$taobao = $c->execute($req);
////$item = get_object_vars($resp);
//
//print_r($taobao);
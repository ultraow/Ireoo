<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>比特币盈利计算</title>
    <script src="http://code.jquery.com/jquery-2.0.3.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    	$(
    		function() {
    			var l = 0;
	    		var one = 1 - 1 * 0.002 - 0.0001;
	    		$('#sell').keyup(
	    			function() {
		    			$('#get').text(Math.floor(($(this).val() * one - $('#buy').val() * $('#hl').val()) * 10000) / 10000);
		    			$('#buyspan').text(Math.floor($('#buy').val() * $('#hl').val() * 10000) / 10000);
		    			$('#putspan').text(Math.floor($('#put').val() / $('#hl').val() * 10000) / 10000);
	    				//l = ;
	    				$('#input').text(Math.floor($('#put').val() / $('#hl').val() * (1 - 0.06) * 10000) / 10000);
	    				var meiyuan = Math.floor($('#put').val() / $('#hl').val() * (1 - 0.06) * 10000) / 10000;
	    				var getbtc = meiyuan / $('#buy').val();
	    				var zong = (getbtc - getbtc * 0.002 - 0.0001) * $('#sell').val();
	    				var yingli = zong - meiyuan * $('#hl').val();
	    				$('#getbtc').text(getbtc);
	    				$('#out').text(zong);
	    				$('#yingli').text(yingli);
	    			}
	    		);
	    		$('#buy').keyup(
	    			function() {
	    				$('#get').text(Math.floor(($(this).val() * one - $('#buy').val() * $('#hl').val()) * 10000) / 10000);
		    			$('#buyspan').text(Math.floor($('#buy').val() * $('#hl').val() * 10000) / 10000);
		    			$('#putspan').text(Math.floor($('#put').val() / $('#hl').val() * 10000) / 10000);
	    				//l = ;
	    				$('#input').text(Math.floor($('#put').val() / $('#hl').val() * (1 - 0.06) * 10000) / 10000);
	    				var meiyuan = Math.floor($('#put').val() / $('#hl').val() * (1 - 0.06) * 10000) / 10000;
	    				var getbtc = meiyuan / $('#buy').val();
	    				var zong = (getbtc - getbtc * 0.002 - 0.0001) * $('#sell').val();
	    				var yingli = zong - meiyuan * $('#hl').val();
	    				$('#getbtc').text(getbtc);
	    				$('#out').text(zong);
	    				$('#yingli').text(yingli);
	    			}
	    		);
	    		$('#put').keyup(
	    			function() {
	    				//l = ;
	    				$('#putspan').text(Math.floor($('#put').val() / $('#hl').val() * 10000) / 10000);
	    				//l = ;
	    				$('#input').text(Math.floor($('#put').val() / $('#hl').val() * (1 - 0.06) * 10000) / 10000);
	    				var meiyuan = Math.floor($('#put').val() / $('#hl').val() * (1 - 0.06) * 10000) / 10000;
	    				var getbtc = meiyuan / $('#buy').val();
	    				var zong = (getbtc - getbtc * 0.002 - 0.0001) * $('#sell').val();
	    				var yingli = zong - meiyuan * $('#hl').val();
	    				$('#getbtc').text(getbtc);
	    				$('#out').text(zong);
	    				$('#yingli').text(yingli);
	    			}
	    		);
    		}
    	);
    </script>
</head>
<body>

<div>当前汇率 : <input id="hl" value="6.0939" /></div>

<div>买一价 : <input id="buy" />美元，折合 <span id="buyspan"></span> 元。</div>
<div>卖一价 : <input id="sell" />元</div>

<div>1个比特币盈利 : <span id="get"></span>元</div>

<div>投入资金 <input id="put" />元，折合 <span id="putspan"></span> 美元， 除去 6% 手续费，可投入 <span id="input"></span> 美元。</div>
<div>总价值 <span id="out"></span> 元，总盈利 <span id="yingli"></span> 元，可以购买 <span id="getbtc"></span> 个BTC。</div>
</body>
</html>
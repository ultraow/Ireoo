<style type="text/css">
    div.mian ol{padding-bottom: 100px;}
    div.mian ol li{font-size: 12px; overflow: auto; position: relative; padding-top: 5px; padding-bottom: 10px; margin-bottom: 100px;}

    div.mian ol li label{display: inline-block; font-size: 16px; color: #666; padding-right: 5px;}
    div.mian ol li input{padding: 4px; font-size: 16px; width: 200px;}
    div.mian ol li select{padding: 3px;}
    div.mian ol li button{padding: 5px 20px;}

	h3{font-size: 14px; color: #666; margin-bottom: 10px;}
	div.new a{border: 3px #4898F8 solid; padding: 5px 10px 5px 10px; margin-right: 20px; color: #4898F8; display: inline-block;}
    button{padding: 5px 20px;}
</style>
<script type="text/javascript">
    $(
            function() {
                $('button.add').click(
                        function() {
                            var label = $(this).parent().find('label');
                            $.post(
                                    'include/php/storeAdd.php',
                                    {
                                        '`sname`' : $('input[name="sname"]').val(),
                                        '`city`' : '淮安',
                                        '`uid`' : '<?php echo $o['id']; ?>'
                                    },
                                    function(data) {
                                        alert('保存成功!');
                                        //alert(data);
                                        //label.text(data);
                                        location.href = "i?s=store";
                                    }
                            );
                        }
                );
            }
    );

</script>

<ol>

    <h1>创建一个琦益商家</h1>
    <h2>下面的为必填项目，为了更好的宣传你的商家，请认真填写！</h2>

    <li>
        <label>名称</label>
        <input type="text" name="sname" value="" />
		<button class="add">创建</button>
    </li>

</ol>

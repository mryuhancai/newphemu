<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"><![endif]-->
    <!--[if lt IE 9]><script src="<?php echo XHtml::jsUrl('html5shiv.js'); ?>"</script><![endif]-->
   <link rel="stylesheet" type="text/css" href="<?php echo XHtml::cssUrl('main.css'); ?>" />
   <link rel="stylesheet" type="text/css" href="<?php echo XHtml::cssUrl('960.css'); ?>" />
   <script type="text/javascript" src="<?php echo XHtml::jsUrl('jquery-1.4a2.min.js'); ?>"></script>
   <script type="text/javascript" src="<?php echo XHtml::jsUrl('jquery.KinSlideshow-1.1.js'); ?>"></script>
   <link rel="shortcut icon" type="image/x-icon" href="<?php echo XHtml::imageUrl('favicon.ico'); ?>" />
    <title></title>
</head>
<body>
<div id="container">

    <header id="header">
      	<div class="logo left"><a href="/"><img src="<?php echo XHtml::imageUrl('logo.jpg'); ?>" /></a></div>
    	<div class="tel left"><img src="<?php echo XHtml::imageUrl('tel.jpg'); ?>" width='228' height='28' /></div>
      	<div class="top-right right">
            <div class="top-text"><ul><li><a href="javascript:void(0)" onclick="SetHome(this, 'http://www.phemu.com/')">设为首页</a></li><li>|</li><li><a href="javascript:void(0);" onclick="addBookmark('http://www.phemu.com/','{%$lngpack.sitename%}');" >加入收藏</a></li><li>|</li><li><script type="text/javascript" src="{%$rootdir%}index.php?ac=scriptout&at=member"></script></li>
            <li>|</li><li style="padding-right:0;"><a href="{%find:type class=56 out=link%}">联系我们</a></li>
            </ul></div>
			<div class="search right">
            
	<form name="infosearch" method="post" action="{%$link%}">
	<input type="hidden" name="lng" value="{%$lng%}">
	<input type="hidden" name="mid" value="{%$mid%}">
    <span class="right"><input class="search-button" type="submit" style="border:0; cursor:pointer;" value="" name="Submit" /></span>
	<input id="keyword" name="keyword" type="text"    style="width:170px; height:20px; line-height:20px;vertical-align:middle; color:#666; border: none; background:none;  padding-left:5px; padding-top:2px;"value="请输入要搜索的信息" onfocus="if(this.value=='请输入要搜索的信息'){this.value='';this.style.color='#666'}" onblur="if(this.value==''){this.value='请输入要搜索的信息';this.style.color='#666'} "/>
	</form>
	</div>
      </div>
	
	<!-- /#header-logo -->
    </header><!-- /#header -->

    <div id="main">
        <?php $this->widget('ptl.MainMenu'); ?>
        <hr>
        <?php echo $content; ?>
    </div><!-- /#main -->

    <footer id="footer">
        &copy;
    </footer><!-- /#footer -->

</div><!-- /#container -->
</body>
</html>

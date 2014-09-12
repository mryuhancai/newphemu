var ddaccordion={
    ajaxloadingmsg: '<img src="loading2.gif" /><br />Loading Content...', //当在手风琴展开的时候，如果内容ajax请求的结果，在结果返回之前，应该在内容区显示的东东。
 
    headergroup: {}, //用来存储标题对象
    contentgroup: {}, //用来存储内容对象
 
    //提供一个方法，该方法可以用来加载图片。
    preloadimages:function($images){
        $images.each(function(){
            var preloadimage=new Image()
            preloadimage.src=this.src
        })
    },
 
    //公共方法，用来展开一个内容区。
    expandone:function(headerclass, selected, scrolltoheader){
        this.toggleone(headerclass, selected, "expand", scrolltoheader)
    },
 
    //公共方法，用来闭合一个内容区。
    collapseone:function(headerclass, selected){
        this.toggleone(headerclass, selected, "collapse")
    },
 
    //公共方法，用来展开所有的内容区。
    expandall:function(headerclass){
        var $headers=this.headergroup[headerclass]
        this.contentgroup[headerclass].filter(':hidden').each(function(){//找到所有的未展开的标题元素，然后程序触发他们的手风琴事件。
            $headers.eq(parseInt($(this).attr('contentindex'))).trigger("evt_accordion")
        })
    },
 
    //公共方法，用来闭合所有的内容区。
    collapseall:function(headerclass){
        var $headers=this.headergroup[headerclass]
        this.contentgroup[headerclass].filter(':visible').each(function(){//找到所有未闭合的内容元素，然后根据内容元素的索引找到它对应的标题元素，然后触发手风琴事件。
            $headers.eq(parseInt($(this).attr('contentindex'))).trigger("evt_accordion")
        })
    },
 
    //公共方法，转换一个内容区的状态，如果打开着就关闭它，如果关闭着就打开它。
    toggleone:function(headerclass, selected, optstate, scrolltoheader){
        var $targetHeader=this.headergroup[headerclass].eq(selected)
        var $subcontent=this.contentgroup[headerclass].eq(selected)
        if (typeof optstate=="undefined" || optstate=="expand" && $subcontent.is(":hidden") || optstate=="collapse" && $subcontent.is(":visible"))
            $targetHeader.trigger("evt_accordion", [false, scrolltoheader])
    },
 
    //通过ajax动态加载内容区。
    ajaxloadcontent:function($targetHeader, $targetContent, config, callback){
        var ajaxinfo=$targetHeader.data('ajaxinfo')//获取该标题对应的ajaxinfo，该信息会在init方法中初始化。
 
        //一个内部私有方法，用来处理ajax的返回结果，并且维护内容加载的状态。
        function handlecontent(content){
            if (content){ //如果已经动态加载到内容区
                ajaxinfo.cacheddata=content //把内容存储到标题对应的ajaxinfo中。
                ajaxinfo.status="cached" //设置ajaxinfo的状态为已存储。
                if ($targetContent.queue("fx").length==0){ //判断与该标题相对应的内容区是不是还有事件要处理（有可能在执行动画），如果没有，就进入if。
                    $targetContent.hide().html(content) //隐藏Loading动画，将内容区的内容设置为刚刚加载来的content。
                    ajaxinfo.status="complete" //设置ajaxinfo的状态为已完成。
                    callback() //执行传入该方法的回调函数。
                }
            }
            if (ajaxinfo.status!="complete"){ //如果动态加载还没有完成
                setTimeout(function(){handlecontent(ajaxinfo.cacheddata)}, 100) //每0.1秒嵌套调用一次自己，用来等待动画的执行。
            }
        }
 
        if (ajaxinfo.status=="none"){ //如果ajaxinfo的信息还是初始化时候的状态，即该内容区还没有加载过。
            $targetContent.html(this.ajaxloadingmsg) //把加载动画暂时设置为内容区的内容。
            $targetContent.slideDown(config.animatespeed) //将加载动画按照用户配置的速度滑动下来。
            ajaxinfo.status="loading" //设置ajaxinfo的状态为正在加载。
            $.ajax({
                url: ajaxinfo.url, //传入ajax请求的url
                error:function(ajaxrequest){ //如果失败，将内容区的内容设置为'Error fetching content. Server Response: '+ajaxrequest.responseText
                    handlecontent('Error fetching content. Server Response: '+ajaxrequest.responseText)
                },
                success:function(content){ //如果成功，将内容区的内容设置为返回的content
                    content=(content=="")? " " : content //在成功的情况下也有可能content是空，而是否已经加载到内容是判断 if (content)，所以这里将他改为" "。
                    handlecontent(content)
                }
            })
        }
        else if (ajaxinfo.status=="loading") //如果该内容区正在加载
            handlecontent(ajaxinfo.cacheddata) //处理ajaxinfo.cacheddata，个人认为这里有bug，应该改为return。因为loading状态表明之前已经出发加载事件了只是结果还没返回来，所以在返回之前应该屏蔽掉再次加载的事件。这里直接用上一次的缓存结果来处理分两种情况：如果上一次缓存结果为空，那么它将一直在handlecontent的循环中，直到ajax请求的结果返回才会进入回调函数，而本身请求处理完之后会调用回调，所有回调会被调用两次；如果上一次缓存结果不为空，那么相当于把内容区先设置为上一次的内容，直到ajax返回结果回来，内容才被更新到最新，回调函数依旧被调用了两次。
    },
 
    expandit:function($targetHeader, $targetContent, config, useractivated, directclick, skipanimation, scrolltoheader){
        var ajaxinfo=$targetHeader.data('ajaxinfo') //获取该标题对应的ajaxinfo
        if (ajaxinfo){ //如果该标题的ajaxinfo不为空，即该内容区应该通过ajax加载。
            if (ajaxinfo.status=="none" || ajaxinfo.status=="loading") //如果内容区的内容还没有得到就动态加载它
                this.ajaxloadcontent($targetHeader, $targetContent, config, function(){ddaccordion.expandit($targetHeader, $targetContent, config, useractivated, directclick)})
            else if (ajaxinfo.status=="cached"){ //如果动态加载的内容已经得到了但是还没跟新到内容区，就把它更新到内容区并且将缓存清空。
                $targetContent.html(ajaxinfo.cacheddata)
                ajaxinfo.cacheddata=null
                ajaxinfo.status="complete"
            }
        }
        this.transformHeader($targetHeader, config, "expand") //执行标题的展开动画
        $targetContent.slideDown(skipanimation? 0 : config.animatespeed, function(){//根据用户的设置，将内容区滑下，完成之后执行用户注入的onopenclose方法。
            config.onopenclose($targetHeader.get(0), parseInt($targetHeader.attr('headerindex')), $targetContent.css('display'), useractivated)
            if (scrolltoheader){//如果加载完之后要滚动到被展开的标题处
                var sthdelay=(config["collapseprev"])? 20 : 0 //如果用户设置展开一个的时候要把其他的先关闭，就设置延迟为20ms，否则立即执行。
                clearTimeout(config.sthtimer)
                config.sthtimer=setTimeout(function(){ddaccordion.scrollToHeader($targetHeader)}, sthdelay) //滚动到该标题。
            }
            if (config.postreveal=="gotourl" && directclick){ //如果绑定额事件名叫做gotourl并且是click事件触发的
                var targetLink=($targetHeader.is("a"))? $targetHeader.get(0) : $targetHeader.find('a:eq(0)').get(0)//找到该标题中的链接的地址。
                if (targetLink) //如果找到一个链接,就把当前页面定位到链接页面。
                    setTimeout(function(){location=targetLink.href}, 200 + (scrolltoheader? 400+sthdelay : 0) )
            }
        })
    },
 
    //一个实现将页面滚动到指定元素处的方法。
    scrollToHeader:function($targetHeader){
        ddaccordion.$docbody.stop().animate({scrollTop: $targetHeader.offset().top}, 400)
    },
 
    //闭合一个内容区
    collapseit:function($targetHeader, $targetContent, config, isuseractivated){
        this.transformHeader($targetHeader, config, "collapse") //执行标题的闭合动画
        $targetContent.slideUp(config.animatespeed, function(){config.onopenclose($targetHeader.get(0), parseInt($targetHeader.attr('headerindex')), $targetContent.css('display'), isuseractivated)})//将内容区划上去，完成之后调用用户嵌入的onopenclose方法。
    },
 
    //标题在打开或者闭合的时候执行的动画
    transformHeader:function($targetHeader, config, state){
        $targetHeader.addClass((state=="expand")? config.cssclass.expand : config.cssclass.collapse)
        .removeClass((state=="expand")? config.cssclass.collapse : config.cssclass.expand)//将标题的css设置为对应状态的css。
        if (config.htmlsetting.location=='src'){ //如果location是src
            $targetHeader=($targetHeader.is("img"))? $targetHeader : $targetHeader.find('img').eq(0) //将标题中找到的图片资源换成配置中的资源。
            $targetHeader.attr('src', (state=="expand")? config.htmlsetting.expand : config.htmlsetting.collapse)
        }
        else if (config.htmlsetting.location=="prefix") //如果是prefix或者suffix，就把配置文件中的内容添加到指定位置。
            $targetHeader.find('.accordprefix').empty().append((state=="expand")? config.htmlsetting.expand : config.htmlsetting.collapse)
        else if (config.htmlsetting.location=="suffix")
            $targetHeader.find('.accordsuffix').empty().append((state=="expand")? config.htmlsetting.expand : config.htmlsetting.collapse)
    },
 
    //找到url中要打开的header的索引。
    urlparamselect:function(headerclass){
        var result=window.location.search.match(new RegExp(headerclass+"=((\\d+)(,(\\d+))*)", "i")) //check for "?headerclass=2,3,4" in URL
        if (result!=null)
            result=RegExp.$1.split(',')
        return result
    },
 
    //获取Cookie
    getCookie:function(Name){
        var re=new RegExp(Name+"=[^;]+", "i")
        if (document.cookie.match(re))
            return document.cookie.match(re)[0].split("=")[1]
        return null
    },
 
    //设置Cookie
    setCookie:function(name, value){
        document.cookie = name + "=" + value + "; path=/"
    },
 
    //初始化方法
    init:function(config){
    //隐藏所有的标记要动态加载内容区的a标签
    document.write('<style type="text/css">\n')
    document.write('.'+config.contentclass+'{display: none}\n') //generate CSS to hide contents
    document.write('a.hiddenajaxlink{display: none}\n') //CSS class to hide ajax link
    document.write('<\/style>')
     
    jQuery(document).ready(function($){
        var persistedheaders=ddaccordion.getCookie(config.headerclass)
        ddaccordion.headergroup[config.headerclass]=$('.'+config.headerclass) //存入headers对象
        ddaccordion.contentgroup[config.headerclass]=$('.'+config.contentclass) //存入contents对象
        ddaccordion.$docbody=(window.opera)? (document.compatMode=="CSS1Compat"? jQuery('html') : jQuery('body')) : jQuery('html,body') //得到一个$docbody对象，在scrollTo方法中要用到。
        var $headers=ddaccordion.headergroup[config.headerclass] //创建headers变量
        var $subcontents=ddaccordion.contentgroup[config.headerclass] //创建contents变量
        config.cssclass={collapse: config.toggleclass[0], expand: config.toggleclass[1]} //存储开合状态下标题的css
        config.revealtype=config.revealtype || "click" //存储触发开合事件的时间类型，默认为click
        config.revealtype=config.revealtype.replace(/mouseover/i, "mouseenter") //如果事件类型为mouseover，就把它改为mouseenter
        if (config.revealtype=="clickgo"){ //如果用户传入的事件类型是clickgo，那么将事件类型改为click，并且设置postreveal为gotourl，在展开的时候会用到该标记。
            config.postreveal="gotourl"
            config.revealtype="click"
        }
         
        //设置标题在开合时候的html信息
        if (typeof config.togglehtml=="undefined")
            config.htmlsetting={location: "none"}
        else
            config.htmlsetting={location: config.togglehtml[0], collapse: config.togglehtml[1], expand: config.togglehtml[2]}
             
        config.oninit=(typeof config.oninit=="undefined")? function(){} : config.oninit //嵌入oninit方法
        config.onopenclose=(typeof config.onopenclose=="undefined")? function(){} : config.onopenclose //嵌入onopenclose方法
        var lastexpanded={} //初始化上次打开的headers索引
        var expandedindices=ddaccordion.urlparamselect(config.headerclass) || ((config.persiststate && persistedheaders!=null)? persistedheaders : config.defaultexpanded)//优先使用url中的heads索引，其次是历史记录里的，最后用default。
        if (typeof expandedindices=='string')
            expandedindices=expandedindices.replace(/c/ig, '').split(',') //处理url传入的特殊参数，有可能不是数字，而是c1,c2,c3
        if (expandedindices.length==1 && expandedindices[0]=="-1") //如果索引只有一个并且是-1，那所有的head都关闭。
            expandedindices=[]
        if (config["collapseprev"] && expandedindices.length>1) //如果最多只允许一个内容区是打开的，并且expandedindices的header索引不止一个，就用最后一个索引。
            expandedindices=[expandedindices.pop()]
        if (config["onemustopen"] && expandedindices.length==0) //如果最多只允许一个内容区是打开的，并且expandedindices的header索引没有，就默认打开第一个。
            expandedindices=[0]
         
        //把需要打开的内容区全部打开
        $headers.each(function(index){
            var $header=$(this)
            //处理header
            if (/(prefix)|(suffix)/i.test(config.htmlsetting.location) && $header.html()!=""){ //add a SPAN element to header depending on user setting and if header is a container tag
                $('<span class="accordprefix"></span>').prependTo(this)
                $('<span class="accordsuffix"></span>').appendTo(this)
            }
             
            $header.attr('headerindex', index+'h') //给元素添加索引属性
            $subcontents.eq(index).attr('contentindex', index+'c') //给元素添加索引属性
            var $subcontent=$subcontents.eq(index)
            var $hiddenajaxlink=$subcontent.find('a.hiddenajaxlink:eq(0)') //检查subcontent中是否有hiddenajaxlink，如果有，认为该内容区应该显示ajax请求的内容，创建一个ajaxinfo，绑定到header上。
            if ($hiddenajaxlink.length==1){
                $header.data('ajaxinfo', {url:$hiddenajaxlink.attr('href'), cacheddata:null, status:'none'})
            }
             
            var needle=(typeof expandedindices[0]=="number")? index : index+''//检查指针索引的数据格式，将needle也设置为该格式。
             
            //打开应该展开的，闭合应该闭合的。
            if (jQuery.inArray(needle, expandedindices)!=-1){
                ddaccordion.expandit($header, $subcontent, config, false, false, !config.animatedefault)
                lastexpanded={$header:$header, $content:$subcontent}
            }
            else{
                $subcontent.hide()
                config.onopenclose($header.get(0), parseInt($header.attr('headerindex')), $subcontent.css('display'), false)
                ddaccordion.transformHeader($header, config, "collapse")
            }
        })
         
        //绑定evt_accordion事件
        $headers.bind("evt_accordion", function(e, isdirectclick, scrolltoheader){
                var $subcontent=$subcontents.eq(parseInt($(this).attr('headerindex')))
                if ($subcontent.css('display')=="none"){
                    ddaccordion.expandit($(this), $subcontent, config, true, isdirectclick, false, scrolltoheader)
                    if (config["collapseprev"] && lastexpanded.$header && $(this).get(0)!=lastexpanded.$header.get(0)){
                        ddaccordion.collapseit(lastexpanded.$header, lastexpanded.$content, config, true)
                    }
                    lastexpanded={$header:$(this), $content:$subcontent}
                }
                else if (!config["onemustopen"] || config["onemustopen"] && lastexpanded.$header && $(this).get(0)!=lastexpanded.$header.get(0)){
                    ddaccordion.collapseit($(this), $subcontent, config, true)
                }
        })
         
        //绑定用户配置的事件，如果是mouseenter，就在用户配置的延时之后执行手风琴动画，否则触发evt_accordion事件。
        $headers.bind(config.revealtype, function(){
            if (config.revealtype=="mouseenter"){
                clearTimeout(config.revealdelay)
                var headerindex=parseInt($(this).attr("headerindex"))
                config.revealdelay=setTimeout(function(){ddaccordion.expandone(config["headerclass"], headerindex, config.scrolltoheader)}, config.mouseoverdelay || 0)
            }
            else{
                $(this).trigger("evt_accordion", [true, config.scrolltoheader])
                return false
            }
        })
         
        //如果用户的mouseleave了，就清除即将要运行的手风琴动画
        $headers.bind("mouseleave", function(){
            clearTimeout(config.revealdelay)
        })
         
        //执行oninit方法
        config.oninit($headers.get(), expandedindices)
         
        //页面在退出时候记录下用户离开前打开的headers
        $(window).bind('unload', function(){
            $headers.unbind()
            var expandedindices=[]
            $subcontents.filter(':visible').each(function(index){
                expandedindices.push($(this).attr('contentindex'))
            })
            if (config.persiststate==true && $headers.length>0){
                expandedindices=(expandedindices.length==0)? '-1c' : expandedindices
                ddaccordion.setCookie(config.headerclass, expandedindices)
            }
        })
    })
    }
}
 
//把默认配置的loading动画需要的图片加载到客户端
ddaccordion.preloadimages(jQuery(ddaccordion.ajaxloadingmsg).filter('img'))
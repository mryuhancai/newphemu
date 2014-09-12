var xlid=0;
function getPos(el,sProp) { 
    var iPos = 0;
    while (el!=null) {
        iPos+=el["offset" + sProp];
        el = el.offsetParent;
    }
    return iPos;
}
function xsxl(me,top,left){
	eval(me).style.top=top+"px";
	eval(me).style.left=left+"px";
	eval(me).style.display='';
}

var fdiv=false;
var zInd=1
function  fddivgdzx(){fdiv=false;}
function fddivgd(fddiv){
 fdiv=true;
 var prox;
 var proy;
 var proxc;
 var proyc;
 /*-------------------------鼠标拖动---------------------*/ 
 var od = document.getElementById(fddiv); 
 var dx,dy,mx,my,mouseD;
 var odrag;
 var isIE = document.all ? true : false;
 document.onmousedown = function(e){
  var e = e ? e : event;
  if(e.button == (document.all ? 1 : 0)){
   mouseD = true;   
  }
 }
 document.onmouseup = function(){
  mouseD = false;
  odrag = "";
  if(isIE){
  od.releaseCapture();
   od.filters.alpha.opacity = 100;
  }else{
   window.releaseEvents(od.MOUSEMOVE);
   od.style.opacity = 1;
  
  }  
 }
 od.onmousedown = function(e){
 if(fdiv==true){//不在村题时不可以移动
  zInd=zInd+1;
 od.style.zIndex = zInd;
 
  odrag = this;
  var e = e ? e : event;
  if(e.button == (document.all ? 1 : 0))
  {
   mx = e.clientX;
   my = e.clientY;
   od.style.left = od.offsetLeft + "px";
   od.style.top = od.offsetTop + "px";
   if(isIE){od.setCapture();
    od.filters.alpha.opacity = 80; }
   else
   {window.captureEvents(Event.MOUSEMOVE);
    od.style.opacity = 0.8;}
	}
  } 
 }
 document.onmousemove = function(e){
  var e = e ? e : event;
  if(mouseD==true  &&  odrag){  
   var mrx = e.clientX - mx;
   var mry = e.clientY - my; 
   od.style.left = parseInt(od.style.left) +mrx + "px";
   od.style.top = parseInt(od.style.top) + mry + "px";   
   mx = e.clientX;
   my = e.clientY;
  }
 }
 }
 
var xmlhttp;
var tturl;
var xsid;
var xslr;
var sxcs;
var sfzx;
var sfzxb;
  function createXMLHttpRequest(){if(window.ActiveXObject){xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");}else if(window.XMLHttpRequest){xmlhttp = new XMLHttpRequest();} }
 function startRequest(tturl,xsdf){
      sxcs=0;
        xslr="<img src=../Ima_itxdl/admin_images/indicator.gif>.更新中......";
	    xsid=eval(xsdf);
		 xsid.innerHTML=xslr;
		   createXMLHttpRequest();
            xmlhttp.onreadystatechange = handleStateChange;
            xmlhttp.open("post",tturl,true);
			xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            xmlhttp.send(tturl);
			 xsid.innerHTML=xslr;
			gxzb()
       }
       function handleStateChange(){
            if(xmlhttp.readyState == 4){
                if(xmlhttp.status == 200){
                 xslr= xmlhttp.responseText;
                }
            }
       }
	     function gxzb(){
	   sxcs=sxcs+1;
	   if (xslr=="<img src=../Ima_itxdl/admin_images/indicator.gif>.更新中......"){ setTimeout('gxzb()', 100); }else{ xsid.innerHTML=xslr;}
	   }
	   ////////////
	   lastScrollY = 0;
function heartBeat(){
var diffY;
if (document.documentElement && document.documentElement.scrollTop)
diffY = document.documentElement.scrollTop;
else if (document.body)
diffY = document.body.scrollTop
else
{}
percent=.1*(diffY-lastScrollY);
if(percent>0)percent=Math.ceil(percent);
else percent=Math.floor(percent);
document.getElementById("rightDiv").style.top = parseInt(document.getElementById("rightDiv").style.top)+percent+"px";
	 if(document.getElementById("leftdh")){
				if(parseInt(document.getElementById("rightDiv").style.top)>580){
					if(parseInt(document.getElementById("rightDiv").style.top)<(document.body.scrollHeight-320)){
								if((parseInt(document.getElementById("rightDiv").style.top) + percent-620)>0){
								document.getElementById("leftdh").style.top= parseInt(document.getElementById("rightDiv").style.top) + percent-620+"px";}
					}
				}else{
					document.getElementById("leftdh").style.top="0px"
				}
	 }
lastScrollY=lastScrollY+percent;}
window.setInterval("heartBeat()",1);
function close_right1(){rightDiv.style.visibility='hidden';}
document.write('<div id="rightDiv" style="top:470px;right:10px;background:none;width:151px;height:263px;position:absolute; display:none">')
document.write('</div>')

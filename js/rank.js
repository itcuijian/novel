window.onload=function(){
	//导航加深颜色
	(function(){
		var a = $(".a").children("li").children("a");
		for(var i=0;i<a.length;i++){
			if(String(window.location).indexOf(a[i].href) > -1){
				$("#a").children("a").attr("class", "");
				a[i].className = "active";
			}
		}
	})();
	
}
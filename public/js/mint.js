$(document).ready(function(){

	let $urlfield,
		$add_data,$loader,$add_data_f;
		$urlfield=_("#url_field");
		$add_data=_("#share");
        $add_data_f=_("#plus");
        $loader = _(".loader");

    _click($add_data, function() {
    	let url = $("#url_field").val();
    	if(url == '') { $("#url_field").css("border-color", "RED"); } else {

    	_hide($add_data_f);
        _show($loader);

        let verifyUrl = getDomain(url);
        	if(isValidURL(url)){ 
        		if(verifyUrl.match(/steemit.com/g)) { 
        		alert('steem url not allowed'); } else{ _fetch("http://localhost:8000/helper/new.html",url); return; }
        	}
    	}
    });    

	function _fetch(apiUrl,webUrl) {
        $.post(apiUrl,{url:webUrl},function(response){
            console.log(response);
            _hide($loader);
            let res = JSON.parse(response);
            window.location.replace("editDetails.php?url="+encodeURIComponent(res.url)+"&title="+encodeURIComponent(res.title)+"&imgUrl="+encodeURIComponent(res.imgUrl)+"&details="+encodeURIComponent(res.des));
            console.log("Response array: "+res.url);

        });
    }
	function isValidURL(url){
        var RegExp = /(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
        if(RegExp.test(url)) {
            return true;
        } else {
            return false;
        }
    }
    function _click(se,callback) {
        _(se).click(function (e) {
            callback(e);
        });
    }
    function _show(e) {
        e.css('display','block');
    }
    function _hide(e) {
        e.css('display','none');
    }
    function _(e) {
        return $(e);
    }
	function getDomain(url) {
        let hostName = getHostName(url);
        let domain = hostName;

        if (hostName != null) {
            let parts = hostName.split('.').reverse();
            if (parts != null && parts.length > 1) {
                domain = parts[1] + '.' + parts[0];
                if (hostName.toLowerCase().indexOf('.co.uk') != -1 && parts.length > 2) {
                    domain = parts[2] + '.' + domain;
                }
            }
        }
        return domain;
    }
    function getHostName(url) {
        var match = url.match(/:\/\/(www[0-9]?\.)?(.[^/:]+)/i);
        if (match != null && match.length > 2 && typeof match[2] === 'string' && match[2].length > 0) {
            return match[2];
        }
        else {
            return null;
        }
    }

});
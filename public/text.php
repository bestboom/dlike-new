<?php
include('template/header5.php');
?>
</div>
<center>
<form action="">
    <textarea name="data" style="width: 60%;margin-top: 100px; height: 300px;" id="mycontent"></textarea>
    <br>
    <button class="btn btn-success" type="submit" id="checkButton">check</button>
</form>
</center>
<div id="resultList"></div>
<div id="words-count"></div>
<div id="percent"></div>

<?
$para = $_GET['data'];
echo '<br>';
$check_data = stripslashes(Trim($para));

  
$item_purchase_code = 'nulled-by-amacode';
$mydomain= 'dlike.io';
        $url = 'http://googleapi.prothemes.biz/api.php?data='.urlencode($check_data).'&domain='.$mydomain.'&code='.$item_purchase_code;
        $palData = getMyData($url);
        echo $palData;
function getMyData($site){
    return file_get_contents($site);
}
/*
$search_keyword = str_replace("�", "'", $check_data);
$search_keyword = '"'.$search_keyword.'"';

$googleDomains = array('google.com', 'google.ad', 'google.ae', 'google.com.af', 'google.com.ag', 'google.com.ai', 'google.al', 'google.am', 'google.co.ao', 'google.com.ar', 'google.as', 'google.at', 'google.com.au', 'google.az', 'google.ba', 'google.com.bd', 'google.be', 'google.bf', 'google.bg', 'google.com.bh', 'google.bi', 'google.bj', 'google.com.bn', 'google.com.bo', 'google.com.br', 'google.bs', 'google.bt', 'google.co.bw', 'google.by', 'google.com.bz', 'google.ca', 'google.cd', 'google.cf', 'google.cg', 'google.ch', 'google.ci', 'google.co.ck', 'google.cl', 'google.cm', 'google.cn', 'google.com.co', 'google.co.cr', 'google.com.cu', 'google.cv', 'google.com.cy', 'google.cz', 'google.de', 'google.dj', 'google.dk', 'google.dm', 'google.com.do', 'google.dz', 'google.com.ec', 'google.ee', 'google.com.eg', 'google.es', 'google.com.et', 'google.fi', 'google.com.fj', 'google.fm', 'google.fr', 'google.ga', 'google.ge', 'google.gg', 'google.com.gh', 'google.com.gi', 'google.gl', 'google.gm', 'google.gp', 'google.gr', 'google.com.gt', 'google.gy', 'google.com.hk', 'google.hn', 'google.hr', 'google.ht', 'google.hu', 'google.co.id', 'google.ie', 'google.co.il', 'google.im', 'google.co.in', 'google.iq', 'google.is', 'google.it', 'google.je', 'google.com.jm', 'google.jo', 'google.co.jp', 'google.co.ke', 'google.com.kh', 'google.ki', 'google.kg', 'google.co.kr', 'google.com.kw', 'google.kz', 'google.la', 'google.com.lb', 'google.li', 'google.lk', 'google.co.ls', 'google.lt', 'google.lu', 'google.lv', 'google.com.ly', 'google.co.ma', 'google.md', 'google.me', 'google.mg', 'google.mk', 'google.ml', 'google.com.mm', 'google.mn', 'google.ms', 'google.com.mt', 'google.mu', 'google.mv', 'google.mw', 'google.com.mx', 'google.com.my', 'google.co.mz', 'google.com.na', 'google.com.nf', 'google.com.ng', 'google.com.ni', 'google.ne', 'google.nl', 'google.no', 'google.com.np', 'google.nr', 'google.nu', 'google.co.nz', 'google.com.om', 'google.com.pa', 'google.com.pe', 'google.com.pg', 'google.com.ph', 'google.com.pk', 'google.pl', 'google.pn', 'google.com.pr', 'google.ps', 'google.pt', 'google.com.py', 'google.com.qa', 'google.ro', 'google.ru', 'google.rw', 'google.com.sa', 'google.com.sb', 'google.sc', 'google.se', 'google.com.sg', 'google.sh', 'google.si', 'google.sk', 'google.com.sl', 'google.sn', 'google.so', 'google.sm', 'google.sr', 'google.st', 'google.com.sv', 'google.td', 'google.tg', 'google.co.th', 'google.com.tj', 'google.tk', 'google.tl', 'google.tm', 'google.tn', 'google.to', 'google.com.tr', 'google.tt', 'google.com.tw', 'google.co.tz', 'google.com.ua', 'google.co.ug', 'google.co.uk', 'google.com.uy', 'google.co.uz', 'google.com.vc', 'google.co.ve', 'google.vg', 'google.co.vi', 'google.com.vn', 'google.vu', 'google.ws', 'google.rs', 'google.co.za', 'google.co.zm', 'google.co.zw', 'google.cat');

$random_domain =array_rand($googleDomains,1);
$googleDomain = $googleDomains[$random_domain];
echo '<br>';     
echo $googleUrl = 'https://www.' . $googleDomain . '/search?hl=en&q=' . urlencode($search_keyword);
echo '<br>';


 $pageData = curlGET_Text($googleUrl);
 var_dump($pageData);
echo '<br>';    
    if(str_contains($pageData,'No results found for')){
            //No Match Found
        die('content is unique');
    }else{
            //Matched
        die('duplicate');   
    }


function curlGET($url,$ref_url = "http://www.google.com/",$agent = "Mozilla/5.0 (Windows NT 6.3; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0"){
    $cookie = TMP_DIR.unqFile(TMP_DIR, randomPassword().'_curl.tdata');
	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_MAXREDIRS, 100);
	curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/html; charset=utf-8","Accept: *"));
    curl_setopt($ch, CURLOPT_VERBOSE, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
	curl_setopt($ch, CURLOPT_REFERER, $ref_url);
	$html=curl_exec($ch);
    curl_close($ch);
    return $html;
}



function newod( $url )
    {
        $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';

        $options = array(

            CURLOPT_CUSTOMREQUEST  =>"GET",        //set request type post or get
            CURLOPT_POST           =>false,        //set to GET
            CURLOPT_USERAGENT      => $user_agent, //set user agent
            CURLOPT_COOKIEFILE     =>"cookie.txt", //set cookie file
            CURLOPT_COOKIEJAR      =>"cookie.txt", //set cookie jar
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        return $header;
    }


*/
include('template/footer.php');
?>    

<script type="text/javascript">
	
/*
 * @author Balaji
 * @name: A to Z SEO Tools v2 - PHP Script
 * @copyright © 2017 ProThemes.Biz
 *
 */
 
//Plagiarism Checker

$("#mycontent").focus(function (){
    countMyWords()
    });
$("#mycontent").keypress(function (){
    countMyWords()
    });
$("#mycontent").blur(function (){
    countMyWords(); 
    });
$("#mycontent").click(function (){
    countMyWords()
    });

function phraseMe(str,myData){
var charData=str.charAt(myData);
var strData=myData;
var count=0;
while(strData>=0&&count<minLimit) {
    if(str.charAt(strData)==' '&&count>12)
    break;
    strData--;charData=str.charAt(strData)+charData;
    count++;
}

var strData=myData;
var count=0;
while(strData<str.length&&count<60){
    if(str.charAt(strData)==' '&&count>40)
    break;
    strData++;
    charData+=str.charAt(strData);count++}
    return charData;
}

function parseArticle(content) {
    var _return=new Array();
    var arrParagrap=content.split('\n');
    for(i=0;i<arrParagrap.length;i++)
    {
        var currentString=arrParagrap[i];
        if((currentString.indexOf('.')==-1&&currentString.indexOf(',')==-1)||(currentString.indexOf('.')==currentString.length-1||currentString.indexOf(',')==currentString.length-1))
        {
            if(currentString.length>=40)
            {
                var st='';var count=0;while(count<60)
                {
                    if(currentString.charAt(count)==' '&&count>45)break;st+=currentString.charAt(count);count++}_return.push(st)
                    }
                    }
                    else
                    {
                        var currentPosition=0;
                        for(j=0;j<currentString.length;j++)
                        {
                            if(currentString.charAt(j)=='.'||currentString.charAt(j)==','||currentString.charAt(j)=='?')
                            {
                                if(j<currentString.length-5&&j-minLimit>currentPosition){currentPosition=j;_return.push(phraseMe(currentString,j))
                                }
                                }
                                }
                                }
                                }
            return _return;
        }

var arrSegment=new Array();
var currentCheck=0;
var checkOK=0;
var authCode, myContent, myTextData;

function startTask(auth){
    authCode = auth;
    var countMe = 0;
    jQuery("#mainbox").fadeOut();
 	jQuery(".percentimg").css({"display":"block"});
 	jQuery(".percentimg").show();
 	jQuery(".percentimg").fadeIn();
	jQuery("#resultList").append('<thead><th>#</th><th>'+stringStr+'</th><th>'+uniqueStr+'</th></thead><tbody></tbody>');
	arrSegment=parseArticle(myContent);
	noOfLines=arrSegment.length;
    checkMe(noOfLines,arrSegment,countMe);
}

jQuery(document).ready(function(){

    myTextData=jQuery("#mycontent").val();
	myTextData=jQuery.trim(myTextData);

    if(myTextData=="")
	   jQuery("#mycontent").val(placeHolderText);
       
	jQuery("#mycontent").focus(function(){

    if(jQuery(this).val()==placeHolderText){jQuery(this).val('');}});jQuery("#mycontent").blur(function(){if(jQuery(this).val()=='')jQuery(this).val(placeHolderText); countMyWords();});

    jQuery("#checkButton").click(function(){
        myContent=jQuery.trim(jQuery("#mycontent").val());
    
    	if(jQuery("#mycontent").val()== placeHolderText){
    	    sweetAlert(oopsStr, inputEm , "error");
    		return false;
    	}else if(myContent.length<minLimit){
            sweetAlert(oopsStr, articleLm.replace('[limit]',minLimit) , "error");
    		return false;
    	}else if (countMyWords() > wordsLimit){
            sweetAlert(oopsStr, wordLm.replace('[limit]',minLimit) , "error");
    		return false;
    	}else{
            validateCaptcha();
    	}
})});

function unique2Color(percent) {
    if(percent<100)
    return'#e74c3c';
    else 
    return'#2ecc71';
}

function checkMe(noOfLines,arrSegment,countMe) {
    jQuery.post(axPath,{plagiarism:'1', type:apiType, data:arrSegment[countMe], authcode:authCode},function(data){
     var loopCount = countMe+1;
     if (data == '2')
     {
        checkOK++;
   		jQuery("#resultList").append('<tr><td>'+loopCount+'</td><td class="string">'+arrSegment[countMe]+'</td><td><span class="badge bg-green"> '+goodStr+' </span></td></tr>');
     }
     else
     {
   		jQuery("#resultList").append('<tr><td>'+loopCount+'</td><td class="string">'+arrSegment[countMe]+'</td><td><span class="badge bg-red"> '+alreadyStr+' </span></td></tr>');
     }
    var checkPoint = noOfLines - 1;
    var percentUnique=Math.round((checkOK/arrSegment.length)*100);
    if ( percentUnique > 100 ) {
       percentUnique = 100;
    }
    var colorUnique=unique2Color(percentUnique);
    jQuery("#percent").html('<b style="color:'+colorUnique+'">'+percentUnique+'% '+unqStr+' </b>');
    if (countMe == checkPoint)
    {
    jQuery(".percentimg").fadeOut();    
   	jQuery(".percentimg").css({"display":"none"});
    jQuery(".percentimg").hide();
    jQuery('#tryNew').removeClass('hide');
    jQuery("#tryNew").fadeIn();
    }
    else
    {
    countMe++;
    checkMe(noOfLines,arrSegment,countMe);
    } 
    });
                
}

function countMyWords() {
    var wordsCount=0;
	var dataContent = $("#mycontent").val();
	dataContent = $.trim(dataContent);
	dataContent = dataContent.replace(/\s+/g," ");dataContent = dataContent.replace(/\n /," ");
	if(dataContent!="")
	{
		wordsCount= dataContent.split(' ').length;
	}
	$("#words-count").html(wordsCount);
	return wordsCount;
}

$(document).ready(function(){	
	$("#max_wordsLimit").html(wordsLimit);
	countMyWords();
});

</script>
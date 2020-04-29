<?
class DataGraber{
    private $title;
    private $thumbnail;
    public $imageSource;
    private $description;
    private $websiteAddress;
    private $errors = array();
    function __construct($url){
        $this->websiteAddress = $url;
        $this->readHtml();
	}
    public function checkNotSecureWeb($webAddress){
        if(preg_match("/prothomalo.com|prothom-alo.com/i",$webAddress)):
            return true;
        else:
            return false;
        endif;
    }
    private function isTwitter(){
        return preg_match("/twitter.com/i", $this->websiteAddress);
    }
    private function isInstagram(){
        return preg_match("/instagram.com/i", $this->websiteAddress);
    }
    private function isYouTube(){
        return preg_match("/youtube.com|youtu.be/i", $this->websiteAddress);
    }
    private function isSoundcloud(){
        return preg_match("/soundcloud.com/i", $this->websiteAddress);
    }
    public function getTitle(){
        if($this->isYouTube()){
            return "";
        }else{
            return $this->title;
        }
    }
    public function getThumbnail(){
        # code...
        if($this->isTwitter()):
            /*$tags = get_meta_tags($this->websiteAddress);
            return "http:".$tags["msapplication-tileimage"];*/
            $html = $this->_curl($this->websiteAddress);
            preg_match('/og:image"\s*content="([^"]+)"/',$html,$imgSrc);
            $thumbnail = $imgSrc[1];
            return $thumbnail;

        elseif($this->isInstagram()):
            unset($this->thumbnail);
            $html = $this->_curl($this->websiteAddress);
            preg_match('/og:image"\s*content="([^"]+)"/',$html,$imgSrc);
            $thumbnail = $imgSrc[1];
            return $thumbnail;
        elseif($this->isYouTube()):
            $thumbnail = 'https://img.youtube.com/vi/sdfsfd/maxresdefault.jpg';

            $url = parse_url($this->websiteAddress);
            if($url['query']){
                $variables = explode('&',$url['query']);
                foreach ($variables as $vars){
                    $var = explode('=',$vars);
                    if(count($var) > 1 && $var[0] == 'v'){
                        $thumbnail = 'https://img.youtube.com/vi/'.$var[1].'/maxresdefault.jpg';
                    }
                }
            }else{
                $thumbnail = 'https://img.youtube.com/vi'.$url[path].'/maxresdefault.jpg';
            }
             return $thumbnail;

        elseif(empty($this->thumbnail)):
            unset($this->thumbnail);
            $html = $this->_curl($this->websiteAddress);
            preg_match('/og:image"\s*content="([^"]+)"/',$html,$imgSrc);
            //$thumbnail = $imgSrc[1];
			if(sizeof($imgSrc)){

            foreach($imgSrc as $thumbnail) { 
			return $thumbnail;
				}
			}else{
			$thumbnail='https://dlike.io/images/default-img.png';	
			return $thumbnail;
			}
            
        else:
            return $this->thumbnail;
        endif;

    }
    public function getDescription(){
        return $this->description;
    }
    private function readHtml(){
        $html = $this->_curl($this->websiteAddress);
        $_parse = parse_url( $this->websiteAddress );
        $_host  = $_parse['host'];

        //parsing begins here:
        $doc = new DOMDocument();
        @$doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        $nodes = $doc->getElementsByTagName('title');

        $this->title = $nodes->item(0)->nodeValue;
        $metas = $doc->getElementsByTagName('meta');

        for ($i = 0; $i < $metas->length; ++$i) {

            $meta = $metas->item($i);
            if( $meta->getAttribute('name') == 'description') {
                $this->description = $meta->getAttribute('content');

            }//<-- name

            if( empty( $this->description ) ) {
                if( $meta->getAttribute('property') == 'og:description') {
                    $this->description = $meta->getAttribute('content');

                }//<-- name
            }

            if($meta->getAttribute('property') == 'og:image') {
                if(filter_var($meta->getAttribute('content'), FILTER_VALIDATE_URL)) {
                    $this->thumbnail = $meta->getAttribute('content');
                }

            }//<-- property
        }//<-- For

        if( empty( $this->description ) ) {
            $this->description = '';
        }
        if($this->isTwitter()){
            if(empty($this->thumbnail )) {
                $tags = get_meta_tags($this->websiteAddress);
                $this->thumbnail = $tags["msapplication-tileimage"];
            }
        }
    }
    private function _curl($webUrl){
        if (!function_exists('curl_init')){
            $this->errors = 'cURL is not installed. Install and try again.';
        }
        $ch = curl_init();
        $ua = 'Mozilla/32.0.3 (X11; Linux x86_64) AppleWebKit/537.16 (KHTML, like Gecko) \ 
                Chrome/38.0.2125.104 Safari/537.16';
				$ua=$_SERVER['HTTP_USER_AGENT'];
        curl_setopt($ch, CURLOPT_USERAGENT, $ua);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_URL, $webUrl);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 5 );
        curl_setopt( $ch, CURLOPT_TIMEOUT, 300 );
        curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    public function copyImage($url,$dirlocation){
        $unique_id = md5(uniqid(rand(), true));
        $originFileName = pathinfo($url,PATHINFO_FILENAME);
        $originFileExt = pathinfo($url,PATHINFO_EXTENSION);
        $newExt = explode("?", $originFileExt);
        $newExt = $newExt[0];
        if ($newExt=="jpeg"||$newExt == "jpg"|| $newExt=="png"||$newExt=="gif"){
            $originFileName = str_replace("%","",$originFileName);
            $originFileName = str_replace(".","-",$originFileName);
            $originFileName = $originFileName.$unique_id;
            $dest = $dirlocation."/".$originFileName.'.'.$newExt;
            if (copy($url, $dest)) {
                $this->imageSource = $dest;
            }else {
                $this->errors[] = "Unable to copy remote image";
                //return false;
            }
        }else{
            $this->errors[] = "Invailid Image {$newExt} format supported format is jpg,png,jpeg,gif";
            //return false;
        }
    }
    public function getError(){
        return $this->errors;
    }



}

?>
<?php
$filename = 'helper/sitemap_urls.txt';
$urls = file($filename);
$filectime = filectime($filename);
$urls = array_map('trim',$urls);


$priority = '0.9';
$changefreq = 'daily';
$datem = date("Y-m-d\TH:i:sP");

$codtgetdata='<?xml version="1.0" encoding="iso-8859-1"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
      http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';


foreach($urls as $url) {
$codtgetdata .='<url>
<loc>'.$url.'</loc>
<lastmod>'.$datem.'</lastmod>
<changefreq>'.$changefreq.'</changefreq>
<priority>'.$priority.'</priority>
</url>';
}
$codtgetdata .='</urlset> ';

$path = "sitemap.xml";
$modo = "w+";

if ($fpen=fopen($path,$modo)){
   fwrite ($fpen,$codtgetdata);
   echo "<p><b>Sitemap successfuly created and saved to sitemap.xml!</b>";
}else{
   echo "<p><b>There has been a problem and the file has not been created.</b>";
}
?>
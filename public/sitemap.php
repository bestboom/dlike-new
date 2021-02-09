<?php
$filename = 'helper/sitemap_urls.txt';
$urls = file($filename);
$filectime = filectime($filename);
$urls = array_map('trim',$urls);
$sitemap = array();

foreach($urls as $url) {
	if ($url != '') {
		$priority = '0.9';
		$sitemap[] = array(
			'loc' => $url,
			'lastmod' => date('Y-m-d\TH:i:sP',$filectime),
			'changefreq' => 'daily',
			'priority' => $priority,
		);
	}
}
header('Content-Type: text/xml');
echo '<?xml version=\'1.0\' encoding=\'UTF-8\'?>';
echo "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
			    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
echo "\n";
foreach ($sitemap as $link) {
	echo "\t<url>\n";
	echo "\t\t<loc>" . htmlentities($link['loc']) . "</loc>\n";
	echo "\t\t<lastmod>{$link['lastmod']}</lastmod>\n";
	echo "\t\t<changefreq>{$link['changefreq']}</changefreq>\n";
	echo "\t\t<priority>{$link['priority']}</priority>\n";
	echo "\t</url>\n";
}
echo '</urlset>';
?>
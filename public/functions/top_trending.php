<div><span><i class="fa fa-home"></i>&nbsp;<a href="/">Latest</a></span><span style="padding-left: 15px;"><i class="fa fa-bolt"></i>&nbsp;<a href="/trending">Trending</a></span></div><div><a href="/steemposts">STEEM Posts</a></div></div>
<hr class="trending_hr">
<?php $posttags = $conn->query("SELECT * FROM dlike_trending_tags order by count DESC Limit 10");
if ($posttags->num_rows > 0) {while($row = $posttags->fetch_assoc()) {
    $trending_html .='<a class="nav-item nav-link" href="/tags/'.$row['tag'].'">'.strtoupper($row['tag']).'</a>';}
} else { $trending_html = '';} ?>
<div class="col-lg-12 col-md-12" style="margin-bottom: 14px">
<div class="p-0"><div class="container p-0"><div class="row"><div class="w-100 p-3" style="padding:0 !important;">
    <div class="scroller scroller-left-2 mt-2"><i class="fa fa-chevron-left"></i></div>
    <div class="scroller scroller-right-2 mt-2"><i class="fa fa-chevron-right"></i></div>
    <div class="wrapper"><nav class="nav nav-tabs list-2 mt-2" id="myTab" role="tablist">
    <a class="nav-item nav-link active" id="public-chat-tab" data-toggle="tab" href="#" role="tab" aria-controls="public" aria-expanded="true" style="font-weight:900">Trending now ></a><?php echo $trending_html;?></nav></div>
</div></div></div></div>
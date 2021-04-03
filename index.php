<?php
error_reporting(0);
$query = urlencode($_GET['query']);
$url = "https://www.amazon.in/s?k=$query";
$data = '';
$headers = array('X-Forwarded-For: '.long2ip(mt_rand()).'');
$ch1=curl_init();
curl_setopt($ch1, CURLOPT_URL,$url);
curl_setopt($ch1, CURLOPT_HEADER,0);
curl_setopt($ch1, CURLOPT_HTTPHEADER,$headers);
curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST,0);
curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($ch1, CURLOPT_FOLLOWLOCATION,0);
$amzda=curl_exec($ch1);
	// $amzda = file_get_contents("https://www.amazon.in/s?k=$query");
$count = count(explode('<div class="a-section aok-relative s-image-fixed-height">',$amzda));
$result = array();
$result['query'] = $query;
$result['search_link'] = "https://www.amazon.in/s?k=$query";
$result['total_results'] = $count - 1;
$result['results'] = array();
$c = 0;
for ($i=1; $i <$count ; $i++) { 
	$amaz = explode('<div class="a-section aok-relative s-image-fixed-height">',$amzda)[$i];
	$raja = explode('<a class="a-link-normal a-text-normal" target="_blank" href="',$amaz)[1];
	$raja = rawurldecode(explode('"',$raja)[0]);
	$product_link = explode('?',$raja)[0];
	if(count(explode('/gp/slredirect',$product_link))<2){
		$oh = explode('<span class="a-size-medium a-color-base a-text-normal"',$amaz)[1];
		$oh = explode('>', $oh)[1];
		$name = explode('</span>',$oh)[0];
		// $name = str_replace(' dir="auto">', "", $name);
		$result['results'][$c]['name'] = $name;
		$image = explode('src="',$amaz)[1];
		$image = str_replace('_AC_UY218_','_SL1000_',explode('"',$image)[0]);
		$result['results'][$c]['image'] = $image;
		$result['results'][$c]['product_link'] = 'https://www.amazon.in'.$product_link.'';
		$sale_price = explode('span class="a-offscreen">',$amaz)[1];
		$sale_price = explode('</span>',$sale_price)[0];
		$result['results'][$c]['sale_price'] = $sale_price;
		$real_price = explode('<span class="a-price a-text-price" data-a-size="b" data-a-strike="true" data-a-color="secondary"><span class="a-offscreen">',$amaz)[1];
		$real_price = explode('</span>',$real_price)[0];
		$result['results'][$c]['real_price'] = $real_price;
		$rating = explode('<span class="a-icon-alt">',$amaz)[1];
		$rating = explode('</span>',$rating)[0];
		$result['results'][$c]['rating'] = $rating;
		$c++;
	}
}
$result['product_api_link'] = 'http://'.$_SERVER['HTTP_HOST'].'/product.php?query='.$product_link.'';
$result = json_encode($result,JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
header("Content-Type: application/json");
echo $result;
	$amaz = explode('<div class="a-section aok-relative s-image-fixed-height">',$amzda)[1];
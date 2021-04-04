<?php
error_reporting(0);
$query = $_GET['query'];
$url = "https://www.amazon.in$query";
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
$base = curl_exec($ch1);

$fe = explode('<ul class="a-unordered-list a-vertical a-spacing-mini">', $base)[1];
$fe = explode('</ul>', $fe)[0];
$count = count(explode('<span class="a-list-item">', $fe));
$features = array();
$c = 0;
for ($i=1; $i <$count ; $i++) { 
	$fea = explode('<span class="a-list-item">', $fe)[$i];
	$fea = explode('</span>', $fea)[0];
	$features[$c] = str_replace(array("\n", "\r"), '', $fea);
	$c++;
}
$sale_price = explode('<span id="priceblock_ourprice" class="a-size-medium a-color-price priceBlockBuyingPriceString">', $base)[1];
echo $sale_price = explode('</span>', $sale_price)[0];

$original_price = explode('<span class="priceBlockStrikePriceString a-text-strike">', $base)[1];
$original_price = explode('</span>', $original_price)[0];
if($sale_price == ""){
	$sale_price = explode('<span id="priceblock_dealprice" class="a-size-medium a-color-price priceBlockDealPriceString">', $base)[1];
	$sale_price = explode('</span>', $sale_price)[0];

	$original_price = explode('<span class="priceBlockStrikePriceString a-text-strike">', $base)[1];
	$original_price = explode('</span>', $original_price)[0];

}
if($original_price == ""){
	$sale_price = explode('<span id="priceblock_dealprice" class="a-size-medium a-color-price priceBlockDealPriceString">', $base)[1];
	$sale_price = explode('</span>', $sale_price)[0];

	$original_price = explode('<span id="priceblock_ourprice" class="a-size-medium a-color-price priceBlockBuyingPriceString">', $base)[1];
	$original_price = explode('</span>', $original_price)[0];	
}
if($original_price == ""){
	$original_price = $sale_price;
}

$name = explode('<span id="productTitle" class="a-size-large product-title-word-break">', $base)[1];
$name = explode('</span>', $name)[0];
$name = str_replace(array("\n", "\r"), '', $name);

$image = explode('data-old-hires="', $base)[1];
$image = explode('"', $image)[0];

$product_details = array();
$product_details['name'] = $name;
$product_details['images'] = $image;
$product_details['sale_price'] = $sale_price;
$product_details['original_price'] = $original_price;
$product_details['features'] = $features;

$result = array();
$result['success'] = true;
$result['query'] = $query;
$result['product_details'] = $product_details;
$result = json_encode($result,JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
header("Content-Type: application/json");
echo $result;


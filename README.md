# AmazonScraper

## Amazon India Website Scraper Made With PHP. Inspired By : [This Project](https://github.com/cachecleanerjeet/amazon-scraper)

### API USAGE

### Search Products Api

*Request*
```
https://{your-deployed-herokuapp-name}.herokuapp.com/?query={search-query}

Example :
https://php-amazon-scraper.herokuapp.com/?query=Mobile
```
*Response*
```
{
    "query": "Mobile",
    "search_link": "https://www.amazon.in/s?k=Mobile",
    "total_results": 22,
    "results": [
        {
            "name": "Redmi 9A (Nature Green, 2GB Ram, 32GB Storage) | 2GHz Octa-core Helio G25 Processor</span",
            "image": "https://m.media-amazon.com/images/I/71sxlhYhKWL._SL1000_.jpg",
            "product_link": "https://www.amazon.in/Redmi-9A-2GB-32GB-Storage/dp/B08696XB4B/ref=sr_1_3",
            "sale_price": "₹6,799",
            "real_price": "₹8,499",
            "rating": "4.2 out of 5 stars",
            "product_api_link": "http://php-amazon-scraper.herokuapp.com/product.php?query=/Redmi-9A-2GB-32GB-Storage/dp/B08696XB4B/ref=sr_1_3"
        },
        .....continues
```

### Product Info Api

*Request*
```
https://{your-deployed-herokuapp-name}.herokuapp.com/product.php?query={search-query}
>> Get Your {search-query} From Search Api Or Directly Use The product_api_link.

Example :
https://php-amazon-scraper.herokuapp.com/product.php?query=/Redmi-9A-2GB-32GB-Storage/dp/B08696XB4B/ref=sr_1_3
```

*Response*
```
{
    "success": true,
    "query": "/Redmi-9A-2GB-32GB-Storage/dp/B08696XB4B/ref=sr_1_3",
    "product_details": {
        "name": "Redmi 9A (Nature Green, 2GB Ram, 32GB Storage) | 2GHz Octa-core Helio G25 Processor",
        "images": "https://images-na.ssl-images-amazon.com/images/I/71sxlhYhKWL._SL1500_.jpg",
        "sale_price": "₹ 6,799.00",
        "original_price": " ₹ 8,499.00",
        "features": [
            "Country Of Origin - India",
            "13MP rear camera with AI portrait, AI scene recognition, HDR, pro mode | 5MP front camera",
            "16.58 centimeters (6.53 inch) HD+ multi-touch capacitive touchscreen with 1600 x 720 pixels resolution, 268 ppi pixel density and 20:9 aspect ratio",
            "Memory, Storage & SIM: 2GB RAM, 32GB internal memory expandable up to 512GB | Dual SIM (nano+nano) + Dedicated SD card slot",
            "Android v10 operating system with upto 2.0GHz clock speed Mediatek Helio G25 octa core processor",
            "5000mAH lithium-polymer large battery with 10W wired charger in-box",
            "1 year manufacturer warranty for device and 6 months manufacturer warranty for in-box accessories including batteries from the date of purchase",
            "Box also includes: Power adapter, USB cable, sim eject tool, warranty card and user guide"
        ]
    }
}
```

### Deploying
- You Can Deploy To Heroku By The Button Below Or Download The Zip File Of This Repository And Upload Them On Any PHP Hosting (Free Or Paid) And You Can Run

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy)

#### Join Us On [Telegram](https://telegram.dog/NoobsGang)
#### Contact Us On [Telegram](https://telegram.dog/NoobsTalk) If You Face Any Issues..

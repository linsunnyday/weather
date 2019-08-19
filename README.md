<h1 align="center"> weather </h1>

<p align="center"> A weather SDK.</p>


## Installing

```shell
$ composer require linsunnyday/weather -vvv
```

## To configure

Before using this extension, you need to go to Golden Open Platform to register your account, then create an application and get the API Key of the application.

## Usage

use Overtrue\Weather\Weather;

$key = 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';

$weather = new Weather($key);

## Getting Real-Time Weather

$response = $weather->getWeather('深圳');

Example：

{
    "status": "1",
    "count": "1",
    "info": "OK",
    "infocode": "10000",
    "lives": [
        {
            "province": "广东",
            "city": "深圳市",
            "adcode": "440300",
            "weather": "中雨",
            "temperature": "27",
            "winddirection": "西南",
            "windpower": "5",
            "humidity": "94",
            "reporttime": "2018-08-21 16:00:00"
        }
    ]
}

## Obtaining the Recent Weather Forecast

Example：

{
    "status": "1", 
    "count": "1", 
    "info": "OK", 
    "infocode": "10000", 
    "forecasts": [
        {
            "city": "深圳市", 
            "adcode": "440300", 
            "province": "广东", 
            "reporttime": "2018-08-21 11:00:00", 
            "casts": [
                {
                    "date": "2018-08-21", 
                    "week": "2", 
                    "dayweather": "雷阵雨", 
                    "nightweather": "雷阵雨", 
                    "daytemp": "31", 
                    "nighttemp": "26", 
                    "daywind": "无风向", 
                    "nightwind": "无风向", 
                    "daypower": "≤3", 
                    "nightpower": "≤3"
                }, 
                {
                    "date": "2018-08-22", 
                    "week": "3", 
                    "dayweather": "雷阵雨", 
                    "nightweather": "雷阵雨", 
                    "daytemp": "32", 
                    "nighttemp": "27", 
                    "daywind": "无风向", 
                    "nightwind": "无风向", 
                    "daypower": "≤3", 
                    "nightpower": "≤3"
                }, 
                {
                    "date": "2018-08-23", 
                    "week": "4", 
                    "dayweather": "雷阵雨", 
                    "nightweather": "雷阵雨", 
                    "daytemp": "32", 
                    "nighttemp": "26", 
                    "daywind": "无风向", 
                    "nightwind": "无风向", 
                    "daypower": "≤3", 
                    "nightpower": "≤3"
                }, 
                {
                    "date": "2018-08-24", 
                    "week": "5", 
                    "dayweather": "雷阵雨", 
                    "nightweather": "雷阵雨", 
                    "daytemp": "31", 
                    "nighttemp": "26", 
                    "daywind": "无风向", 
                    "nightwind": "无风向", 
                    "daypower": "≤3", 
                    "nightpower": "≤3"
                }
            ]
        }
    ]
}
## Get the return value in XML format

The third parameter is the return value type, JSON and XML are optional, default json:

$response = $weather->getWeather('深圳', 'all', 'xml');

Example：

<response>
    <status>1</status>
    <count>1</count>
    <info>OK</info>
    <infocode>10000</infocode>
    <lives type="list">
        <live>
            <province>广东</province>
            <city>深圳市</city>
            <adcode>440300</adcode>
            <weather>中雨</weather>
            <temperature>27</temperature>
            <winddirection>西南</winddirection>
            <windpower>5</windpower>
            <humidity>94</humidity>
            <reporttime>2018-08-21 16:00:00</reporttime>
        </live>
    </lives>
</response>

## Description of parameters

array|string getWeather(string $city, string $type = 'base', string $format = 'json')

City - City name, such as "Shenzhen";

$type - Return content type: base: Return live weather / all: Return forecast weather;

$format - Output data format, default to JSON format, when output is set to "xml", output data in XML format.

## Use in Laravel

The same installation is used in Laravel, and the configuration is written in config/services.php:

	'weather' => [
        'key' => env('WEATHER_API_KEY'),
    ],

Then configure WEATHER_API_KEY in. env:

WEATHER_API_KEY=xxxxxxxxxxxxxxxxxxxxx

Linsunnyday\Weather\Weather instances can be obtained in two ways:

# Method parameter injection

	public function edit(Weather $weather) 
    {
        $response = $weather->getWeather('深圳');
    }

# Service name access

	public function edit() 
    {
        $response = app('weather')->getWeather('深圳');
    }

## Reference resources

Golden Open Platform Weather Interface

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/linsunnyday/weather/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/linsunnyday/weather/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT
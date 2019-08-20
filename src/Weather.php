<?php

namespace Linsunnyday\Weather;

use GuzzleHttp\Client;
use Linsunnyday\Weather\Exceptions\HttpException;
use Linsunnyday\Weather\Exceptions\InvalidArgumentException;

class Weather
{
    protected $key;

    protected $guzzleOptions = [];

    /**
     * $key 为高德开放平台创建的应用 API Key；.
     */
    // 构造函数 调用天气 API 需要用到 API Key
    public function __construct($key)
    {
        $this->key = $key;
    }

    // HTTP 客户端，用于返回 guzzle 实例
    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    // 自定义 guzzle 实例的参数
    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }

    /**
     * [getWeather 获取天气].
     *
     * @param [type] $city   [城市名 / 高德地址位置 adcode，比如：“深圳” 或者（adcode：440300）；]
     * @param string $type   [返回内容类型：base: 返回实况天气 / all: 返回预报天气；]
     * @param string $format [输出的数据格式，默认为 json 格式，当 output 设置为 “xml” 时，输出的为 XML 格式的数据。]
     *
     * @return [type] [按地名查询实时天气，获取最近的天气预报。]
     */
    public function getWeather($city, $type = 'base', $format = 'json')
    {
        $url = 'https://restapi.amap.com/v3/weather/weatherInfo';

        // 1. 对 `$format` 与 `$type` 参数进行检查，不在范围内的抛出异常。
        if (!\in_array(\strtolower($format), ['xml', 'json'])) {
            throw new InvalidArgumentException('Invalid response format: '.$format);
        }

        if (!\in_array(\strtolower($type), ['base', 'all'])) {
            throw new InvalidArgumentException('Invalid type value(base/all): '.$type);
        }
        // 2. 封装 query 参数，并对空值进行过滤。
        $query = array_filter([
            'key' => $this->key,
            'city' => $city,
            'output' => $format,
            'extensions' => $type,
        ]);

        try {
            // 3. 调用 getHttpClient 获取实例，并调用该实例的 `get` 方法，
            // 传递参数为两个：$url、['query' => $query]，
            $response = $this->getHttpClient()->get($url, [
                'query' => $query,
            ])->getBody()->getContents();

            // 4. 返回值根据 $format 返回不同的格式，
            // 当 $format 为 json 时，返回数组格式，否则为 xml。
            return 'json' === $format ? \json_decode($response, true) : $response;
        } catch (\Exception $e) {
            // 5. 当调用出现异常时捕获并抛出，消息为捕获到的异常消息，
            // 并将调用异常作为 $previousException 传入。
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * [getLiveWeather 获取实时天气].
     *
     * @param [type] $city   [城市名]
     * @param string $format [输出的数据格式]
     *
     * @return [type] [按地名查询实时天气]
     */
    public function getLiveWeather($city, $format = 'json')
    {
        return $this->getWeather($city, 'base', $format);
    }

    /**
     * [getForecastsWeather 获取天气预报].
     *
     * @param [type] $city   [城市名]
     * @param string $format [输出的数据格式]
     *
     * @return [type] [按地名获取最近的天气预报]
     */
    public function getForecastsWeather($city, $format = 'json')
    {
        return $this->getWeather($city, 'all', $format);
    }
}

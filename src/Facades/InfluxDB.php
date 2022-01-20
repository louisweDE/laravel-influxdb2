<?php

namespace louiswe\InfluxDB\Facades;

use Illuminate\Support\Facades\Facade as LaravelFacade;
use InfluxDB2\Configuration;
use InfluxDB2\Model\HealthCheck;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\Point;
use InfluxDB2\QueryApi;
use InfluxDB2\UdpWriter;
use InfluxDB2\WriteApi;
use louiswe\InfluxDB\Client;

/**
 * Class InfluxDB
 * @package louiswe\InfluxDB\Facades
 * @method static increment(string $name, bool $success = true) void
 * @method static writePoint(Point $point) void
 * @method static write(string $name, array $tags, array $fields) void
 * @method static createWriteApi(array $writeOptions = null, array $pointSettings = null) WriteApi
 * @method static createUdpWriter() UdpWriter
 * @method static createQueryApi() QueryApi
 * @method static health() HealthCheck
 * @method static ping() array
 * @method static close() void
 * @method static getConfiguration() Configuration
 * @method static createService($serviceClass) object
 * @method static getClosed() bool
 * @const VERSION
 */
class InfluxDB extends LaravelFacade
{

    public static function getFacadeAccessor(): string
    {
        return Client::class;
    }
}
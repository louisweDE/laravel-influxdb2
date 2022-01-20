<?php

namespace louiswe\InfluxDB\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use InfluxDB2\Model\WritePrecision;
use louiswe\InfluxDB\Client;

/**
 * Class ServiceProvider
 * @package louiswe\InfluxDB\Providers
 */
class ServiceProvider extends LaravelServiceProvider implements DeferrableProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
                             __DIR__ . '/../../config/InfluxDb.php' => config_path('influxdb.php')
                         ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class,
            function ($app) {
                $url = config('influxdb.ssl') ? 'https' : 'http';
                $url .= '://' . config('influxdb.host') . ':' . config('influxdb.port');

                $config = [
                    'url'         => $url,
                    'token'       => config('influxdb.token'),
                    'timeout'     => config('influxdb.timeout'),
                    'bucket'      => config('influxdb.bucket'),
                    'org'         => config('influxdb.org'),
                    'precision'   => WritePrecision::S,
                    'verifySSL'   => config('influxdb.verifySSL'),
                    'tags'        => config('influxdb.tags'),
                    'ipVersion'   => config('influxdb.ipVersion')
                ];

                if (config('influxdb.udp')) {
                    $config['udpHost'] = config('influxdb.udpHost');
                    $config['udpPort'] = config('influxdb.udpPort');
                    $config['udp'] = true;
                }

                return new Client($config);
            });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            Client::class,
        ];
    }
}
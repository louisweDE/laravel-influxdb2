# Laravel Service Provider for InfluxDB2

## Installation

### 1. Install via composer

```composer require louiswe/laravel-influxdb```

### 2. Configuration

```ini
INFLUXDB_HOST = 127.0.0.1
INFLUXDB_PORT = 8086
INFLUXDB_PORT_UDP = 8094
INFLUXDB_USER =
INFLUXDB_SSL = false
INFLUXDB_TOKEN = ""
INFLUXDB_ORGANISATION =
INFLUXDB_DEFAULT_BUCKET =
INFLUXDB_VERIFY_SSL = false
INFLUXDB_TIMEOUT = 1
```

Also ``APP_ENV`` has to be set in your `.env` file

To use udp telegraf has to be installed and socket listener plugin has to be activated<br>
https://www.influxdata.com/blog/telegraf-socket-listener-input-plugin/

### 3. Publish ServiceProvider

```php artisan vendor:publish```

The ServiceProvider will set up the library, so that you can use it everywhere in your project

### 4. Add default tags (optional)

To add default tags modify the `config/influxdb.php`

```php
return [
    // ...
    'tags'        => ['environment' => 'development', 'host' => 'server1']
    // ...
];
```

## Usage

There are some predefined functions to make it simpler to write data to InfluxDB, if you have any suggestions how to
improve it further fell free to pass them to me.

```php
use InfluxDB2\Point;
use louiswe\InfluxDB\Facades\InfluxDB;

// Increment success or failure measuremens
InfluxDB::increment("login"); // ["success" => 1]
InfluxDB::increment("login", false); // ["failure" => 1]


$tags = ['environment' => 'development', 'server' => 1];
$fields = ['success' => 1];

// Write Point to InfluxDB
$point = new Point('login', $tags, $fields);
InfluxDB::writePoint($point);

// Write directly to InfluxDB
InfluxDB::write('login', $tags, $fields);
```

Furthermore, you can access the methods of the library [influxdb-client-php](https://github.com/influxdata/influxdb-client-php)
directly, for example:

```php
use louiswe\InfluxDB\Facades\InfluxDB;

InfluxDB::createQueryApi();
InfluxDB::createUdpWriter();
```

<?php

return [
    'host'        => env('INFLUXDB_HOST', 'localhost'),
    'udpHost'     => env('INFLUXDB_HOST_UDP', 'localhost'),
    'port'        => env('INFLUXDB_PORT', 8086),
    'udpPort'     => env('INFLUXDB_PORT_UDP', 8094),
    'token'       => env('INFLUXDB_TOKEN', ''),
    'org'         => env('INFLUXDB_ORGANISATION', ''),
    'bucket'      => env('INFLUXDB_DEFAULT_BUCKET', ''),
    'ssl'         => env('INFLUXDB_SSL', false),
    'udp'         => env('INFLUXDB_UDP', false),
    'verifySSL'   => env('INFLUXDB_VERIFY_SSL', false),
    'timeout'     => env('INFLUXDB_TIMEOUT', 0),
    'tags'        => [], // set default tags here
    'ipVersion'   => env('INFLUXDB_IP_VERSION', 4)
];
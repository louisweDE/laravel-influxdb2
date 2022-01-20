<?php

namespace louiswe\InfluxDB;

use InfluxDB2\Client as InfluxClient;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\Point;
use Throwable;

class Client extends InfluxClient
{
    /**
     * @throws Throwable
     */
    public function increment(string $name, bool $success = true): void
    {
        self::write($name, [], [$success ? 'success' : 'failure' => 1]);
    }

    /**
     * @throws Throwable
     */
    public function writePoint(Point $point): void
    {
        if (isset($this->options['udp'])) {
            self::writeToApi($point);
        } else {
            self::writeUdp($point);
        }
    }

    private function writeToApi(string|array|Point $data): void
    {
        $writer = $this->createWriteApi();
        $writer->write($data,
                       WritePrecision::S,
                       $this->options['bucket'],
                       $this->options['org']);
    }

    /**
     * @throws Throwable
     */
    private function writeUdp(string|array|Point $data): void
    {
        $writer = $this->createUdpWriter();
        $writer->write($data);
        $writer->close();
    }

    /**
     * @throws Throwable
     */
    public function write(string $name, array $tags, array $fields): void
    {
        $dataArray = [
            'name'   => $name,
            'tags'   => $tags,
            'fields' => $fields
        ];
        if (isset($this->options['udp'])) {
            self::writeToApi($dataArray);
        } else {
            self::writeUdp($dataArray);
        }
    }

    public function getClosed(): bool
    {
        return $this->closed;
    }
}
<?php

namespace App\Parsers;

use App\Exceptions\InvalidFormatException;
use App\Exceptions\WrongArgumenTypeException;
use App\Utils\RegularExpressions;

/**
 * Parser for access_log file creating by web-server
 */
class AccessLogParser implements Parser
{
    /**
     * @var array
     */
    private $urls;

    /**
     * @var array
     */
    private $statuses;

    /**
     * @var array
     */
    private $bots;

    /**
     * @var integer
     */
    private $size;

    /**
     * @var integer
     */
    private $views;

    public function __construct()
    {
        $this->views    = 0;
        $this->size     = 0;
        $this->statuses = [];
        $this->urls     = [];
        $this->bots     = [
            'Google' => 0,
            'Bing'   => 0,
            'Baidu'  => 0,
            'Yandex' => 0,
        ];
    }

    /**
     * @param resource $handle
     *
     * @return array
     */
    public function parse($handle): array
    {
        if (!is_resource($handle)) {
            throw new WrongArgumenTypeException();
        }

        while ($line = fgets($handle)) {
            $matches = $this->parseLine($line);

            $this->urls[$matches['url']] = array_key_exists($matches['url'], $this->urls)
                ? $this->urls[$matches['url']] + 1
                : 1
            ;

            $this->statuses[$matches['status']] = array_key_exists($matches['status'], $this->statuses)
                ? $this->statuses[$matches['status']] + 1
                : 1
            ;

            $this->size  += $matches['size'];
            $this->views += 1;

            $this->updateBots($matches['client']);
        }

        fclose($handle);

        return [
            'views'       => $this->views,
            'urls'        => count($this->urls),
            'traffic'     => $this->size,
            'crawlers'    => $this->bots,
            'statusCodes' => $this->statuses,
        ];
    }

    /**
     * @param string $line
     *
     * @return array
     */
    private function parseLine(string $line): array
    {
        $matches = [];

        preg_match(RegularExpressions::accessLog(), $line, $matches);

        $keys = ['size', 'status', 'url', 'client'];
        foreach ($keys as $key) {
            if (!array_key_exists($key, $matches)) {
                throw new InvalidFormatException();
            }
        }

        return $matches;
    }

    /**
     * @param string $userAgent
     */
    private function updateBots(string $userAgent): void
    {
        if (preg_match(RegularExpressions::googleBot(), $userAgent)) {
            $this->bots['Google'] += 1;
        } elseif (preg_match(RegularExpressions::bingBot(), $userAgent)) {
            $this->bots['Bing'] += 1;
        } elseif (preg_match(RegularExpressions::baiduBot(), $userAgent)) {
            $this->bots['Baidu'] += 1;
        } elseif (preg_match(RegularExpressions::yandexBot(), $userAgent)) {
            $this->bots['Yandex'] += 1;
        }
    }
}

<?php

namespace Model\Vo;
use DateTime;
use DateTimeZone;

class Date extends VoAbstract
{
    public static $defaultConfig = [
        'format'   => DATE_RFC822,
        'timezone' => null,
    ];

    public function __construct(array $config = [])
    {
        parent::__construct(array_merge(self::$defaultConfig, $config));
    }

    protected function defaultValue()
    {
        return $this->datetime()->format($this->config['format']);
    }

    public function translate($value)
    {
        if (is_null($value) && $this->config['allowNull']) {
            return $value;
        }

        $datetime = $this->datetime();

        if ($value instanceof DateTime) {
            $datetime = $value;
        } elseif (is_numeric($value)) {
            $datetime->setTimestamp($value);
        } else {
            $datetime->modify($value ?: 'now');
        }

        return $datetime->format($this->config['format']);
    }

    private function datetime()
    {
        $datetime = new DateTime('now');

        if ($this->config['timezone']) {
            $datetime = $datetime->setTimezone(new DateTimeZone($this->config['timezone']));
        }

        return $datetime;
    }
}

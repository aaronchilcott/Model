<?php

namespace Model\Vo;

class EnumSet extends VoAbstract
{
    private $values;

    public function __construct(array $values)
    {
        $this->values = $values;
    }

    public function translate($value)
    {
        if ($this->config['allowNull'] && is_null($value)) {
            return $value;
        }

        if (!is_array($value)) {
            return;
        }

        $add = [];

        foreach ($value as $k => $v) {
            if (in_array($v, $this->values)) {
                $add[$k] = $v;
            }
        }

        return $add;
    }
}
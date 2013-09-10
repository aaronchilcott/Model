<?php

namespace Model\Vo;

class Boolean extends VoAbstract
{
    public function init()
    {
        return false;
    }

    public function translate($value)
    {
        if ($this->config['allowNull'] && is_null($value)) {
            return $value;
        }

        $lower = strtolower($value);

        if ($lower === 'true') {
            return true;
        }

        if ($lower === 'false' || $lower === 'null') {
            return false;
        }

        return (bool) $value;
    }
}
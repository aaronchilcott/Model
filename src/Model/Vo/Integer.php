<?php

namespace Model\Vo;

class Integer extends VoAbstract
{
    protected function defaultValue()
    {
        return 0;
    }

    public function translate($value)
    {
        if ($this->config['allowNull'] && is_null($value)) {
            return $value;
        }

        return (int) $value;
    }
}
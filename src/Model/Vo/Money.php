<?php

namespace Model\Vo;

class Money extends VoAbstract
{
    public function translate($value)
    {
        if ($this->config['allowNull'] && is_null($value)) {
            return $value;
        }

        return (float) number_format($value, 2);
    }
}
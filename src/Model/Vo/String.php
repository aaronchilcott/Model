<?php

namespace Model\Vo;

class String extends VoAbstract
{
    public function translate($value)
    {
        if ($this->config['allowNull'] && is_null($value)) {
            return $value;
        }

        return (string) $value;
    }
}
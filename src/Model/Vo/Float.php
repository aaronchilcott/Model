<?php

namespace Model\Vo;

class Float extends VoAbstract
{
    public function translate($value)
    {
        if ($this->config['allowNull'] && is_null($value)) {
            return $value;
        }

        return (float) $value;
    }
}
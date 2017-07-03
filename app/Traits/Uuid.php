<?php

namespace App\Traits;


trait Uuid
{
    public function setUUID($value, $column='uuid')
    {
        $this->attributes[$column] = hex2bin(str_replace('-','', $value));
    }

    public function getUUID($value)
    {
        return bin2hex($value);
    }

    public function scopeUUID($query, $uuid) {
            return $query->where('uuid', hex2bin($uuid));
    }

}
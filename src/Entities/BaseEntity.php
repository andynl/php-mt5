<?php

namespace Tarikh\PhpMeta\Entities;

class BaseEntity
{
    public function toJson()
    {
        $data = get_object_vars($this);
        return array_filter(array_combine(
            array_map('ucfirst', array_keys($data)),
            array_values($data)
        ));
    }
}

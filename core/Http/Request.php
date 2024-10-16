<?php

namespace Core\Http;

class Request
{
    protected $data;

    public function __construct(array $data = [])
    {
         $this->data = $data;
    }

    public function query($key = null)
    {
        if (is_null($key)) {
            return $this->data;
        }

        return $this->data[$key] ?? null;
    }
}

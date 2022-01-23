<?php

namespace App\Modules;

use App\Modules\Engin\EnginInterface;

class Car
{
    protected $engin;

    public function __construct(EnginInterface $engin)
    {
        $this->engin = $engin;
    }
}

<?php

namespace App\Modules\Engin;

use App\Modules\Turbine\TurbineInterface;

class Engin1 implements EnginInterface
{
    protected $name = 'Model 1 Engin';
    protected $turbin;

    public function __construct(TurbineInterface $turbin)
    {
        $this->turbin = $turbin;
    }
}

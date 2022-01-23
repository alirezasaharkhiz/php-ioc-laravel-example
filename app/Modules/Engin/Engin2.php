<?php

namespace App\Modules\Engin;

use App\Modules\Turbine\TurbineInterface;

class Engin2 implements EnginInterface
{
    protected $name = 'This is another one, Model2 engin';
    protected $turbin;

    public function __construct(TurbineInterface $turbin)
    {
        $this->turbin = $turbin;
    }
}

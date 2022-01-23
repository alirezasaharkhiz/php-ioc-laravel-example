<?php

namespace App\Containers;

use App\Modules\Engin\Engin1;
use App\Modules\Engin\Engin2;
use App\Modules\Turbine\Turbine1;
use App\Modules\Turbine\Turbine2;

class AppContainer
{
    protected $instances = [];

    public function get($id, $from)
    {
        if ($this->has($id)) {
            return $this->instances[$id];
        }

        $instance = $this->createObject($id, $from);

        $this->instances[$id] = $instance;

        return $instance;
    }

    public function has($id)
    {
        return isset($this->instances[$id]);
    }

    public function createObject($className, $from)
    {

        print_r($className.'---');

        if (!class_exists($className)) {
            if(str_contains($className,'Interface'))
                $className = $this->considerInterfaces($className,$from);
            elseif (!class_exists($className))
                throw new \Exception("Class {$className} does not exists");
        }

        $reflectionClass = new \ReflectionClass($className);

        if ($reflectionClass->getConstructor() == null)
            return new $className;

        $parameters = $reflectionClass->getConstructor()->getParameters();

        $dependencies = $this->buildDependencies($parameters, $from);

        return $reflectionClass->newInstanceArgs($dependencies);
    }

    public function buildDependencies($parameters, $from)
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependencies[] = $this->createObject($parameter->getClass()->getName(), $from);
        }

        return $dependencies;
    }

    protected function considerInterfaces($className,$from)
    {
        $nextClassName = "";

        switch ($className) {
            case 'App\Modules\Engin\EnginInterface' :
                $nextClassName =  ($from == 'me') ? Engin1::class : Engin2::class;
            break;
            case 'App\Modules\Turbine\TurbineInterface' :
                $nextClassName =  ($from == 'me') ? Turbine1::class : Turbine2::class;
            break;
        }

        return $nextClassName;
    }
}

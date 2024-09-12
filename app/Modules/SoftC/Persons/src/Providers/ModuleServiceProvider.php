<?php

namespace SoftC\Persons\Providers;

use SoftC\Core\Providers\BaseModuleServiceProvider;
use SoftC\Persons\Models\Person;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        Person::class,
    ];
}
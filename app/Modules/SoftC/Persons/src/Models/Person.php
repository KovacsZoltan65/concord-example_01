<?php

namespace SoftC\Persons\Models;

use SoftC\Persons\Contracts\Person as PersonContract;

class Person implements PersonContract
{
    protected $table = 'persons';
    
    protected $fillable = ['name','email','phone'];
    
}
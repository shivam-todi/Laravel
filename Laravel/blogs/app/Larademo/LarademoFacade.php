<?php

namespace App\Larademo;

use Illuminate\Support\Facades\Facade;

class LarademoFacade extends Facade
{
  protected static function getFacadeAccessor()
  {
     return 'larademo';
  }
}

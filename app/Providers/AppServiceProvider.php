<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  public function boot()
  {
  
  }

  public function register()
  {
    $this->app->bind(
        'App\\Repositories\\CourseRepositoryInterface',
        'App\\Repositories\\CourseRepository'
    );

    $this->app->bind(
        'App\\Repositories\\UserRepositoryInterface',
        'App\\Repositories\\UserRepository' 
    );

    $this->app->bind(
        'App\\Repositories\\StudentRepositoryInterface',
        'App\\Repositories\\StudentRepository'
    );

    $this->app->bind(
        'App\\Repositories\\InstructorRepositoryInterface',
        'App\\Repositories\\InstructorRepository'
    );

    $this->app->bind(
        'App\\Repositories\\PurchaseRepositoryInterface',
        'App\\Repositories\\PurchaseRepository'
    );

    $this->app->bind(
        'App\\Repositories\\PurchaseDetailRepositoryInterface',
        'App\\Repositories\\PurchaseDetailRepository'
    );
  }
}

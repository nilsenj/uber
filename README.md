# nilsenj/uber
uber api v1 for Laravel 5.*

**First**
go to [uber dashboard](https://developer.uber.com/dashboard/)

and get ```server_token```


Installation
------------

1. Either run `composer require nilsenj/uber` 
or add `"nilsenj/uber": "dev-master"` to the `require` key in `composer.json` and run `composer install`

2. Add ` \nilsenj\Uber\UberServiceProvider::class,` to the `providers` key in `config/app.php`
3. Add `'Uber' => \nilsenj\Uber\Facades\UberFacade::class,` to the `aliases` key in `config/app.php`

Usage
-----

#####Using Facade
``` html
{!! Uber::someMethod() !!}
```
#####Using Contract
``` php
protected $uber;

    /**
     * UberController constructor.
     * @param UberContract $uber
     */
    public function __construct(UberContract $uber)
    {
        $this->uber = $uber;
    }
    
    public function index() {
        $this->uber->someMethod();
    }
    
```
#####List Of Methods

``` html
```

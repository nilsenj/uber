# nilsenj/uber
uber api v1.* for Laravel 5.*

**First**
go to [uber dashboard](https://developer.uber.com/dashboard/)

and get ```server_token```


Installation
------------

1. Either run `composer require nilsenj/uber` 
or add `"nilsenj/uber": "dev-master"` to the `require` key in `composer.json` and run `composer install`

2. Add ` \nilsenj\Uber\UberServiceProvider::class,` to the `providers` key in `config/app.php`
3. Add `'Uber' => \nilsenj\Uber\Facades\UberFacade::class,` to the `aliases` key in `config/app.php`
4. Do `php artisan vendor:publish` to publish the config. You can see it in `config/uber.php`

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

### Get Products

#### By location:

```php
$products = Uber::getProductsByLocation($latitude, $longitude);
```
[https://developer.uber.com/docs/riders/references/api/v1.2/products-get](https://developer.uber.com/docs/riders/references/api/v1.2/products-get)

#### By Id:

```php
$product = Uber::getProductsById($productId);
```

[https://developer.uber.com/docs/riders/references/api/v1.2/products-product_id-get](https://developer.uber.com/docs/riders/references/api/v1.2/products-product_id-get)

### Get Price Estimates

```php
$estimates = Uber::getPriceEstimates($start_latitude, $start_longitude, $end_latitude, $end_longitude);
```

[https://developer.uber.com/docs/riders/references/api/v1.2/estimates-price-get](https://developer.uber.com/docs/riders/references/api/v1.2/estimates-price-get)

### Get Time Estimates

```php
$estimates = Uber::getTimeEstimates($start_latitude, $start_longitude);
```

[https://developer.uber.com/docs/riders/references/api/v1.2/estimates-time-get](https://developer.uber.com/docs/riders/references/api/v1.2/estimates-time-get)

### Get Promotions

```php
$promotions = Uber::getPromotions($start_latitude, $start_longitude, $end_latitude, $end_longitude);
```

[https://developer.uber.com/docs/riders/ride-promotions/introduction](https://developer.uber.com/docs/riders/ride-promotions/introduction)

### Get User Activity

This feature is only available since version `1.1`.

```php
$history = Uber::getUserActivity();
```

[https://developer.uber.com/docs/riders/references/api/v1.2/history-get](https://developer.uber.com/docs/riders/references/api/v1.2/history-get)

### Get User Profile

```php
$profile = Uber::getUserProfile();
```

[https://developer.uber.com/docs/riders/references/api/v1.2/me-get](https://developer.uber.com/docs/riders/references/api/v1.2/me-get)

### Update User Profile

```php
$attributes = array('applied_promotion_codes' => 'PROMO_CODE');
$profileResponse = Uber::updateUserProfile($attributes);
```

[https://developer.uber.com/docs/riders/references/api/v1.2/me-patch](https://developer.uber.com/docs/riders/references/api/v1.2/me-patch)

### Get Payment Methods

```php
$paymentMethods = Uber::getPaymentMethods();
```

[https://developer.uber.com/docs/riders/references/api/v1.2/payment-methods-get](https://developer.uber.com/docs/riders/references/api/v1.2/payment-methods-get)

### Get Place

```php
$placeId = 'home';
$place = Uber::getPlace($placeId);
```

[https://developer.uber.com/docs/riders/references/api/v1.2/places-place_id-get](https://developer.uber.com/docs/riders/references/api/v1.2/places-place_id-get)

### Update a Place

```php
$placeId = 'home';
$attributes = array('address' => '685 Market St, San Francisco, CA 94103, USA');
$place = Uber::updatePlace($placeId, $attributes);
```

[https://developer.uber.com/docs/riders/references/api/v1.2/places-place_id-put](https://developer.uber.com/docs/riders/references/api/v1.2/places-place_id-put)

### Request A Ride

```php
$request = Uber::requestToRide($start_latitude, $start_longitude, $end_latitude, 
                $end_longitude, $product_id = null, $surge_confirmation_id = null, $payment_method_id = null);
```

[https://developer.uber.com/docs/riders/ride-requests/tutorials/api/best-practices#handling-surge-pricing](https://developer.uber.com/docs/riders/ride-requests/tutorials/api/best-practices#handling-surge-pricing)

### Get Current Ride Details

```php
$request = Uber::getCurrentRideDetails();
```

[https://developer.uber.com/docs/riders/references/api/v1.2/requests-current-get](https://developer.uber.com/docs/riders/references/api/v1.2/requests-current-get)

### Get Ride Details

```php
$request = Uber::getRideDetails($requestId);
```

[https://developer.uber.com/docs/riders/references/api/v1.2/requests-request_id-get](https://developer.uber.com/docs/riders/references/api/v1.2/requests-request_id-get)

### Update Current Ride Details

```php

$end_address= '685 Market St, San Francisco, CA 94103, USA',
$end_nickname = 'da crib',
$end_place_id = 'home',
$end_latitude = '41.87499492',
$end_longitude = '-87.67126465'

$updateRequest = Uber::updateCurrentRideDetails($end_address, $end_nickname, $end_place_id,
                                                                    $end_latitude, $end_longitude);
```

[https://developer.uber.com/docs/riders/references/api/v1.2/requests-current-patch](https://developer.uber.com/docs/riders/references/api/v1.2/requests-current-patch)

### Update Ride Details

```php
$requestId = '4bfc6c57-98c0-424f-a72e-c1e2a1d49939'

$end_address = '685 Market St, San Francisco, CA 94103, USA',
$end_nickname = 'da crib',
$end_place_id = 'home',
$end_latitude = '41.87499492',
$end_longitude = '-87.67126465'

$updateRequest = Uber::updateRideDetails($requestId, $end_address, $end_nickname, $end_place_id,
                                                             $end_latitude, $end_longitude);
```

[https://developer.uber.com/docs/riders/references/api/v1.2/requests-request_id-patch](https://developer.uber.com/docs/riders/references/api/v1.2/requests-request_id-patch)

### Get Ride Estimate

```php
$product_id = '4bfc6c57-98c0-424f-a72e-c1e2a1d49939',
$start_latitude = '41.85582993',
$start_longitude = '-87.62730337',
$end_latitude = '41.87499492', // optional
$end_longitude = '-87.67126465', // optional

$requestEstimate = Uber::getRideEstimate($product_id, $start_latitude, 
                    $start_longitude, $end_latitude, $end_longitude);
```

[https://developer.uber.com/docs/riders/references/api/v1.2/requests-estimate-post](https://developer.uber.com/docs/riders/references/api/v1.2/requests-estimate-post)

### Get Ride Map

```php
$map = Uber::getRideMap($requestId);
```

[https://developer.uber.com/docs/riders/references/api/v1.2/requests-request_id-map-get](https://developer.uber.com/docs/riders/references/api/v1.2/requests-request_id-map-get)

### Get Ride Receipt

```php
$receipt = Uber::getRideReceipt($requestId);
```

[https://developer.uber.com/docs/riders/references/api/v1.2/requests-current-delete](https://developer.uber.com/docs/riders/references/api/v1.2/requests-current-delete)

### Cancel Ride

```php
$request = Uber::cancelRide($requestId);
```

[https://developer.uber.com/docs/riders/references/api/v1.2/requests-request_id-delete](https://developer.uber.com/docs/riders/references/api/v1.2/requests-request_id-delete)

### Create Reminder

```php
$attributes = array(
    'reminder_time' => '1429294463',
    'phone_number' => '555-555-5555',
    'event' => array(
        'time' => '1429294463',
        'name' => 'Frisbee with friends',
        'location' => 'Dolores Park',
        'latitude' => '37.759773',
        'longitude' => '-122.427063',
    ),
    'product_id' => 'a1111c8c-c720-46c3-8534-2fcdd730040d',
    'trip_branding' => array(
        'link_text' => 'View team roster',
        'partner_deeplink' => 'partner://team/9383',
    )
);
$reminder = Uber::createReminder($attributes)
```

[https://developer.uber.com/docs/riders/references/api/v1.2/reminders-post](https://developer.uber.com/docs/riders/references/api/v1.2/reminders-post)

### Get Reminder

```php
$reminderId = '4bfc6c57-98c0-424f-a72e-c1e2a1d49939';
$reminder = Uber::getReminder($reminderId);
```

[https://developer.uber.com/docs/riders/references/api/v1.2/reminders-reminder_id-get](https://developer.uber.com/docs/riders/references/api/v1.2/reminders-reminder_id-get)

### Update Reminder

```php
$reminderId = '4bfc6c57-98c0-424f-a72e-c1e2a1d49939';
$attributes = array(
    'reminder_time' => '1429294463',
    'phone_number' => '555-555-5555',
    'event' => array(
        'time' => '1429294463',
        'name' => 'Frisbee with friends',
        'location' => 'Dolores Park',
        'latitude' => '37.759773',
        'longitude' => '-122.427063',
    ),
    'product_id' => 'a1111c8c-c720-46c3-8534-2fcdd730040d',
    'trip_branding' => array(
        'link_text' => 'View team roster',
        'partner_deeplink' => 'partner://team/9383',
    )
);
$reminder = Uber::updateReminder($reminderId, $attributes);
```

[https://developer.uber.com/docs/riders/references/api/v1.2/reminders-reminder_id-patch](https://developer.uber.com/docs/riders/references/api/v1.2/reminders-reminder_id-patch)

### Cancel Reminder

```php
$reminderId = '4bfc6c57-98c0-424f-a72e-c1e2a1d49939';
$reminder = Uber::cancelReminder($reminderId);
```

[https://developer.uber.com/docs/riders/references/api/v1.2/reminders-reminder_id-delete](https://developer.uber.com/docs/riders/references/api/v1.2/reminders-reminder_id-delete)

### Rate Limiting

> This feature is only supported for `v1` version of the API.

Rate limiting is implemented on the basis of a specific client's secret token. By default, 1,000 requests per hour can be made per secret token.

When consuming the service with this package, your rate limit status will be made available within the client.

```php
$rateLimit = Uber::rateLimiting($productId);
will return an array
["limit" => , "remaining" => , "reset" => ]
```
These values will update after each request. `getRateLimit` will return null after the client is created and before the first successful request.

[https://developer.uber.com/v1/api-reference/#rate-limiting](https://developer.uber.com/v1/api-reference/#rate-limiting)

### Using the Sandbox

Modify the status of an ongoing sandbox Request.

> These methods will throw `Stevenmaguire\Uber\Exception` when invoked while the client is not in sandbox mode. The underlying API endpoints have no effect unless you are using the sandbox environment.

```php
$product_id = '4bfc6c57-98c0-424f-a72e-c1e2a1d49939',
$start_latitude = '41.85582993',
$start_longitude = '-87.62730337',
$end_latitude = '41.87499492',
$end_longitude = '-87.67126465'

$updateRequest = Uber::modifyOngoingStatusRequestSandbox(
                 $product_id, $start_latitude, $start_longitude, $end_latitude,
                 $end_longitude, $status = ''); 
```

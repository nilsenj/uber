<?php

namespace nilsenj\Uber;

use Stevenmaguire\Uber\Client;

/**
 * Class UberSDK
 * @package nilsenj\UberSDK
 */
class Uber implements UberContract
{
    /**
     * @var Client
     */
    protected $uberSdk;

    /**
     * UberSDK constructor.
     */
    public function __construct()
    {
        $this->uberSdk = new Client(config('uber'));
    }

    /**
     * @return Client
     */
    public function getUberSdk(): Client
    {
        return $this->uberSdk;
    }

    /**
     * @param $latitude
     * @param $longitude
     * @return \Stevenmaguire\Uber\stdClass
     */
    public function getByLocation($latitude, $longitude)
    {
        $products = $this->uberSdk->getProducts(array(
            'latitude' => $latitude,
            'longitude' => $longitude
        ));
        return $products;
    }

    /**
     * @param $productId
     * @return \Stevenmaguire\Uber\stdClass
     */
    public function getById($productId)
    {
        $product = $this->uberSdk->getProduct($productId);
        return $product;
    }

    /**
     * @param $start_latitude
     * @param $start_longitude
     * @param $end_latitude
     * @param $end_longitude
     * @return \Stevenmaguire\Uber\stdClass
     */
    public function getPriceEstimates($start_latitude, $start_longitude, $end_latitude, $end_longitude)
    {
        $estimates = $this->uberSdk->getPriceEstimates(array(
            'start_latitude' => $start_latitude,
            'start_longitude' => $start_longitude,
            'end_latitude' => $end_latitude,
            'end_longitude' => $end_longitude
        ));
        return $estimates;
    }

    /**
     * @param $start_latitude
     * @param $start_longitude
     * @return \Stevenmaguire\Uber\stdClass
     */
    public function getTimeEstimates($start_latitude, $start_longitude)
    {
        $estimates = $this->uberSdk->getTimeEstimates(array(
            'start_latitude' => $start_latitude,
            'start_longitude' => $start_longitude
        ));

        return $estimates;
    }

    /**
     * @param $start_latitude
     * @param $start_longitude
     * @param $end_latitude
     * @param $end_longitude
     * @return \Stevenmaguire\Uber\stdClass
     */
    public function getPromotions($start_latitude, $start_longitude, $end_latitude, $end_longitude)
    {
        $promotions = $this->uberSdk->getPromotions(array(
            'start_latitude' => $start_latitude,
            'start_longitude' => $start_longitude,
            'end_latitude' => $end_latitude,
            'end_longitude' => $end_longitude
        ));

        return $promotions;
    }

    /**
     * @return \Stevenmaguire\Uber\stdClass
     */
    public function getUserActivity()
    {
        $this->uberSdk->setVersion('v1.2'); // or v1.1
        $history = $this->uberSdk->getHistory(array(
            'limit' => 50, // optional
            'offset' => 0 // optional
        ));

        return $history;
    }

    /**
     * @return \Stevenmaguire\Uber\stdClass
     */
    public function getUserProfile()
    {
        $profile = $this->uberSdk->getProfile();
        return $profile;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function updateUserProfile(array $attributes = [])
    {
        $profileResponse = $this->uberSdk->setProfile($attributes);
        return $profileResponse;
    }

    /**
     * @return mixed
     */
    public function getPaymentMethods()
    {
        $paymentMethods = $this->uberSdk->getPaymentMethods();
        return $paymentMethods;
    }

    /**
     * @param string $placeId
     * @return mixed
     */
    public function getPlace(string $placeId)
    {
        $placeId = 'home';
        $place = $this->uberSdk->getPlace($placeId);
        return $place;
    }

    /**
     * @param string $placeId
     * @param array $attributes
     * @return mixed
     */
    public function updatePlace(string $placeId, array $attributes = [])
    {
        $place = $this->uberSdk->setPlace($placeId, $attributes);
        return $place;
    }

    /**
     * @param $start_latitude
     * @param $start_longitude
     * @param $end_latitude
     * @param $end_longitude
     * @param null $product_id
     * @param null $surge_confirmation_id
     * @param null $payment_method_id
     * @return \Stevenmaguire\Uber\stdClass
     */
    public function requestToRide($start_latitude, $start_longitude, $end_latitude, $end_longitude,
                                  $product_id = null, $surge_confirmation_id = null, $payment_method_id = null)
    {
        try {
            $request = $this->uberSdk->requestRide(array(
                'start_latitude' => $start_latitude,
                'start_longitude' => $start_longitude,
                'end_latitude' => $end_latitude,
                'end_longitude' => $end_longitude,
                'product_id' => $product_id, // Optional
                'surge_confirmation_id' => $surge_confirmation_id, // Optional
                'payment_method_id' => $payment_method_id  // Optional
            ));

            return $request;
        } catch (\Stevenmaguire\Uber\Exception $e) {
            $body = $e->getBody();
            $surgeConfirmationId = $body['meta']['surge_confirmation']['surge_confirmation_id'];
        }
    }

    /**
     * @return mixed
     */
    public function getCurrentRideDetails()
    {
        $request = $this->uberSdk->getCurrentRequest();
        return $request;
    }

    /**
     * @param $requestId
     * @return \Stevenmaguire\Uber\stdClass
     */
    public function getRideDetails($requestId)
    {
        $request = $this->uberSdk->getRequest($requestId);
        return $request;
    }

    /**
     * @param $end_address
     * @param $end_nickname
     * @param $end_place_id
     * @param $end_latitude
     * @param $end_longitude
     * @return mixed
     */
    public function updateCurrentRideDetails($end_address, $end_nickname, $end_place_id,
                                             $end_latitude, $end_longitude)
    {
        $requestDetails = array(
            'end_address' => $end_address,
            'end_nickname' => $end_nickname,
            'end_place_id' => $end_place_id,
            'end_latitude' => $end_latitude,
            'end_longitude' => $end_longitude
        );

        $updateRequest = $this->uberSdk->setCurrentRequest($requestDetails);

        return $updateRequest;
    }

    /**
     * @param $requestId
     * @param $end_address
     * @param $end_nickname
     * @param $end_place_id
     * @param $end_latitude
     * @param $end_longitude
     * @return mixed
     */
    public function updateRideDetails($requestId, $end_address, $end_nickname, $end_place_id,
                                      $end_latitude, $end_longitude)
    {
        $requestDetails = array(
            'end_address' => $end_address,
            'end_nickname' => $end_nickname,
            'end_place_id' => $end_place_id,
            'end_latitude' => $end_latitude,
            'end_longitude' => $end_longitude
        );

        $updateRequest = $this->uberSdk->setRequest($requestId, $requestDetails);
        return $updateRequest;
    }

    /**
     * @param $product_id
     * @param $start_latitude
     * @param $start_longitude
     * @param $end_latitude
     * @param $end_longitude
     * @return mixed
     */
    public function getRideEstimate($product_id, $start_latitude, $start_longitude, $end_latitude, $end_longitude)
    {
        $requestEstimate = $this->uberSdk->getRequestEstimate(array(
            'product_id' => $product_id,
            'start_latitude' => $start_latitude,
            'start_longitude' => $start_longitude,
            'end_latitude' => $end_latitude, // optional
            'end_longitude' => $end_longitude, // optional
        ));

        return $requestEstimate;
    }

    /**
     * @param $requestId
     * @return \Stevenmaguire\Uber\stdClass
     */
    public function getRideMap($requestId)
    {
        $map = $this->uberSdk->getRequestMap($requestId);
        return $map;
    }

    /**
     * @param $requestId
     * @return mixed
     */
    public function getRideReceipt($requestId)
    {
        $receipt = $this->uberSdk->getRequestReceipt($requestId);
        return $receipt;
    }

    /**
     * @param $requestId
     * @return \Stevenmaguire\Uber\stdClass
     */
    public function cancelRide($requestId)
    {
        $request = $this->uberSdk->cancelRequest($requestId);
        return $request;
    }

    /**
     * @param array $attributes
     * array(
     * 'reminder_time' => '1429294463',
     * 'phone_number' => '555-555-5555',
     * 'event' => array(
     * 'time' => '1429294463',
     * 'name' => 'Frisbee with friends',
     * 'location' => 'Dolores Park',
     * 'latitude' => '37.759773',
     * 'longitude' => '-122.427063',),
     * 'product_id' => 'a1111c8c-c720-46c3-8534-2fcdd730040d',
     * 'trip_branding' => array(
     * 'link_text' => 'View team roster',
     * 'partner_deeplink' => 'partner://team/9383',)
     */
    public function createReminder(array $attributes = [])
    {
        $reminder = $this->uberSdk->createReminder($attributes);
        return $reminder;
    }

    /**
     * @param $reminderId
     * @return mixed
     */
    public function getReminder($reminderId)
    {
        $reminder = $this->uberSdk->getReminder($reminderId);

        return $reminder;
    }

    /**
     * @param $reminderId
     * @param array $attributes
     * array(
     * 'reminder_time' => '1429294463',
     * 'phone_number' => '555-555-5555',
     * 'event' => array(
     * 'time' => '1429294463',
     * 'name' => 'Frisbee with friends',
     * 'location' => 'Dolores Park',
     * 'latitude' => '37.759773',
     * 'longitude' => '-122.427063',
     * ),
     * 'product_id' => 'a1111c8c-c720-46c3-8534-2fcdd730040d',
     * 'trip_branding' => array(
     * 'link_text' => 'View team roster',
     * 'partner_deeplink' => 'partner://team/9383',
     * ))
     */
    public function updateReminder($reminderId, array $attributes = [])
    {
        $reminder = $this->uberSdk->setReminder($reminderId, $attributes);
        return $reminder;
    }

    /**
     * @param $reminderId
     * @return mixed
     */
    public function cancelReminder($reminderId)
    {
        $reminder = $this->uberSdk->cancelReminder($reminderId);
        return $reminder;
    }

    /**
     * @param $productId
     * @return array
     */
    public function rateLimiting($productId): array
    {
        $product = $this->uberSdk->getProduct($productId);
        $rateLimit = $this->uberSdk->getRateLimit();
        return ["limit" => $rateLimit->getLimit(), "remaining" => $rateLimit->getRemaining(), "reset" => $rateLimit->getReset()];
    }

    /**
     * @param $product_id
     * @param $start_latitude
     * @param $start_longitude
     * @param $end_latitude
     * @param $end_longitude
     * @param string $status
     * @return mixed
     */
    public function modifyOngoingStatusRequestSandbox($product_id, $start_latitude, $start_longitude, $end_latitude,
                                                      $end_longitude, string $status = 'accepted')
    {
        $request = $this->uberSdk->requestRide(array(
            'product_id' => $product_id,
            'start_latitude' => $start_latitude,
            'start_longitude' => $start_longitude,
            'end_latitude' => $end_latitude,
            'end_longitude' => $end_longitude,
        ));

        $updateRequest = $this->uberSdk->setSandboxRequest($request->request_id, array('status' => $status));

        return $updateRequest;
    }
}
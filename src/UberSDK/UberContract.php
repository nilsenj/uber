<?php

namespace nilsenj\Uber;


use Stevenmaguire\Uber\Client;

/**
 * Interface UberContract
 * @package nilsenj\Uber
 */
interface UberContract
{
    /**
     * @return Client
     */
    public function getUberSdk(): Client;

    /**
     * @param $latitude
     * @param $longitude
     * @return \Stevenmaguire\Uber\stdClass
     */
    public function getByLocation($latitude, $longitude);

    /**
     * @param $productId
     * @return \Stevenmaguire\Uber\stdClass
     */
    public function getById($productId);

    /**
     * @param $start_latitude
     * @param $start_longitude
     * @param $end_latitude
     * @param $end_longitude
     * @return \Stevenmaguire\Uber\stdClass
     */
    public function getPriceEstimates($start_latitude, $start_longitude, $end_latitude, $end_longitude);

    /**
     * @param $start_latitude
     * @param $start_longitude
     * @return \Stevenmaguire\Uber\stdClass
     */
    public function getTimeEstimates($start_latitude, $start_longitude);

    /**
     * @param $start_latitude
     * @param $start_longitude
     * @param $end_latitude
     * @param $end_longitude
     * @return \Stevenmaguire\Uber\stdClass
     */
    public function getPromotions($start_latitude, $start_longitude, $end_latitude, $end_longitude);

    /**
     * @return \Stevenmaguire\Uber\stdClass
     */
    public function getUserActivity();

    /**
     * @return \Stevenmaguire\Uber\stdClass
     */
    public function getUserProfile();

    /**
     * @param array $attributes
     * @return mixed
     */
    public function updateUserProfile(array $attributes = []);

    /**
     * @return mixed
     */
    public function getPaymentMethods();

    /**
     * @param string $placeId
     * @return mixed
     */
    public function getPlace(string $placeId);

    /**
     * @param string $placeId
     * @param array $attributes
     * @return mixed
     */
    public function updatePlace(string $placeId, array $attributes = []);

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
                                  $product_id = null, $surge_confirmation_id = null, $payment_method_id = null);

    /**
     * @return mixed
     */
    public function getCurrentRideDetails();

    /**
     * @param $requestId
     * @return \Stevenmaguire\Uber\stdClass
     */
    public function getRideDetails($requestId);

    /**
     * @param $end_address
     * @param $end_nickname
     * @param $end_place_id
     * @param $end_latitude
     * @param $end_longitude
     * @return mixed
     */
    public function updateCurrentRideDetails($end_address, $end_nickname, $end_place_id,
                                             $end_latitude, $end_longitude);

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
                                      $end_latitude, $end_longitude);

    /**
     * @param $product_id
     * @param $start_latitude
     * @param $start_longitude
     * @param $end_latitude
     * @param $end_longitude
     * @return mixed
     */
    public function getRideEstimate($product_id, $start_latitude, $start_longitude, $end_latitude, $end_longitude);

    /**
     * @param $requestId
     * @return \Stevenmaguire\Uber\stdClass
     */
    public function getRideMap($requestId);

    /**
     * @param $requestId
     * @return mixed
     */
    public function getRideReceipt($requestId);

    /**
     * @param $requestId
     * @return \Stevenmaguire\Uber\stdClass
     */
    public function cancelRide($requestId);

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
    public function createReminder(array $attributes = []);

    /**
     * @param $reminderId
     * @return mixed
     */
    public function getReminder($reminderId);

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
    public function updateReminder($reminderId, array $attributes = []);

    /**
     * @param $reminderId
     * @return mixed
     */
    public function cancelReminder($reminderId);

    /**
     * @param $productId
     * @return array
     */
    public function rateLimiting($productId): array;

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
                                                      $end_longitude, string $status = 'accepted');
}
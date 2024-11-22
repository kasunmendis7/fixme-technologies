<?php

namespace app\controllers;

use app\core\Controller;

class GeocodingController extends Controller
{

    public function getLatLngFromAddress($address)
    {
        $API_KEY = "AIzaSyBCGNUZAUhEzeW8LeV_j3deW44jsA9hWY0";
        $geocodingUrl = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($address) . "&key=$API_KEY";

        $response = file_get_contents($geocodingUrl);
        $data = json_decode($response, true);

        if ($data['status'] === 'OK') {
            $location = $data['results'][0]['geometry']['location'];
            return [
                'lat' => $location['lat'],
                'lng' => $location['lng']
            ];
        } else {
            return null;
        }
    }
}
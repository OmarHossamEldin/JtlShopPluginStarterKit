<?php

namespace Plugin\TecseeHotelBooking\Src\Exceptions;

class RouteNotFoundException extends \Exception
{
    protected $message = "This route is not found";
}

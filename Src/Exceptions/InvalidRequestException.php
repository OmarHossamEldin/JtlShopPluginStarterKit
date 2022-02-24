<?php

namespace Plugin\TecseeHotelBooking\Src\Exceptions;

class InvalidRequestException extends \Exception
{
    protected $message = "this request is not found";
}

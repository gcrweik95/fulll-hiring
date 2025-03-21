<?php

namespace App\Domain\Exception;

class FleetNotFoundException extends \Exception
{
    public function __construct(string $message = "Fleet not found.")
    {
        parent::__construct($message);
    }
}

<?php

namespace Fulll\App\Handler;

use Fulll\App\Command\FleetRegisterVehicleCommand;
use Fulll\Domain\Exception\VehicleAlreadyRegisteredException;
use Fulll\Domain\Model\Fleet;
use Fulll\Domain\Model\Vehicle;
use Fulll\Domain\Repository\FleetRepositoryInterface;
use Fulll\Domain\Repository\VehicleRepositoryInterface;
use Fulll\Domain\Service\VehicleService;

class RegisterVehicleHandler
{
    private VehicleService $vehicleService;

    public function __construct()
    {
        $this->vehicleService = new VehicleService();
    }

    public function handle(FleetRegisterVehicleCommand $command): void
    {
        
    }
}

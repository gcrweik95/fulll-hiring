<?php

namespace App\Domain\Service;

use App\Infra\Persistence\FleetRepository;
use App\Infra\Persistence\LocationRepository;
use App\Infra\Persistence\VehicleRepository;
use App\Domain\Exception\FleetNotFoundException;
use App\Domain\Exception\VehicleAlreadyParkedAtLocationException;
use App\Domain\Exception\VehicleAlreadyRegisteredException;
use App\Domain\Model\Location;
use App\Domain\Model\Vehicle;

class VehicleService
{
    public function __construct(
        private readonly FleetRepository $fleetRepository,
        private readonly VehicleRepository $vehicleRepository,
        private readonly LocationRepository $locationRepository
    ) {}

    public function create(string $licensePlate): Vehicle
    {
        $vehicle = $this->vehicleRepository->findByLicensePlate($licensePlate);
        if (!$vehicle) {
            $vehicle = new Vehicle($licensePlate);
            $this->vehicleRepository->save($vehicle);
        }
        return $vehicle;
    }

    public function registerVehicle(string $fleetId, string $licensePlate): Vehicle
    {
        $fleet = $this->fleetRepository->findById($fleetId);
        if (!$fleet) {
            throw new FleetNotFoundException();
        }

        $vehicle = $this->vehicleRepository->findByLicensePlate($licensePlate);
        if (!$vehicle) {
            $vehicle = new Vehicle($licensePlate);
            $this->vehicleRepository->save($vehicle);
        }

        if ($this->fleetRepository->findByFleetAndVehicle($fleet, $vehicle)) {
            throw new VehicleAlreadyRegisteredException();
        }

        $fleet->addVehicle($vehicle);
        $this->fleetRepository->save($fleet);

        return $vehicle;
    }

    public function parkVehicle(string $fleetId, string $licensePlate, float $lat, float $lng): Location
    {
        $fleet = $this->fleetRepository->findById($fleetId);
        if (!$fleet) {
            throw new FleetNotFoundException();
        }

        $vehicle = $this->vehicleRepository->findByLicensePlate($licensePlate);
        $vehicleLocation = $vehicle->getLocation();
        if ($vehicleLocation && $vehicleLocation->equals(new Location($lat, $lng))) {
            throw new VehicleAlreadyParkedAtLocationException();
        }

        $location = new Location($lat, $lng);
        $location->setVehicle($vehicle);
        $vehicle->setLocation($location);

        $this->vehicleRepository->save($vehicle);
        $this->locationRepository->save($location);
        return $location;
    }

    public function reset(): void
    {
        $this->vehicleRepository->reset();
        $this->locationRepository->reset();
    }
}

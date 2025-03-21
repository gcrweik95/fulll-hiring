<?php

namespace App\Domain\Service;

use App\Domain\Model\Fleet;
use App\Domain\Model\Vehicle;
use App\Infra\Persistence\FleetRepository;

class FleetService
{
    public function __construct(
        private readonly FleetRepository $fleetRepository
    ) {}

    public function create(string $fleetId): Fleet
    {
        $fleet = $this->fleetRepository->findById($fleetId);
        if (!$fleet) {
            $fleet = new Fleet($fleetId);
            $this->fleetRepository->save($fleet);
        }
        return $fleet;
    }

    public function fleetHasVehicle(Fleet $aFleet, Vehicle $aVehicle): bool
    {
        return $this->fleetRepository->findByFleetAndVehicle($aFleet, $aVehicle);
        return true;
    }
}

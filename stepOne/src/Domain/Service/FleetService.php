<?php

namespace Fulll\Domain\Service;

use Fulll\Domain\Model\Fleet;
use Fulll\Domain\Model\Vehicle;
use Fulll\Infra\Persistence\InMemoryFleetRepository;

class FleetService
{
    private InMemoryFleetRepository $fleetRepository;

    public function __construct(InMemoryFleetRepository $fleetRepository)
    {
        $this->fleetRepository = $fleetRepository;
    }

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

    public function reset(): void
    {
        $this->fleetRepository->reset();
    }
}

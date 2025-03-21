<?php

namespace App\App\Handler;

use App\App\Command\CreateFleetCommand;
use App\Domain\Model\Fleet;
use App\Domain\Service\FleetService;

class CreateFleetHandler
{
    public function __construct(
        private readonly FleetService $fleetService
    ) {}
    public function handle(CreateFleetCommand $command): Fleet
    {
        $fleet = $this->fleetService->create($command->getFleetId());
        return $fleet;
    }
}

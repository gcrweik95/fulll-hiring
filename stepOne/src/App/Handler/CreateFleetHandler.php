<?php

namespace Fulll\App\Handler;

use Fulll\App\Command\CreateFleetCommand;
use Fulll\Domain\Model\Fleet;
use Fulll\Domain\Repository\FleetRepositoryInterface;
use Fulll\Domain\Service\FleetService;

class CreateFleetHandler
{
    private FleetService $fleetService;
    public function __construct()
    {
        $this->fleetService = new FleetService();
    }
    public function handle(CreateFleetCommand $command): Fleet
    {
        $fleet = $this->fleetService->create($command->getFleetId());
        return $fleet;
    }
}

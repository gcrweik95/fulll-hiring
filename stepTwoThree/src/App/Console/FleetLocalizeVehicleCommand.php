<?php

namespace App\App\Console;

use App\App\Command\ParkVehicleCommand;
use App\App\Handler\ParkVehicleHandler;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'fleet:localize-vehicle',
    description: 'Localizes a vehicle',
)]
class FleetLocalizeVehicleCommand extends Command
{
    public function __construct(private readonly ParkVehicleHandler $handler)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('fleet:localize-vehicle')
            ->setDescription('Localizes a vehicle')
            ->addArgument('fleetId', InputArgument::REQUIRED, 'Fleet ID')
            ->addArgument('vehiclePlateNumber', InputArgument::REQUIRED, 'Vehicle Plate Number')
            ->addArgument('lat', InputArgument::REQUIRED, 'Location Latitude')
            ->addArgument('lng', InputArgument::REQUIRED, 'Location Longitude')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $vehiclePlateNumber = $input->getArgument('vehiclePlateNumber');
        $fleetId = $input->getArgument('fleetId');
        $lat = $input->getArgument('lat');
        $lng = $input->getArgument('lng');

        $io->note(sprintf(
            'Registering a vehicle with plate number "%s" in a fleet with an ID "%s" in a location with the following coordinates (Latitude: %01.2f, Longitude: %01.2f)',
            $vehiclePlateNumber,
            $fleetId,
            $lat,
            $lng
        ));

        try {
            $command = new ParkVehicleCommand($fleetId, $vehiclePlateNumber, $lat, $lng);
            $this->handler->handle($command);

            $io->success('Your vehicle has been localized in the identified fleet and location!');
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }
    }
}

<?php

namespace App\Domain\Repository;

use App\Domain\Model\Fleet;

interface FleetRepositoryInterface
{
    public function findById(string $id): ?Fleet;

    public function save(Fleet $fleet): void;
}

<?php

namespace App\Domain\Service\Test;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Connection;

class DatabaseEmptyService
{
    private EntityManagerInterface $entityManager;
    private Connection $connection;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->connection = $this->entityManager->getConnection();
    }

    public function emptyDB(): void
    {
        $this->connection->executeQuery('SET FOREIGN_KEY_CHECKS = 0');

        $metadatas = $this->entityManager->getMetadataFactory()->getAllMetadata();

        foreach ($metadatas as $metadata) {
            $tableName = $metadata->table['name'];
            $this->connection->executeQuery("TRUNCATE TABLE $tableName");
        }

        $this->connection->executeQuery('SET FOREIGN_KEY_CHECKS = 1');
    }
}

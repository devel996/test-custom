<?php

declare(strict_types=1);

namespace app\application\interfaces;

/**
 * I will not add migrations table
 */
interface MigrationInterface
{
    public function migrate(): void;
}
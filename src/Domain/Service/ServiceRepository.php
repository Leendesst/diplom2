<?php
declare(strict_types=1);

namespace App\Domain\Service;

interface ServiceRepository
{
    /**
     * @return Service[]
     */
    public function find(?int $max=10, ?int $offset=0): array;

    /**
     * @param int $id
     * @return Service
     * @throws ServiceNotFoundException
     */
    public function findServiceOfId(int $id): Service;
}

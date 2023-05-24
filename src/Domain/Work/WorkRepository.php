<?php
declare(strict_types=1);

namespace App\Domain\Work;

interface WorkRepository
{
    /**
     * @return Work[]
     */
    public function find(?int $max=10, ?int $offset=0): array;

    /**
     * @param int $id
     * @return Work
     * @throws WorkNotFoundException
     */
    public function findWorkOfId(int $id): Work;
}

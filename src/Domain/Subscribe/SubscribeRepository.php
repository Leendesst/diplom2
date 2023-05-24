<?php
declare(strict_types=1);

namespace App\Domain\Subscribe;

interface SubscribeRepository
{
    /**
     * @return int
     */
    public function subscribe($name, $phone, $auto_mark, $auto_vin, $auto_number, $works): int;
}

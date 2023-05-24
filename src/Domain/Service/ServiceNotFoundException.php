<?php
declare(strict_types=1);

namespace App\Domain\Service;

use App\Domain\DomainException\DomainRecordNotFoundException;

class ServiceNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The service you requested does not exist.';
}

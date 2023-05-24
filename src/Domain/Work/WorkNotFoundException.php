<?php
declare(strict_types=1);

namespace App\Domain\Work;

use App\Domain\DomainException\DomainRecordNotFoundException;

class WorkNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The work you requested does not exist.';
}

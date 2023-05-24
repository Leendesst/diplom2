<?php
declare(strict_types=1);

namespace App\Application\Actions\Service;

use App\Application\Actions\Action;
use App\Domain\Service\ServiceRepository;
use Psr\Log\LoggerInterface;

abstract class ServiceAction extends Action {
    /**
     * @var ServiceRepository
     */
    protected $serviceRepository;

    /**
     * @param LoggerInterface $logger
     * @param ServiceRepository $serviceRepository
     */
    public function __construct(LoggerInterface $logger, ServiceRepository $serviceRepository) {
        parent::__construct($logger);
        $this->serviceRepository = $serviceRepository;
    }
}

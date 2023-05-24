<?php
declare(strict_types=1);

namespace App\Application\Actions\Work;

use App\Application\Actions\Action;
use App\Domain\Work\WorkRepository;
use Psr\Log\LoggerInterface;

abstract class WorkAction extends Action {
    /**
     * @var WorkRepository
     */
    protected $workRepository;

    /**
     * @param LoggerInterface $logger
     * @param WorkRepository $workRepository
     */
    public function __construct(LoggerInterface $logger, WorkRepository $workRepository) {
        parent::__construct($logger);
        $this->workRepository = $workRepository;
    }
}

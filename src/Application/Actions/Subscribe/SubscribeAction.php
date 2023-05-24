<?php
declare(strict_types=1);

namespace App\Application\Actions\Subscribe;

use App\Application\Actions\Action;
use App\Domain\Subscribe\SubscribeRepository;
use Psr\Log\LoggerInterface;

abstract class SubscribeAction extends Action {
    /**
     * @var SubscribeRepository
     */
    protected $subscribeRepository;

    /**
     * @param LoggerInterface $logger
     * @param SubscribeRepository $requestRepository
     */
    public function __construct(LoggerInterface $logger, SubscribeRepository $requestRepository) {
        parent::__construct($logger);
        $this->subscribeRepository = $requestRepository;
    }
}

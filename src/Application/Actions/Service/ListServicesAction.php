<?php
declare(strict_types=1);

namespace App\Application\Actions\Service;

use Psr\Http\Message\ResponseInterface as Response;

class ListServicesAction extends ServiceAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $services = $this->serviceRepository->find();

        // $this->logger->info("Services list was viewed.");

        return $this->respondWithData($services);
    }
}

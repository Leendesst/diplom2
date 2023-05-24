<?php
declare(strict_types=1);

namespace App\Application\Actions\Work;

use Psr\Http\Message\ResponseInterface as Response;

class ListWorksAction extends WorkAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $works = $this->workRepository->find();

        # $this->logger->info("Users list was viewed.");

        return $this->respondWithData($works);
    }
}

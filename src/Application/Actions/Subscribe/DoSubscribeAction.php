<?php
declare(strict_types=1);

namespace App\Application\Actions\Subscribe;

use Psr\Http\Message\ResponseInterface as Response;

class DoSubscribeAction extends SubscribeAction {
    /**
     * {@inheritdoc}
     */
    protected function action(): Response {

        $parms = $this->request->getParsedBody();

        $name        = $parms["name"] ?? null;
        $phone       = $parms["phone"] ?? null;
        $auto_mark   = $parms["auto_mark"] ?? null;
        $auto_vin    = $parms["auto_vin"] ?? null;
        $auto_number = $parms["auto_number"] ?? null;
        $work        = $parms["work"] ?? null;

        $id = $this->subscribeRepository->subscribe($name, $phone, $auto_mark, $auto_vin, $auto_number, $work);

        # $this->logger->info("Users list was viewed.");

        return $this->respondWithData([
            'id' => $id
        ]);
    }
}

<?php
declare(strict_types=1);

use App\Application\Actions\Service\ListServicesAction;
use App\Application\Actions\Work\ListWorksAction;
use App\Application\Actions\Subscribe\DoSubscribeAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Subscribe Handler
        return $response;
    });
    /*
    $app->get('/', function (Subscribe $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });
    */
    $app->group('/api/services', function (Group $group) {
        $group->get('', ListServicesAction::class);
        // $group->get('/{id}', ViewUserAction::class);
    });

    $app->group('/api/works', function (Group $group) {
        $group->get('', ListWorksAction::class);
        // $group->get('/{id}', ViewUserAction::class);
    });

    $app->group('/api/subscribe', function (Group $group) {
        $group->post('', DoSubscribeAction::class);
        // $group->get('/{id}', ViewUserAction::class);
    });
};

<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use App\Models\Entity\Modulo as Modulo;

require './bootstrap.php';

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

/**
 * Lista de todos os aplicativos
 */
$app->get('/modulo', function (Request $request, Response $response) use ($app) {
    $entityManager = $this->get('em');
    $modulosRepository = $entityManager->getRepository('App\Models\Entity\Modulo');
    $modulos = $modulosRepository->findAll();

    return $response->withJson($modulos, 200)
                    ->withHeader('Content-type', 'application/json');
});

/**
 * Retornando mais informações do aplicativo informado pelo id
 */
$app->get('/modulo/{id}', function (Request $request, Response $response) use ($app) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');

    $entityManager = $this->get('em');
    $modulosRepository = $entityManager->getRepository('App\Models\Entity\Modulo');
    $modulo = $modulosRepository->find($id);

    return $response->withJson($modulo, 200)
                    ->withHeader('Content-type', 'application/json');
});

/**
 * Cadastra um novo aplicativo
 */
$app->post('/modulo', function (Request $request, Response $response) use ($app) {
    $params = (object) $request->getParams();
    $entityManager = $this->get('em');

    $modulo = (new Modulo())->setNome($params->nome)
                            ->setTipoPagamento($params->tipo_pagamento)
                            ->setStatus($params->status)
                            ->setTipo($params->tipo)
                            ->setIcone($params->icone);

    $entityManager->persist($modulo);
    $entityManager->flush();

    return $response->withJson($modulo, 201)
                    ->withHeader('Content-type', 'application/json');
});

/**
 * Atualiza os dados de um aplicativo
 */
$app->put('/modulo/{id}', function (Request $request, Response $response) use ($app) {
    $params = (object) $request->getParams();
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');

    $entityManager = $this->get('em');
    $modulosRepository = $entityManager->getRepository('App\Models\Entity\Modulo');
    $modulo = $modulosRepository->find($id);

    $modulo->setNome($params->nome)
            ->setTipoPagamento($params->tipo_pagamento)
            ->setStatus($params->status)
            ->setTipo($params->tipo)
            ->setIcone($params->icone);

    $entityManager->persist($modulo);
    $entityManager->flush();

    return $response->withJson($modulo, 200)
                    ->withHeader('Content-type', 'application/json');
});

/**
 * Deleta o aplicativo informado pelo ID
 */
$app->delete('/modulo/{id}', function (Request $request, Response $response) use ($app) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');

    $entityManager = $this->get('em');
    $modulosRepository = $entityManager->getRepository('App\Models\Entity\Modulo');
    $modulo = $modulosRepository->find($id);

    $entityManager->remove($modulo);
    $entityManager->flush();

    return $response->withJson(['msg' => "Deletando o aplicativo {$id}"], 204)
                    ->withHeader('Content-type', 'application/json');
});

$app->run();
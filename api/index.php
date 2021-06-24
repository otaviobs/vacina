<?php

use App\Models\Entity\Paciente;
use App\Models\Entity\Vacina;
use App\Models\Entity\VacinaPaciente;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'bootstrap.php';

/* ---------- VACINA ---------- */

$app->get('/vacina', function (Request $request, Response $response) use ($app) {

    $entityManager = $this->get('em');
    $vacinasRepository = $entityManager->getRepository('App\Models\Entity\Vacina');
    $vacinas = $vacinasRepository->findAll();

    $return = $response->withJson($vacinas, 200)
        ->withHeader('Content-type', 'application/json');
    return $return;
});

$app->get('/vacina/{id}', function (Request $request, Response $response) use ($app) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');

    $entityManager = $this->get('em');
    $vacinasRepository = $entityManager->getRepository('App\Models\Entity\Vacina');
    $vacina = $vacinasRepository->find($id);

    $return = $response->withJson($vacina, 200)
        ->withHeader('Content-type', 'application/json');
    return $return;
});

$app->post('/vacina', function (Request $request, Response $response) use ($app) {

    $params = (object) $request->getParams();
    $entityManager = $this->get('em');

    $d = new DateTime($params->dataValidade);
    if($d && $d->format('Y-m-d') == $params->dataValidade)
    {
        $vacina = (new Vacina())->setLote($params->lote)
                ->setNDoses($params->nDoses)
                ->setIntervalo($params->intervalo)
                ->setFabricante($params->fabricante)
                ->setDataValidade($d);
                
        $entityManager->persist($vacina);
        $entityManager->flush();

        $return = $response->withJson($vacina, 201)
            ->withHeader('Content-type', 'application/json');
    }
    else{
        $vacina = 'Data de validade inválida';
        $return = $response->withJson($vacina, 400)
        ->withHeader('Content-type', 'application/json');
    }
        

    
    return $return;
});

$app->put('/vacina/{id}', function (Request $request, Response $response) use ($app) {

    $params = (object) $request->getParams();
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');

    $entityManager = $this->get('em');
    $vacinasRepository = $entityManager->getRepository('App\Models\Entity\Vacina');
    $vacina = $vacinasRepository->find($id);   

    $d = new DateTime($params->dataValidade);
    if($d && $d->format('Y-m-d') == $params->dataValidade)
    {
        $vacina->setLote($params->lote)
                ->setNDoses($params->nDoses)
                ->setIntervalo($params->intervalo)
                ->setFabricante($params->fabricante)
                ->setDataValidade($d);

        $entityManager->persist($vacina);
        $entityManager->flush();        

        $return = $response->withJson($vacina, 200)
            ->withHeader('Content-type', 'application/json');
    }
    else{
        $vacina = 'Data de validade inválida';
        $return = $response->withJson($vacina, 400)
            ->withHeader('Content-type', 'application/json');
    } 
    
    return $return;
});

$app->delete('/vacina/{id}', function (Request $request, Response $response) use ($app) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');

    $entityManager = $this->get('em');
    $vacinasRepository = $entityManager->getRepository('App\Models\Entity\Vacina');
    $vacina = $vacinasRepository->find($id);    

    $entityManager->remove($vacina);
    $entityManager->flush(); 

    $return = $response->withJson(['msg' => "Vacina deletado - {$id}"], 204)
        ->withHeader('Content-type', 'application/json');
    return $return;
});



/* --------------- PACIENTE -------------------- */

$app->get('/paciente', function (Request $request, Response $response) use ($app) {

    $entityManager = $this->get('em');
    $pacientesRepository = $entityManager->getRepository('App\Models\Entity\Paciente');
    $pacientes = $pacientesRepository->findAll();

    $return = $response->withJson($pacientes, 200)
        ->withHeader('Content-type', 'application/json');
    return $return;
});

$app->get('/paciente/{id}', function (Request $request, Response $response) use ($app) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');

    $entityManager = $this->get('em');
    $pacientesRepository = $entityManager->getRepository('App\Models\Entity\Paciente');
    $paciente = $pacientesRepository->find($id);

    $return = $response->withJson($paciente, 200)
        ->withHeader('Content-type', 'application/json');
    return $return;
});

$app->post('/paciente', function (Request $request, Response $response) use ($app) {

    $params = (object) $request->getParams();
    $entityManager = $this->get('em');

    $dataNascimento = new DateTime($params->dataNascimento);
    if($dataNascimento && $dataNascimento->format('Y-m-d') == $params->dataNascimento)
    {
        $paciente = (new Paciente())->setNome($params->nome)
                ->setDataNascimento($dataNascimento)
                ->setCpf($params->cpf)
                ->setTelefone($params->telefone)
                ->setEmail($params->email)
                ->setRua($params->rua)
                ->setNumero($params->numero)
                ->setBairro($params->bairro)
                ->setCidade($params->cidade)
                ->setEstado($params->estado);
                
        $entityManager->persist($paciente);
        $entityManager->flush();
    
        $return = $response->withJson($paciente, 200)
        ->withHeader('Content-type', 'application/json');
    }
    else{
        $paciente = 'Data de nascimento inválida';
        $return = $response->withJson($paciente, 400)
            ->withHeader('Content-type', 'application/json');
    }

    return $return;
});

$app->put('/paciente/{id}', function (Request $request, Response $response) use ($app) {

    $params = (object) $request->getParams();
    
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');

    $entityManager = $this->get('em');
    $pacientesRepository = $entityManager->getRepository('App\Models\Entity\Vacina');
    $paciente = $pacientesRepository->find($id);   

    $dataNascimento = new DateTime($params->dataNascimento);
    if($dataNascimento && $dataNascimento->format('Y-m-d') == $params->dataNascimento)
    {
        $paciente = (new Paciente())->setNome($params->nome)
                ->setDataNascimento($dataNascimento)
                ->setCpf($params->cpf)
                ->setTelefone($params->telefone)
                ->setEmail($params->email)
                ->setRua($params->rua)
                ->setNumero($params->numero)
                ->setBairro($params->bairro)
                ->setCidade($params->cidade)
                ->setEstado($params->estado);

        $entityManager->persist($paciente);
        $entityManager->flush();        
    }
    else $paciente = 'nok';
    
    $return = $response->withJson($paciente, 200)
        ->withHeader('Content-type', 'application/json');
    return $return;
});

$app->delete('/paciente/{id}', function (Request $request, Response $response) use ($app) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');

    $entityManager = $this->get('em');
    $pacientesRepository = $entityManager->getRepository('App\Models\Entity\Vacina');
    $paciente = $pacientesRepository->find($id);    

    $entityManager->remove($paciente);
    $entityManager->flush(); 

    $return = $response->withJson(['msg' => "Paciente deletado - {$id}"], 204)
        ->withHeader('Content-type', 'application/json');
    return $return;
});


/* --------------- VACINA PACIENTE -------------------- */

$app->get('/vacina-paciente', function (Request $request, Response $response) use ($app) {

    $entityManager = $this->get('em');
    $vacinaPacientesRepository = $entityManager->getRepository('App\Models\Entity\VacinaPaciente');
    $vacinaPacientes = $vacinaPacientesRepository->findAll();

    $return = $response->withJson($vacinaPacientes, 200)
        ->withHeader('Content-type', 'application/json');
    return $return;
});

$app->get('/vacina-paciente/{id}', function (Request $request, Response $response) use ($app) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');

    $entityManager = $this->get('em');
    $vacinaPacientesRepository = $entityManager->getRepository('App\Models\Entity\VacinaPaciente');
    $vacinaPaciente = $vacinaPacientesRepository->find($id);

    $return = $response->withJson($vacinaPaciente, 200)
        ->withHeader('Content-type', 'application/json');
    return $return;
});

$app->post('/vacina-paciente', function (Request $request, Response $response) use ($app) {
    $params = (object) $request->getParams();
    $entityManager = $this->get('em');

    $dataVacinacao = new DateTime($params->dataVacinacao);
    if($dataVacinacao && $dataVacinacao->format('Y-m-d') == $params->dataVacinacao)
    {
        $vacinaPaciente = (new VacinaPaciente($params->idVacina, $params->idPaciente))
                ->setDataVacinacao($dataVacinacao)
                ->setIdDose($params->idDose)
                ->setControleDose($params->controleDose);
                
        $entityManager->persist($vacinaPaciente);
        $entityManager->flush();
    }
    else $vacinaPaciente = 'nok';
        

    $return = $response->withJson($vacinaPaciente, 201)
        ->withHeader('Content-type', 'application/json');
    return $return;
});

$app->put('/vacina-paciente/{id}', function (Request $request, Response $response) use ($app) {

    $params = (object) $request->getParams();
    
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');

    $entityManager = $this->get('em');
    $vacinaPacientesRepository = $entityManager->getRepository('App\Models\Entity\VacinaPaciente');
    $vacinaPaciente = $vacinaPacientesRepository->find($id);   

    $dataVacinacao = new DateTime($params->dataVacinacao);
    if($dataVacinacao && $dataVacinacao->format('Y-m-d') == $params->dataVacinacao)
    {
        $vacinaPaciente = (new VacinaPaciente())
                ->setDataVacinacao($dataVacinacao)
                ->setIdPaciente($params->idPaciente)
                ->setIdVacina($params->idVacina)
                ->setIdDose($params->idDose)
                ->setControleDose($params->controleDose);
                
        $entityManager->persist($vacinaPaciente);
        $entityManager->flush();
    }
    else $paciente = 'nok';
    
    $return = $response->withJson($vacinaPaciente, 200)
        ->withHeader('Content-type', 'application/json');
    return $return;
});
/*
$app->delete('/vacina-paciente/{id}', function (Request $request, Response $response) use ($app) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');

    $entityManager = $this->get('em');
    $vacinaPacientesRepository = $entityManager->getRepository('App\Models\Entity\VacinaPaciente');
    $vacinaPaciente = $vacinaPacientesRepository->find($id);    

    $entityManager->remove($vacinaPaciente);
    $entityManager->flush(); 

    $return = $response->withJson(['msg' => "Vacina no Paciente deletado - {$id}"], 204)
        ->withHeader('Content-type', 'application/json');
    return $return;
});
*/

$app->run();
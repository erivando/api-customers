<?php

namespace App\Controllers;

use App\DAO\CustomerDAO;
use App\Models\CustomerModels;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class CustomersController{

    public function getCustomers(Request $request, Response $response, array $args): Response{
        $customerDAO = new CustomerDAO();
        $customer = $customerDAO->listaVarios();
        $response = $response->withJson($customer);
        return $response;
    }

    public function insertCustomers(Request $request, Response $response, array $args): Response{
        $data = $request->getParsedBody();

        
        try {
            if(trim($data['nome']) === '' || !is_string($data['nome'])){
                throw new \InvalidArgumentException("Não foi possivel enviar o dado, ou não foi preenchido ou não é uma string");
            }
            if(trim($data['cpf']) === '' || !is_string($data['cpf'])){
                throw new \InvalidArgumentException("Não foi possivel enviar o dado, ou não foi preenchido ou não é uma string");
            }
            if(trim($data['dtNascimento']) === '' || !is_string($data['dtNascimento'])){
                throw new \InvalidArgumentException("Não foi possivel enviar o dado, ou não foi preenchido ou não é uma string");
            }
            $customerDAO = new CustomerDAO();
            $customerModel = new CustomerModels();
            $customerModel->setNome($data['nome'])
                ->setCpf($data['cpf'])
                ->setDtNascimento($data['dtNascimento']);
            $customerDAO->inseriCustomer($customerModel);

            $response = $response->withJson([
                'status' => 200,
                'msg' => 'Inserido com sucesso!!'
            ], 200);
            return $response;
        } catch (\InvalidArgumentException $ex) {
            return  $response->withJson([
                'error' => \InvalidArgumentException::class,
                'status' => 400,
                'userMessage' => 'Verifique se todos os campos foram preenchidos.',
                'devMessage' => $ex->getMessage()
            ], 400);
        }
    }

    public function listaCustomer(Request $request, Response $response, array $args): Response{
        $idParam = $request->getAttribute('route')->getArgument('id');
        try {
            if(!is_numeric($idParam)){
                throw new \InvalidArgumentException("Não foi encontrado o que vc procura.");
            }
            $id = (int)$idParam;
            $customerDAO = new CustomerDAO();
            $lista = $customerDAO->listaCustomer($id);
            if(sizeof($lista) === 0){
                throw new \InvalidArgumentException("Nenhum resgistro encontrado.");
            }
            $response = $response->withJson($lista);
            return $response;
        } catch (\InvalidArgumentException | \Throwable $ex) {
            return  $response->withJson([
                'error' => InvalidArgumentException::class,
                'status' => 500,
                'userMessage' => 'Ficou faltando uma coisa.',
                'devMessage' => $ex->getMessage()
            ], 500);
        }
    }

    public function updateCustomers(Request $request, Response $response, array $args): Response{
        $idParam = $request->getAttribute('route')->getArgument('id');
        $data = $request->getParsedBody();
        try {
            if(!is_numeric($idParam)){
                throw new \InvalidArgumentException("Nenhum resgistro encontrado.");   
            }
            if(trim($data['nome']) === '' || !is_string($data['nome'])){
                throw new \InvalidArgumentException("Não foi possivel enviar o dado, ou não foi preenchido ou não é uma string");
            }
            if(trim($data['cpf']) === '' || !is_string($data['cpf'])){
                throw new \InvalidArgumentException("Não foi possivel enviar o dado, ou não foi preenchido ou não é uma string");
            }
            if(trim($data['dtNascimento']) === '' || !is_string($data['dtNascimento'])){
                throw new \InvalidArgumentException("Não foi possivel enviar o dado, ou não foi preenchido ou não é uma string");
            }
            $id = (int) $idParam;


            $customerDAO = new CustomerDAO();
            $customerModel = new CustomerModels();
            $lista = $customerDAO->listaCustomer($id);
            if(empty($lista)){
                throw new \InvalidArgumentException("Nenhum resgistro encontrado.");
                
            }
            $customerModel->setNome($data['nome'])
                ->setCpf($data['cpf'])
                ->setDtNascimento($data['dtNascimento']);
            $customerDAO->editaCustomer($customerModel, $id);

            $response = $response->withJson([
                "status" => 201,
                "msg" => "Editado com sucesso!!"
            ], 201);
            return $response;
        } catch (\InvalidArgumentException | \Throwable $ex) {
            return  $response->withJson([
                'error' => InvalidArgumentException::class,
                'status' => 500,
                'userMessage' => 'Ficou faltando uma coisa.',
                'devMessage' => $ex->getMessage()
            ], 500);
        }
        
    }

    public function atualizaCustomers(Request $request, Response $response, array $args): Response{
        $idParam = $request->getAttribute('route')->getArgument('id');
        try {
            if(!is_numeric($idParam)){
                throw new \InvalidArgumentException("Nenhum resgistro encontrado.");
                
            }
            $id = (int) $idParam;

            $data = $request->getParsedBody();
            
            $customerDAO = new CustomerDAO();
            $lista = $customerDAO->listaCustomer($id);

            if(empty($lista)){
                throw new \InvalidArgumentException("Nenhum resgistro encontrado.");
                
            }
            $customerModel = new CustomerModels();
            
            $customerDAO->atualizaCustomer($data, $id);

            $response = $response->withJson([
                "status" => 201,
                "msg" => "Atualizado com sucesso!!"
            ], 201);
            return $response;

        } catch (\InvalidArgumentException | \Throwable $ex) {
            return  $response->withJson([
                'error' => InvalidArgumentException::class,
                'status' => 500,
                'userMessage' => 'Ficou faltando uma coisa.',
                'devMessage' => $ex->getMessage()
            ], 500);
        }
    }

    public function deleteCustomers(Request $request, Response $response, array $args): Response{
        $idParam = $request->getAttribute('route')->getArgument('id');
        try {
            if(!is_numeric($idParam)){
                throw new \InvalidArgumentException("Error Processing Request");
            }
            $customerDAO = new CustomerDAO();
            $id = (int)$idParam;
            $customerDAO->deletaCustomer($id);
            $response = $response->withJson([
                "status" => 201,
                "msg" => "Id: {$id} deletado com sucesso!"
            ], 201);
            return $response;
        } catch (\InvalidArgumentException | \Throwable $ex) {
            return  $response->withJson([
                'error' => InvalidArgumentException::class,
                'status' => 500,
                'userMessage' => 'Ficou faltando uma coisa.',
                'devMessage' => $ex->getMessage()
            ], 500);
        }
    }
}
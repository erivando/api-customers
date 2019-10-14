<?php

namespace App\DAO;

use App\DAO\Conexao;
use App\Models\CustomerModels;

class CustomerDAO extends Conexao{

    public function __construct(){
        parent::__construct();
    }

    public function listaVarios(): array{
        $customer = $this->pdo->query("select * from customers")->fetchAll(\PDO::FETCH_ASSOC);
        return $customer;
    }

    public function listaCustomer(int $id): array{
        $stm = $this->pdo->prepare("select * from customers WHERE id = :id;");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->execute();
        $lista = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $lista;
    }

    public function inseriCustomer(CustomerModels $customer): void{
        $stm = $this->pdo->prepare(
            'INSERT INTO customers VALUES (null, :nome, :cpf, :dtNascimento);'
        );
        $stm->execute([
            'nome' => $customer->getNome(),
            'cpf' => $customer->getCpf(),
            'dtNascimento' => $customer->getDtNascimento()
        ]);
    }

    public function editaCustomer(CustomerModels $customer, int $id): void{
        $stm = $this->pdo->prepare(
            'UPDATE customers SET
                nome = :nome,
                cpf = :cpf,
                dtNascimento = :dtNascimento
            WHERE id = :id;
        ');
        $stm->execute([
            'nome' => $customer->getNome(),
            'cpf' => $customer->getCpf(),
            'dtNascimento' => $customer->getDtNascimento(),
            'id' => $id
        ]);
    }

    public function atualizaCustomer(array $dados, int $id): void{
        foreach($dados as $chave => $valor){
            $novoDado[] = $chave . "='" . $valor . "'";
        }
        $sql = "update customers set " . implode(', ', $novoDado)." where id = {$id};";
        
        $this->pdo->exec($sql);
    }

    public function deletaCustomer(int $id): void{
        $stm = $this->pdo->prepare(
            'DELETE FROM customers WHERE id = :id;'
        );
        $stm->execute([
            'id' => $id
        ]);
    }
}
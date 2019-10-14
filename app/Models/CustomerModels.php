<?php

namespace App\Models;

final class CustomerModels{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nome;

    /**
     * @var string
     */    
    private $cpf;

    /**
     * @var string
     */
    private $dtNascimento;

    /**
     * Get the value of id
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return CustomerModel
     */
    public function setNome(string $nome): CustomerModels
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of cpf
     */ 
    public function getCpf(): string
    {
        return $this->cpf;
    }

    /**
     * @param string $cpf
     * @return CustomerModel
     */
    public function setCpf(string $cpf): CustomerModels
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Get the value of dtNascimento
     */ 
    public function getDtNascimento(): string
    {
        return $this->dtNascimento;
    }

    /**
     * @param  string  $dtNascimento
     * @return  CustomerModel
     */ 
    public function setDtNascimento(string $dtNascimento):CustomerModels
    {
        $this->dtNascimento = $dtNascimento;

        return $this;
    }
}


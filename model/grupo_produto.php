<?php
class GrupoProduto
{
    private $nome;
    private $descricao;

    public function __construct($nome, $descricao)
    {
        $this->nome = $nome;
        $this->descricao = $descricao;
    }
}

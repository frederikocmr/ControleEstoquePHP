<?php
class Movimentacao
{
    private $produto;
    private $secao;
    private $descricao;
/**
** Construtor
* @package view
*/
    public function __construct($produto, $secao, $descricao)
    {
        $this->produto = $produto;
        $this->secao = $secao;
        $this->descricao = $descricao;
    }
}
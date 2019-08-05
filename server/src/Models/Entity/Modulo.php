<?php
namespace App\Models\Entity;

/**
 * @Entity @Table(name="modulos")
 */
class Modulo {
    /**
     * @var int
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    public $id;
    
    /**
     * @var string
     * @Column(type="string")
     */
    public $nome;

    /**
     * @var string
     * @Column(type="string")
     */
    public $tipo;

    /**
     * @var string
     * @Column(type="string")
     */
    public $tipo_pagamento;

    /**
     * @var string
     * @Column(type="string")
     */
    public $status;

    /**
     * @var string
     * @Column(type="string")
     */
    public $icone;

    /**
     * @return int id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string nome
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * @return string tipo
     */
    public function getTipo() {
        return $this->tipo;
    }

    /**
     * @return string tipo_pagamento
     */
    public function getTipoPagamento() {
        return $this->tipo_pagamento;
    }

    /**
     * @return string status
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * @return string icone
     */
    public function getIcone() {
        return $this->icone;
    }

    /**
     * @return Modulo()
     */
    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return Modulo()
     */
    public function setTipo($tipo) {
        $this->tipo = $tipo;
        return $this;
    }

    /**
     * @return Modulo()
     */
    public function setTipoPagamento($tipo_pagamento) {
        $this->tipo_pagamento = $tipo_pagamento;
        return $this;
    }

    /**
     * @return Modulo()
     */
    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }

    /**
     * @return Modulo()
     */
    public function setIcone($icone) {
        $this->icone = $icone;
        return $this;
    }
}
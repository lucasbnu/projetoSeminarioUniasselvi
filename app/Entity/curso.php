<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class curso{

  /**
   * Identificador único da curso
   * @var integer
   */
  public $id;

  /**
   * Título da curso
   * @var string
   */
  public $titulo;

  /**
   * Descrição da curso (pode conter html)
   * @var string
   */
  public $descricao;

  /**
   * Define se a curso ativa
   * @var string(s/n)
   */
  public $ativo;

  /**
   * Data de publicação da curso
   * @var string
   */
  public $data;

  /**
   * Método responsável por cadastrar uma nova curso no banco
   * @return boolean
   */
  public function cadastrar(){
    //DEFINIR A DATA
    $this->data = date('Y-m-d H:i:s');

    //INSERIR A curso NO BANCO
    $obDatabase = new Database('cursos');
    $this->id = $obDatabase->insert([
                                      'titulo'    => $this->titulo,
                                      'descricao' => $this->descricao,
                                      'ativo'     => $this->ativo,
                                      'data'      => $this->data
                                    ]);

    //RETORNAR SUCESSO
    return true;
  }

  /**
   * Método responsável por atualizar a curso no banco
   * @return boolean
   */
  public function atualizar(){
    return (new Database('cursos'))->update('id = '.$this->id,[
                                                                'titulo'    => $this->titulo,
                                                                'descricao' => $this->descricao,
                                                                'ativo'     => $this->ativo,
                                                                'data'      => $this->data
                                                              ]);
  }

  /**
   * Método responsável por excluir a curso do banco
   * @return boolean
   */
  public function excluir(){
    return (new Database('cursos'))->delete('id = '.$this->id);
  }

  /**
   * Método responsável por obter as cursos do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function getcursos($where = null, $order = null, $limit = null){
    return (new Database('cursos'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

  /**
   * Método responsável por buscar uma curso com base em seu ID
   * @param  integer $id
   * @return curso
   */
  public static function getcurso($id){
    return (new Database('cursos'))->select('id = '.$id)
                                  ->fetchObject(self::class);
  }

}
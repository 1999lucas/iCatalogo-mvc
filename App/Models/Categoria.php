<?php

use App\Core\Model;

class Categoria
{
    public $id;
    public $descricao;

    public function listarTodas()
    {
        $sql = " SELECT * FROM tbl_categoria ";
        $stmt = Model::getConn()->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $resultados;
        } else {
            return [];
        }
    }
        public function inserir(){
            //declaramos o sql, com um ponto de bind ?
    
            $sql = " INSERT INTO tbl_categoria (descricao) VALUES (?) ";
    
            //preparamos a instância para inserir
            $stmt = Model::getConn()->prepare($sql);
            //substitui o primeiro ? pela variável descrição
            $stmt->bindValue(1, $this->descricao);
            //executa
            if($stmt->execute()){
                //se der certo, atribui o id inserido na classe
                $this->id = Model::getConn()->lastInsertId();
                //e retorna a própria classe
                return $this;
            }else{
                //se der errado, retorna falso
                return false;
            }
        }
        public function deletar(){



            $sql = " DELETE FROM tbl_categoria WHERE id = ? ";    
            $stmt = Model::getConn()->prepare($sql);
            $stmt->bindValue(1, $this->id);
            return $stmt->execute();
        }
    }
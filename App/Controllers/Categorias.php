<?php

use App\Core\Controller;

class Categorias extends Controller{

    public function index(){

    $categoriaModel = $this->model("Categoria");

    $dados = $categoriaModel->listarTodas();

    $this->view("categorias/index", $dados);
    }


    public function create(){
        $this->view("categorias/create");
    }
    public function store()
    {
        //validar os campos (pegar a função de validação já criada no outro projeto)
        $erros = $this->validaCampos();
        if (count($erros) > 0) {
            $_SESSION["erros"] = $erros;
            header("location: /categorias/create");
            exit();
        }
        //instanciar o model
        $categoriaModel = $this->model("Categoria");
        //atribuir a descricao do $_POST ao model->descricao
        $categoriaModel->descricao = $_POST["descricao"];
        //chamar a função de inserir
        if($categoriaModel->inserir()){
            $_SESSION["mensagem"] = "Categoria cadastrada com sucesso";
        }else{
            $_SESSION["mensagem"] = "Problemas ao cadastrar categoria";
        }
        header("location: /categorias");
    }

    //validando os campos
    $erros = $this->validaCampos();
    if(count($erros) > 0) {
        $_SESSION["erros"] = $erros;
        header("location: /categorias/edit/" . $id);
        exit();
    }

    //criando o model para atualizacao
        $categoriaModel = $this->model("Categoria");
        $categoriaModel->id = $id;
        $categoriaModel->descricao = $_POST["descricao"];
    
    //fazendo a atualização e enviando mensagem
    if($categoriaModel->atualizar()){
        $_SESSION["mensagem"] = "Categoria atualizada com sucesso";
    }else{
        $_SESSION["mensagem"] = "Problemas ao atualizar categorias";
    }
    header("location: /categorias");
}

    public function destroy($id)

    {
        $categoriaModel = $this->model("Categoria");
        $categoriaModel->id = $id;
        if ($categoriaModel->deletar()) {
            $_SESSION["mensagem"] = "Categoria deletada com sucesso";
        } else {
            $_SESSION["mensagem"] = "Problemas ao deletar categoria";
        }
        header("location: /categorias");
    }
    }
    private function validaCampos()
    {
        $erros = [];
        if (!isset($_POST["descricao"]) || $_POST["descricao"] == "") {
            $erros[] = "O campo descrição é obrigatório";
        }
        return $erros;

    }
}
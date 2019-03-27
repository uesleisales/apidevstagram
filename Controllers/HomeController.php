<?php
namespace Controllers;
use \Core\Controller;

class HomeController extends Controller{
    
    public function index(){
      $array = array(
          'nome' => "ueslei",
          'senha' => md5("olá mundo")
      );

      $this->returnJson($array);
    }


    public function visualizar_usuarios($id){

      echo $id;
    }

}
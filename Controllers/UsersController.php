<?php
namespace Controllers;

use \Core\Controller;
use \Models\Users;
class UsersController extends Controller{
    
    public function index(){
     
    }

    public function login(){
    	$array = array(
    		'error'=> ''
    	);

    	$method = $this->getMethod();
    	$data = $this->getRequestData();

    	if($method == 'POST'){
    		
    		if(!empty($data['email']) && $data['pass']){
    			$users = new Users();
    			$creden = $users->checkCredentials($data['email'] , $data['pass']);
    			
    			if($users->checkCredentials($data['email'] , $data['pass'])){
    				//Gerar JWT
    				
    				$array['jwt'] = $users->createJwt();
    			}else{
    				$array['error'] = "Acesso negado";
    			}


    		}else{
    			$array['error'] = "Email e/ou senha não preenchidos";
    		}	

    	}else{
    		$array['error'] = "Método de requisição incompatível";
    	}


    	$this->returnJson($array);
    }


    public function new_record(){
		$array = array('error' => '');

		$method = $this->getMethod();
		$data   = $this->getRequestData();

		if($method == 'POST'){
			if(!empty($data['name']) && !empty($data['email']) && !empty($data['pass']) ){
				if(filter_var($data['email'] , FILTER_VALIDATE_EMAIL)){
					$users = new Users();
					
					if($users->create($data['name'] , $data['email'] , $data['pass'])){
				
						$array['jwt'] = $users->createJwt();
					}else{
						$array['error'] = "E-mail já existente";
					}
				}else{
					$array['error'] = "Email inválido";
				}
			}else{	
				$array['error'] = "Dados não preenchidos";
			}
		}else{
			$array['error'] = "Método de requisição incompatível";
		}
		$this->returnJson($array);
	}

	public function view($id){

		/*Esse método recebe um jwt como parametro, é fazer login antes para pegar  */

		$array = array('error' => '',
					   'logged' => false);


		$method = $this->getMethod();
		$data   = $this->getRequestData();

		$users = new Users();

		
		if(!empty($data['jwt']) && $users->validateJwt($data['jwt'])){
			$array['logged'] = true;
			$array['is_me'] = false; //Aponta se o usuario que 

			if($id == $users->getId()){
				$array['is_me'] = true; 
			}


			switch ($method) {
				case 'POST':
					# code...
					break;
				case 'PUT':
					# code...
					break;

				case 'DELETE':
					# code...
					break;

				default:
					$array['error'] = "Método ".$method." não disponivel";
					break;
			}

		}else{
			$array['error'] = "Acesso negado";
		}

		$this->returnJson($array);
	}
}
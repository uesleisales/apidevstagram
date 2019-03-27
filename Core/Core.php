<?php
namespace Core;

class Core{

    public function run(){
        $url = "/";
        

        if(isset($_GET['url'])){
            $url .= $_GET['url'];
        }

        $url = $this->checkRoutes($url);
        $params = array();
        //Se for enviado o parâmetro de Controlador e função
        if(!empty($url) && $url != '/'){

            $url = explode('/' , $url);
            array_shift($url); //Remove a primeira posição do vetor que fica em branco

            $currentController = $url[0].'Controller';
            array_shift($url); //Remove a primeira posição do vetor que referenciava ao controller

            if(isset($url[0]) && !empty($url[0])){
                $currentAction = $url[0];
                array_shift($url);


            }else{
                $currentAction = 'index';
            }

            if(count($url) > 0){
                $params = $url;
            }


        }else{
            $currentController = 'HomeController';
            $currentAction     = 'index';
        }

        $currentController = ucfirst($currentController); //Coloca primeira letra em maiuscula

        $prefix = "\Controllers\\";
        if(!file_exists('Controllers/'.$currentController.'.php') || 
            !method_exists($prefix.$currentController , $currentAction)){
            $currentController = 'NotfoundController';
            $currentAction     = 'index';
        }


        $newController = $prefix.$currentController;
        $c = new $newController();
        call_user_func_array(array($c , $currentAction) , $params); // Equivale a ---->> $c->$currentAction($params);
        
    }



    public function checkRoutes($url){
        global $routes;
        foreach($routes as $pt => $newUrl){
            //Identifica os argumentos e substitui por expressões regulares
            $pattern = preg_replace('(\{[a-z0-9]{1,}\})' , '([a-z0-9]{1,})' , $pt);
            //echo $pattern;  Exemplo de resultado: /galeria/([a-z0-9]{1,})
            
            if(preg_match('#^('.$pattern.')*$#i', $url , $matches ) === 1){  //Verifica se isso /galeria/([a-z0-9]{1,})  está de acordo com isso /galeria/123 
                                                                            //$matches são os itens que bateram ou se enquadraram no padrão
                array_shift($matches);//Remove o primeiro valor
                array_shift($matches);//Remove o segundo valor        ---- São irrelevantes
            
                //Pega todos os argumentos para associar
                /*
                Exemplo de argumento {id}
                */

                $itens = array();

                if(preg_match_all('(\{[a-z0-9]{1,}\})' , $pt , $m)){ //Salva oq está em $pt em $m
                    $itens = preg_replace('(\{|\})' , '' , $m[0]); //vai tirar o parametro de dentro dos {}
                }
                

                //Faz a associação
                $arg = array();

                foreach($matches as $key => $match){
                    $arg[$itens[$key]] = $match; 
                }

                //print_r($arg);    id => 123
                

                //Gerando a nova URL
                foreach($arg as $argKey => $argValue){
                    $newUrl = str_replace(':'.$argKey , $argValue , $newUrl);
                }

                //echo $newUrl;     /galeria/abrir/123
                
                $url = $newUrl;
                break; //Porque já achou a primeira rota 

              }
        }

        return $url;
    }
}
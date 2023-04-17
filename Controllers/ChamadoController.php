<?php
   namespace Controllers;

   class ChamadoController{
      

         public function existeToken(){
              $token = $_GET['token'];
              $verefica = \MySql::conectar()->prepare("SELECT * FROM chamados WHERE token = ?");
              $verefica->execute(array($token));
              if($verefica->rowCount() == 1){
                  return true;
              }else{
                return false;
              }
         }

         public function getPergunta($token){
            $sql = \MySql::conectar()->prepare("SELECT * FROM chamados WHERE token = ?");
            $sql->execute(array($token));
            return $sql->fetch();
         }

         public function index($info){
            \Views\mainView::render('chamado',$info);
         }
   }

?>
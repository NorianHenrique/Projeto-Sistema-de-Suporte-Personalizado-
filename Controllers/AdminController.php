<?php
  namespace Controllers;

  class AdminController{
      
        public function index(){
            
            \Views\mainView::render('admin');
        }
  }

?>
<?php
  namespace Controllers;

  class HomeController{
      
        public function index(){
            \Views\mainView::render('home');
        }
  }

?>
profile.show<?php

require 'models/profileUser.php';

/**
 * 
 */
class ProfileController

   {
   	private $model;
   	private $usuariosempleados;

	public function __construct(){


		$this->model = new profileUser;
	}


public function index(){

        //capturar datos con los modelos
        $usuariosempleados = profileUser::all();

      //retornar vista que me muestre los artistas
      return view ('profileConfig.profile.html')
                   ->with('usuariosempleados', $usuariosempleados);
    }

	}
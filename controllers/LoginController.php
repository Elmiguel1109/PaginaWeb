<?php
	
	require 'models/Login.php';
	/**
	 * Clase Controlador Login
	 */
	class LoginController
	{		
		private $model;

		public function __construct()
		{
			$this->model = new Login;
		}

		public function index()
		{
			if(isset($_SESSION['user'])) {
				header('Location: ?controller=main');
			} else {
				require "views/login/login.php";
			}
		}

		public function login()
		{
			$validateUser = $this->model->validateUser($_POST);

			if($validateUser === true) {
				header('Location: ?controller=main');
			} else {
				$error = [
					'errorMessage' => $validateUser,
					'email' => $_POST['email']
				];
				require "views/login/login.php";
			}
		}

		public function logout()
		{
			if(isset($_SESSION['user']))
				session_destroy();			
			header('Location: ?controller=index');			
		}
	}
	
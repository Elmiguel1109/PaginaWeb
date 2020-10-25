<?php
	
	require 'models/Register.php';
	/**
	 * Clase Controlador Login
	 */
	class RegisterController
	{		
		private $model;

		public function __construct()
		{
			$this->model = new Register;
		}

		public function index()
		{
			if(isset($_SESSION['user'])) {
				header('Location: ?controller=main');
			} else {
				require "views/login/register.php";
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
				require "views/login/register.php";
			}
		}

		public function logout()
		{
			if(isset($_SESSION['user']))
				session_destroy();			
			header('Location: ?controller=index');			
		}
	}
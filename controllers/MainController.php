<?php
	
	/**
	 * Clase Controlador del main
	 */
	class MainController
	{		
		public function index()
		{
			require 'views/layouts/main/header.php';
			require 'views/main/index.php';
			require 'views/layouts/main/footer.php';
		}
		public function profile()
		{
			require 'views/layouts/main/header.php';
			require 'views/main/profile.php';
			require 'views/layouts/main/footer.php';
		}
	}

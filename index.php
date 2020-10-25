<?php
	
	session_start();	
	//LLamado a la Clase de Conexión
	require 'providers/Database.php';

	//Inicializar variable de controlador por defecto
	$controller = 'IndexController';

	//Validación de acciones tomar
	if(!isset($_REQUEST['controller'])) {
		//Llamado al controlador por defecto
		require 'controllers/'.$controller. '.php';

		$controller = ucwords($controller);
		$controller = new $controller;
		$controller->index();
	} else {
		//cuando existe solicitud desde el front
		$controller = ucwords($_REQUEST['controller'] . 'Controller');
		// condicional ternario  Condición     condición verdadera	 condición falsa
		$method = isset($_REQUEST['method']) ? $_REQUEST['method'] : 'index';

		require 'controllers/'.$controller.'.php';
		$controller = new $controller;

		//realizar llamado a metodos
		call_user_func(array($controller, $method));
	}
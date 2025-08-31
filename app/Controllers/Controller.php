<?php


namespace App\Controllers;


use \Psr\Container\ContainerInterface;


class Controller {


	protected $container;


	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	// manipulacao da funcao get
	public function __get($param)
	{
		if ($this->container->get($param)) {
			return $this->container->get($param);
		}
	}

}
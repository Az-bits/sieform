<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inicio extends Frontend
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		//index
		$this->data['title1'] = 'Sistema';
		$this->data['subtitle'] = 'UPEA';
		$this->data['carrera'] = '';
		$this->data['page_content'] = 'frontend/inicio';
		$this->data['page'] = '';

		$this->render();
	}
	public function publicaciones()
	{
		$this->data['title1'] = 'Sistema';
		$this->data['subtitle'] = 'UPEA';
		$this->data['carrera'] = '';
		$this->data['page_content'] = 'frontend/publicaciones';
		$this->data['page'] = '';

		$this->render();
	}
	public function formularios()
	{
		$this->data['title1'] = 'Sistema';
		$this->data['subtitle'] = 'UPEA';
		$this->data['carrera'] = '';
		$this->data['page_content'] = 'frontend/ListaFormularios';
		$this->data['page'] = '';

		$this->render();
	}
}

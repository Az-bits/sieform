<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends Backend
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Ion_auth_model');
		//$this->load->model('habilitaciones/Modelo_gestiones');
		$this->lang->load('ion_auth');

		$dato = $this->ion_auth->user()->row();
		$this->id_usuario = $dato->id;
		//$this->ion_auth->validar_usuario_kardex_carrera_activa($this->id_usuario,$this->id_carrera);
	}


	public function index()
	{
		if (!$this->ion_auth->logged_in()) //OR ! $this->ion_auth->is_admin()
		{
			redirect('auth/login/backend', 'refresh');
		}
		//elseif ( ! $this->ion_auth->is_admin())
		//{
		//return show_error('You must be an administrator to view this page.');
		//}
		else {
			$count_user  = $this->db->count_all($this->config->item('tables', 'ion_auth')['users']);
			$count_group = $this->db->count_all($this->config->item('tables', 'ion_auth')['groups']);

			if ($count_user >= 1) {
				$this->data['lang_user_plural'] = plural($this->lang->line('user'));
			} else {
				$this->data['lang_user_plural'] = $this->lang->line('user');
			}

			if ($count_group >= 1) {
				$this->data['lang_group_plural'] = plural($this->lang->line('group'));
			} else {
				$this->data['lang_group_plural'] = $this->lang->line('group');
			}

			$this->data['nbr_user']     = $count_user;
			$this->data['nbr_group']    = $count_group;
			$this->data['subtitle']     = $this->lang->line('dashboard');
			$this->data['page_content'] = 'backend/dashboard';
			$this->data['page'] = '';
			$this->data['title'] = 'Menu';
			$this->render();
		}
	}
}

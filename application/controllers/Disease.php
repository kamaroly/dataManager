<?php

/**
 * Created by PhpStorm.
 * User: Godluck Akyoo
 * Date: 2/29/2016
 * Time: 4:17 PM
 */
class Disease extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Disease_model");
	}


	public function index()
	{
		$this->diseases();
	}

	public function diseases()
	{
		$data['title'] = "Diseases";
		$data['diseases'] = $this->Disease_model->find_all(30, 0);

		$this->load->view('header', $data);
		$this->load->view("disease/menu");
		$this->load->view("disease/index", $data);
		$this->load->view('footer');
	}

	public function add_new()
	{
		$data['title'] = "Add new";

		$this->form_validation->set_rules("name", $this->lang->line("label_disease_name"), "required");

		if ($this->form_validation->run() === FALSE) {

			$this->load->view('header', $data);
			$this->load->view("disease/menu");
			$this->load->view("disease/add_new", $data);
			$this->load->view('footer');
		} else {
			$disease = array(
				"name" => $this->input->post("name"),
				"description" => $this->input->post("description"),
				"date_created" => date("c")
			);

			if ($this->Disease_model->add($disease)) {
				$this->session->set_flashdata("message", $this->lang->line("add_disease_successful"));
			} else {
				$this->session->set_flashdata("message", $this->lang->line("error_failed_to_add_disease"));
			}
			redirect("disease/add_new");
		}
	}

	public function edit_disease()
	{

	}

	public function species()
	{
		$data['title'] = "Species";
		$data['species'] = $this->Disease_model->find_all_species(30, 0);

		$this->load->view('header', $data);
		$this->load->view("disease/menu");
		$this->load->view("disease/species", $data);
		$this->load->view('footer');
	}

	public function add_new_specie()
	{
		$data['title'] = "Add new specie";

		$this->form_validation->set_rules("specie", $this->lang->line("label_specie"),
			"required|is_unique[" . $this->config->item("table_species") . ".name]");

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('header', $data);
			$this->load->view("disease/menu");
			$this->load->view("disease/add_new_specie", $data);
			$this->load->view('footer');
		} else {
			$specie = array(
				"name" => $this->input->post("specie"),
				"date_created" => date("c")
			);

			if ($this->Disease_model->add_specie($specie)) {
				$this->session->set_flashdata("message", $this->lang->line("add_specie_successful"));
			} else {
				$this->session->set_flashdata("message", $this->lang->line("error_failed_to_add_specie"));
			}
			redirect("disease/add_new_specie");
		}
	}


	public function add_new_symptom()
	{
		$data['title'] = "Add new symptoms";

		$this->form_validation->set_rules("name", $this->lang->line("label_symptom_name"), "required");
		//$this->form_validation->set_rules("description", $this->lang->line("label_description"), "required");

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('header', $data);
			$this->load->view("disease/menu");
			$this->load->view("disease/add_new_symptom", $data);
			$this->load->view('footer');
		} else {
			$symptoms = array(
				"name" => $this->input->post("name"),
				"description" => $this->input->post("description"),
				"date_created" => date("c")
			);

			if ($this->Disease_model->add_symptom($symptoms)) {
				$this->session->set_flashdata("message", $this->lang->line("add_symptom_successful"));
			} else {
				$this->session->set_flashdata("message", $this->lang->line("error_failed_to_add_symptom"));
			}
			redirect("disease/add_new_symptom");
		}
	}

	public function symptoms()
	{
		$data['title'] = "Symptoms";
		$data['symptoms'] = $this->Disease_model->find_all_symptoms(30, 0);

		$this->load->view('header', $data);
		$this->load->view("disease/menu");
		$this->load->view("disease/symptoms", $data);
		$this->load->view('footer');
	}
}
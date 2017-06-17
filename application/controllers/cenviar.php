<?php
defined('BASEPATH')or exit('No direct script access allowed');

class cenviar extends CI_controller{


	public function guardarmag(){
			$archivored=$this->input->post('archivored');
			$id=$_SESSION["Persona_id"];
			$data=array('archivored'=>$archivored,'id'=>$id);
			$this->mLogin->insertmovm($data);
			date_default_timezone_set('America/Mexico_City');
			$time = time();
			$fecha = date("dmY", $time);
			$this->load->model('mLogin');
			$Persona_id = $this->session->userdata('Persona_id');
			$datos['expedientes'] = $this->mLogin->exp_x_sa($Persona_id);
			$datos['proyectista'] = $this->mLogin->get_SA(4);
			$datos['magistrado'] = $this->mLogin->get_SA(6);
			$datos['actuario'] = $this->mLogin->get_SA(5);
			$datos['tipoacuerdo'] = $this->mLogin->get_tipoacuerdo(2);
			$datos['desecha']= $this->mLogin->get_tipodesecha();
			$data2=array(
				'nombre'=>$archivored,
				'folder'=>"Proyectos/Redactados/",
				'status'=>2
				);
			echo "<script>alert('Enviado al magistrado...');</script>";
			$this->mLogin->editproy($data2);
		  $this->load->view('header2');
		  $this->load->view('body/vOficial');
			$this->load->view('proyectista/vProyectista',$datos);
			$this->load->view('footer');
	}
	public function aprobarmag(){
			$archivored=$this->input->post('archivo');
			$comentarios=$this->input->post('comentarios');
			$hoy=getdate();
			$estado=3;
			$fecha=$hoy['mday'].$hoy['mon'].$hoy['year'].$hoy['hours'].$hoy['minutes'];
			$this->load->model('mLogin');
			$Persona_id = $this->session->userdata('Persona_id');
			$datos['expedientes'] = $this->mLogin->exp_x_sa($Persona_id);
			$datos['proyectista'] = $this->mLogin->get_SA(4);
			$datos['magistrado'] = $this->mLogin->get_SA(6);
			$datos['actuario'] = $this->mLogin->get_SA(5);
			$datos['tipoacuerdo'] = $this->mLogin->get_tipoacuerdo(2);
			$datos['desecha']= $this->mLogin->get_tipodesecha();
			//$data1=$this->mLogin->datarc($archivored);
			$data2=array(
				'nombre'=>$archivored,
				'status'=>$estado,
				'comentarios'=>$comentarios
				);
			echo "<script>alert('Proyecto Aprobado...');</script>";
			if($this->mLogin->editproym($data2)){
				echo "<script>alert('Proyecto Aprobado...');</script>";
			}
		    $this->load->view('header2');
			$this->load->view('body/vOficial');
			$this->load->view('magistrado/vProyectosPendientes');
			$this->load->view('footer');
	}
	public function rechazarmag(){
			$archivo=$this->input->post('archivo');
			$comentarios=$this->input->post('comentarios');
			$this->load->model('mLogin');
			$Persona_id = $this->session->userdata('Persona_id');
			$datos['expedientes'] = $this->mLogin->exp_x_sa($Persona_id);
			$datos['proyectista'] = $this->mLogin->get_SA(4);
			$datos['magistrado'] = $this->mLogin->get_SA(6);
			$datos['actuario'] = $this->mLogin->get_SA(5);
			$datos['tipoacuerdo'] = $this->mLogin->get_tipoacuerdo(2);
			$datos['desecha']= $this->mLogin->get_tipodesecha();
			//$data1=$this->mLogin->datarc($archivored);
			$data2=array(
				'nombre'=>$archivo,
				'folder'=>"Proyectos/Redactados/",
				'comentarios'=>$comentarios,
				'status'=>4
				);
			echo "<script>alert('Proyecto Rechazado...');</script>";
			$this->mLogin->editproym($data2);
		    $this->load->view('header2');
			$this->load->view('body/vOficial');
			$this->load->view('magistrado/vProyectosPendientes');
			$this->load->view('footer');
	}
}

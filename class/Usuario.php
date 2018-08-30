<?php
	class Usuario{
		private $idUsuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;

		public function getIdUsuario()
		{
			return $this->idUsuario;
		}

		public function SetIdUsuario($idUsuario)
		{
			$this->idUsuario = $idUsuario;
		}

		public function getDeslogin()
		{
			return $this->deslogin;
		}

		public function SetDeslogin($deslogin)
		{
			$this->deslogin = $deslogin;
		}

		public function getDessenha()
		{
			return $this->dessenha;
		}

		public function SetDessenha($dessenha)
		{
			$this->dessenha = $dessenha;
		}

		public function getDtcadastro()
		{
			return $this->dtcadastro;
		}

		public function SetDtcadastro($dtcadastro)
		{
			$this->dtcadastro = $dtcadastro;
		}

		public function loadById($id)
		{
			$sql = new Sql();
			$results = $sql->select("SELECT * FROM tb_Usuario WHERE idusuario = :ID", array(
				":ID"=> $id
			));
			/*
			if(isset($results[0])){

			}
			*/
			if(count($results) > 0)
			{
				$row = $results[0];
				$this->SetIdUsuario($row['idusuario']);
				$this->SetDeslogin($row['desclogin']);
				$this->SetDessenha($row['dessenha']);
				$this->SetDtcadastro(new DateTime($row['dtcadastro']));
			}
		}

		public function __toString()
		{
			return json_encode(array(
				"idusuario"=>$this->getIdUsuario(),
				"deslogin"=>$this->getDeslogin(),
				"dessenha"=>$this->getDessenha(),
				"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
			));
		}
		
	}

?>
<?php
	class Usuario{
		private $idUsuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;

		public function __construct($login = "", $senha  = "")
		{
			$this->SetDesLogin($login); 
			$this->SetDessenha($senha);
			
		}

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
				
				$this->setData($results[0]);
			}
		}

		public static function getList(){
			$sql = new Sql();
			return $sql->select("SELECT * FROM tb_Usuario ORDER BY desclogin;");	 
		}

		public static function search($login){
			$sql = new Sql();
			return $sql->select("SELECT * FROM tb_Usuario WHERE desclogin LIKE :SEARCH ORDER BY desclogin;",
				array(
					':SEARCH'=> "%".$login. "%"
				)
			);
		}

		public function login($login, $senha){
			$sql = new Sql();
			$results = $sql->select("SELECT * FROM tb_Usuario WHERE desclogin = :LOGIN and dessenha = :SENHA", array(
				":LOGIN"=>$login,
				":SENHA"=>$senha
			));
			
			if(count($results) > 0)
			{
				
				$this->setData($results[0]);
			}else
			{
				throw new Exception("Login e/ ou senha invalidos!");
			}
		}

		public function setData($dados){
			$this->SetIdUsuario($dados['idusuario']);
			$this->SetDeslogin($dados['desclogin']);
			$this->SetDessenha($dados['dessenha']);
			$this->SetDtcadastro(new DateTime($dados['dtcadastro']));
		}
		public function insert()
		{
			$sql = new Sql();
			$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(
				':LOGIN'=>$this->getDeslogin(),
				':SENHA'=>$this->getDessenha()
			));

			if(count($results) > 0)
			{
				$this->setData($results[0]);
			}else
			{
				echo "Usuario Nao cadastrado";
			}
		}

		public function update($login, $pass){

			$this->SetDeslogin($login);
			$this->SetDessenha($pass);

			$sql = new Sql();
			$sql->query("UPDATE tb_Usuario set desclogin = :LOGIN, dessenha = :PASS WHERE idusuario = :ID ", array
				(
					':LOGIN'=> $this->getDeslogin(),
					':PASS'=>  $this->getDessenha(),
					':ID'=>	$this->getIdUsuario()
				));

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
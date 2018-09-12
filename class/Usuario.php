<?php
	class Usuario{
		private $idUsuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;

		public function __construct($login = "", $senha  = "")
		{
			$this->setDeslogin($login); 
			$this->setDessenha($senha);
			
		}

		public function getIdUsuario()
		{
			return $this->idUsuario;
		}

		public function setIdUsuario($idUsuario)
		{
			$this->idUsuario = $idUsuario;
		}

		public function getDeslogin()
		{
			return $this->deslogin;
		}

		public function setDeslogin($deslogin)
		{
			$this->deslogin = $deslogin;
		}

		public function getDessenha()
		{
			return $this->dessenha;
		}

		public function setDessenha($dessenha)
		{
			$this->dessenha = $dessenha;
		}

		public function getDtCadastro()
		{
			return $this->dtcadastro;
		}

		public function setDtCadastro($dtcadastro)
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
			$this->setIdUsuario($dados['idusuario']);
			$this->setDeslogin($dados['desclogin']);
			$this->setDessenha($dados['dessenha']);
			$this->setDtCadastro(new DateTime($dados['dtcadastro']));
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

		public function delete()
		{
			$sql = new Sql();
			$sql->query("DELETE FROM tb_Usuario WHERE idusuario = :ID", array(
				':ID'=>$this->getIdUsuario()
			));
			$this->setIdUsuario(0);
			$this->setDeslogin("");
			$this->setDessenha("");
			$this->setDtCadastro(new DateTime());

		}

		public function update($login, $pass){

			$this->setDeslogin($login);
			$this->setDessenha($pass);

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
				"dtcadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
			));
		}

	}

?>
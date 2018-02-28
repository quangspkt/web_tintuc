<?php
	
	include('model/model_user.php');
	/**
	* 
	*/
	class C_user 
	{
		
		function dangkiTK($name,$email,$password)
		{
			$m_user=new M_user();
			$id_user =$m_user->dangki($name,$email,$password);
			if ($id_user>0) {
				$_SESSION['success'] ="Dang ky thanh cong";
				header('location:index.php');
				if(isset($_SESSION['error'])){
					unset($_SESSION['error']);

				}
			}
			else{
				$_SESSION['error']="dang ki that bai";
				header('location:dangki.php');
			}
		}
		public function dangnhapTK($email,$password){
			$m_user =new M_user();
			$user =$m_user->dangnhap($email,$password);
			
			if ($user == true) {
				$_SESSION['user_name'] =$user->name;
				header('location:index.php');
				if (isset($_SESSION['user_error'])){
					unset($_SESSION['user_error']);
				}
			}
			else
			{
				$_SESSION['user_error']="sai thong tin dang nhap";
				header('location:dangnhap.php');
			}
		}


		function dangxuat(){
			session_destroy();
			header("location:index.php");
		}
	}


?>
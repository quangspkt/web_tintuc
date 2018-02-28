 <?php
include('model/model_tintuc.php');
include('model/pager.php');
/**
* 
*/
class Controller_tintuc 
{
	
	public function index(){

		$m_tintuc =new Model_tintuc();
		$slide = $m_tintuc->getSlide();
		$menu =$m_tintuc->getMenu();
		return array('slide'=>$slide,'menu'=>$menu);
	}

	function loaitin(){
		$id_loai =$_GET['id_loai'];
		$alias = new Model_tintuc();
		$m_tintuc = new Model_tintuc();

		$alias =$m_tintuc->getAliasLoaitin($id_loai);
		$danhmuctin =$m_tintuc->getTintucByIdLoai($id_loai);
		$trang_hientai =(isset($_GET['page']))?$_GET['page']:1;
		$pagination =new pagination(count($danhmuctin),$trang_hientai, 1 , 3);
		$paginationHTML =$pagination->showPagination();
		$limit = $pagination->_nItemOnPage;
		$vitri =($trang_hientai-1)*$limit;
		$danhmuctin =$m_tintuc->getTintucByIdLoai($id_loai,$vitri,$limit); 


 
		$menu =$m_tintuc->getMenu();
		$title =$m_tintuc->getTitlebyId($id_loai);
		return array('danhmuctin'=>$danhmuctin,'menu'=>$menu,'title'=>$title,'thanh_phantrang'=>$paginationHTML,'alias'=>$alias);

	}
	function chitietTin(){
		$id_tin=$_GET['id_tin'];
		$alias =$_GET['loai_tin'];
		$m_tintuc =new Model_tintuc();
		$chitietTin =$m_tintuc->getChitietTin($id_tin);
		$comment =$m_tintuc->getComment($id_tin);
		$relatednews =$m_tintuc->getRelatedNew($alias);
		return array('chitietTin'=>$chitietTin,'comment'=>$comment,'relatednews'=>$relatednews);
	}


	function timkiem($key){
		$m_tintuc =new Model_tintuc();
		$tin =$m_tintuc->search($key);
		return $tin;
	}
}
?>
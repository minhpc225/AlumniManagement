<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 16/11/2018
 * Time: 11:44 CH
 */
require_once ('../../model/SQLConnection.php');
require_once ('../../model/Lop.php');

class LopController{
	private $listLop = Array();
	private $soLuongLop ;

	/**
	 * LopController constructor.
	 * @param array $listLop
	 * @param int $soLuongLop
	 */
	public function __construct($listLop = null, $soLuongLop = 0)
	{
		$this->listLop = $listLop;
		$this->soLuongLop = $soLuongLop;
	}

	/**
	 * add 1 lop vao list
	 * */
	public function addOneLop(Lop $newLop){
		array_push($this->listLop, $newLop);
	}

	/**
	 * get cac lop tu sql
	 * */
	public function getLopInSql(){
		$sql = 'SELECT * FROM lop
				ORDER BY lop.lopID DESC
				LIMIT '.$this->getSoLuongLop();
		$result = SQLConnection::getResultQuery($sql);

		if ($result->num_rows > 0){
			while ($row = $result->fetch_assoc()){
				$newLop = new Lop($row['lopID'], $row['tenlop']);
				$this->addOneLop($newLop);
			}
		}
	}

	/**
	 * @return array
	 */
	public function getListLop()
	{
		return $this->listLop;
	}

	/**
	 * @param array $listLop
	 */
	public function setListLop($listLop)
	{
		$this->listLop = $listLop;
	}

	/**
	 * @return int
	 */
	public function getSoLuongLop()
	{
		return $this->soLuongLop;
	}

	/**
	 * @param int $soLuongLop
	 */
	public function setSoLuongLop($soLuongLop)
	{
		$this->soLuongLop = $soLuongLop;
	}
}

$testShowLop = new LopController($soLuongLop = 10);
$testShowLop->getLopInSql();
foreach ($testShowLop->getListLop() as $aLop){
	$s = '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">'
	  . '	<div class="thumbnail aClass">'
	  . '		<img src="../../public/Home/img/portfolio/cake.jpg" alt="a class">'
	  . '		<div class="caption">'
	  . '			<h3>Lớp '. $aLop->getTenLop() .'</h3>'
	  . '		</div>'
	  . '		<a href="ListAlumni.html">'
	  . '			<div class="chiTiet text-center">'
	  . '				<i class="fas fa-info-circle"></i>'
	  . '				<h3>Chi tiết...</h3>'
	  . '			</div>'
	  . '		</a>'
	  . '	</div>'
	  . '</div>  <!-- end 1 class -->';

	echo $s;
}


































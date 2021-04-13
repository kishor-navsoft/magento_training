<?php 
namespace Jeevan\Nav\Model\ResourceModel\JeevanTable;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection{
	public function _construct(){
		$this->_init("Jeevannew\Nav\Model\JeevannewmodelTable","Jeevannew\Nav\Model\ResourceModel\JeevanTable");
	}
}
 ?>
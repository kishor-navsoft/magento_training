<?php 
namespace Jeevannew\Nav\Model\ResourceModel;
class JeevanTable extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb{
 public function _construct(){
 $this->_init("jeevannew_nav_table","id");
 }
}
 ?>
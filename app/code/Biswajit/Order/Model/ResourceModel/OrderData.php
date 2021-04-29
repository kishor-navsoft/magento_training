<?php

namespace Biswajit\Order\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class OrderData extends AbstractDb
{
	public function _construct()
	{
 		$this->_init(
 			"biswajit_order_table", 
 			"id"
 		);
 	}
}

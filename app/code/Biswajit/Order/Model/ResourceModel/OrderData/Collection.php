<?php

namespace Biswajit\Order\Model\ResourceModel\OrderData;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection; 

class Collection extends AbstractCollection 
{
	public function _construct()
	{
		$this->_init(
			"Biswajit\Order\Model\OrderData", 
			"Biswajit\Order\Model\ResourceModel\OrderData"
		);
	}
}
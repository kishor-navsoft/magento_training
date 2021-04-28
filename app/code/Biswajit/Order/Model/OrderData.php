<?php

namespace Biswajit\Order\Model;

use Magento\Framework\Model\AbstractModel;

class OrderData extends AbstractModel 
{
	public function _construct()
	{
		$this->_init("Biswajit\Order\Model\ResourceModel\OrderData");
	}
}
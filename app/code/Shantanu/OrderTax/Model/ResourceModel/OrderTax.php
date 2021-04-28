<?php
namespace Shantanu\OrderTax\Model\ResourceModel;


class OrderTax extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	
	public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	)
	{
		parent::__construct($context);
	}
	
	protected function _construct()
	{
		$this->_init('shantanu_order_tax', 'order_tax_id');
	}
	
}
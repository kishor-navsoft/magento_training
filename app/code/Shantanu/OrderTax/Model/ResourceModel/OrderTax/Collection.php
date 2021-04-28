<?php
namespace Shantanu\OrderTax\Model\ResourceModel\OrderTax;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'order_tax_id';
	protected $_eventPrefix = 'shantanu_order_tax_collection';
	protected $_eventObject = 'order_tax_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Shantanu\OrderTax\Model\OrderTax', 'Shantanu\OrderTax\Model\ResourceModel\OrderTax');
	}

}
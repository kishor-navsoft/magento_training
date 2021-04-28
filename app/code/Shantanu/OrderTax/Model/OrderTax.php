<?php
namespace Shantanu\OrderTax\Model;
class OrderTax extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'order_tax';

	protected $_cacheTag = 'shantanu_order_tax';

	protected $_eventPrefix = 'shantanu_order_tax';

	protected function _construct()
	{
		$this->_init('Shantanu\OrderTax\Model\ResourceModel\OrderTax');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}
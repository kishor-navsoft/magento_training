<?php

namespace Shantanu\OrderTax\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class Upgrade implements UpgradeDataInterface
{
	protected $_orderTaxFactory;

	public function __construct(\Shantanu\OrderTax\Model\OrderTaxFactory $orderTaxFactory)
	{
		$this->_orderTaxFactory = $orderTaxFactory;
	}

	public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		$data = [
			'order_id' => 1,
			'tax_id' => 2
		];
		$order_data = $this->_orderTaxFactory->create();
		$order_data->addData($data)->save();
	}
}
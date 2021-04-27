<?php

namespace Biswajit\Order\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{
	public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
	{
		$setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $this->addTaxVatColumn($setup);
        }

        $setup->endSetup();
	}

	private function addTaxVatColumn(SchemaSetupInterface $setup)
    {
        $setup->getConnection()
        	->addColumn(
            	$setup->getTable('biswajit_order_table'),
            	'taxvat',
	            [
	                'type' 		=> 	Table::TYPE_TEXT,
	                'nullable' 	=> 	true,
	                'comment' 	=> 	'Customer Tax/VAT Number',
	                'LENGTH'	=>	255
	            ]
	        );
    } 
}
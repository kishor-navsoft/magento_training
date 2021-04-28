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

        if (version_compare($context->getVersion(), '1.0.2', '<')) {
            $this->addTaxVatColumn($setup);
        }

        if (version_compare($context->getVersion(), '1.0.3', '<')) {
        	$this->updateOrderIdColumnTypeToInteger($setup);
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

    private function updateOrderIdColumnTypeToInteger(SchemaSetupInterface $setup)
    {
    	$setup->getConnection()
    		->dropColumn(
    			$setup->getTable('biswajit_order_table'), 
    			'order_id'
    		);

    	$setup->getConnection()
    		->addColumn(
	            $setup->getTable('biswajit_order_table'),
	            'order_id',
	            [
	             'type' 	=> 	Table::TYPE_INTEGER,
	             'nullable' => 	false,
	             'unsigned' =>	true,
	             'comment' 	=> 	'Order Id',
	             'LENGTH'	=>	10
	            ]
        	);

        $setup->getConnection()
        	->addForeignKey(
                $setup->getFkName(
                    'biswajit_order_table',      // priTableName
                    'order_id',                  // priColumnName
                    'sales_order',               // refTableName
                    'entity_id'                  // refColumnName
                ),
                $setup->getTable('biswajit_order_table'),
                'order_id',                      // priColumn
                $setup->getTable('sales_order'), 
                'entity_id',                     // refColumn
                Table::ACTION_CASCADE 			 // onDelete
			);		
    } 
}
<?php

namespace Biswajit\Order\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
	public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
	{
		$setup->startSetup();

		$tableName = $setup->getTable('biswajit_order_table');

		if (!$setup->getConnection()->istableExists($tableName)) {
			$table = $setup->getConnection()
						->newTable($tableName)
						->addColumn(
							'id',
		                    Table::TYPE_INTEGER,
		                    null,
		                    [
		                        'identity'	=> true,
		                        'unsigned' 	=> true,
		                        'nullable' 	=> false,
		                        'primary' 	=> true
		                    ],
		                    'Id'
						)
						->addColumn(
							'order_id',
                    		Table::TYPE_TEXT,
                    		255,
                    		[
                    			'nullable' 	=> false, 
                    			'default' 	=> ''
                    		],
                    		'Order Id'
						)
						->setComment('New Order Customization Table')
                		->setOption('type', 'InnoDB')
                		->setOption('charset', 'utf8');

            $setup->getConnection()->createTable($table);  

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

		$setup->endSetup();
	}
}
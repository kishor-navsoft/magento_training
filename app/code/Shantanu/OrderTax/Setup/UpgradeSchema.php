<?php

namespace Shantanu\OrderTax\Setup;

class UpgradeSchema implements \Magento\Framework\Setup\UpgradeSchemaInterface {

	public function upgrade(
		\Magento\Framework\Setup\SchemaSetupInterface $setup, 
		\Magento\Framework\Setup\ModuleContextInterface $context
	) {
		$installer = $setup;
		$installer->startSetup();
		if (version_compare($context->getVersion(), '0.1.8', '<')) { 
			if (!$installer->tableExists('shantanu_order_tax')) {
				$table = $installer->getConnection()->newTable( $installer->getTable('shantanu_order_tax') )
					->addColumn(
						'order_tax_id',
						\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
						null,
						[
							'identity' => true,
							'nullable' => false,
							'primary'  => true,
							'unsigned' => true,
						],
						'OrderTax ID'
					)
					->addColumn(
						'order_id',
						\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
						null,
						['nullable => false', 'unsigned' => true],
						'Order ID'
					)
					->addColumn(
						'tax_id',
						\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
						50,
						['nullable => true', 'default' => null],
						'Tax VAT ID'
					)
					->addColumn(
						'created_at',
						\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
						null,
						['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
						'Created At'
					)->addColumn(
						'updated_at',
						\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
						null,
						['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
						'Updated At')
					->setComment('Order Tax Table');
				$installer->getConnection()->createTable($table);

				$installer->getConnection()->addForeignKey(
		            $installer->getFkName(
		                'shantanu_order_tax',
		                'order_tax_id',
		                'sales_order',
		                'entity_id'
		            ),
		            'shantanu_order_tax',
		            'order_id',
		            $installer->getTable('sales_order'), 
		            'entity_id',
		            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
		        );
			}
			
		}
		$installer->endSetup();
	}
}
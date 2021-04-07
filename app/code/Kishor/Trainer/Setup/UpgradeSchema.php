<?php 
namespace Kishor\Trainer\Setup;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;
class UpgradeSchema implements \Magento\Framework\Setup\UpgradeSchemaInterface{
 
	public function upgrade(SchemaSetupInterface $setup,ModuleContextInterface $context){
        $setup->startSetup();
        if (version_compare($context->getVersion(), '1.1.8', '<')) {
            $this->addStatus($setup);
        }
        $setup->endSetup();
	}
	
    /**
     * @param SchemaSetupInterface $setup
     * @return void
     */
    private function addStatus(SchemaSetupInterface $setup)
    {
        $setup->getConnection()->addColumn(
            $setup->getTable('kishor_trainer_table'),
            'taxvat',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'nullable' => true,
                'comment' => 'TaxVat',
                'LENGTH'=>255
            ]
        );
        $setup->getConnection()->changeColumn(
            $setup->getTable('kishor_trainer_table'),
            'order_id',
            'order_id',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'nullable' => true,
                'comment' => 'OrderId',
                'LENGTH'=>255
            ]
        );
        $setup->getConnection()->addColumn(
            $setup->getTable('kishor_trainer_table'),
            'deleted',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                'nullable' => true,
                'comment' => 'deleted'
            ]
        );
         $setup->getConnection()->addColumn(
            $setup->getTable('kishor_trainer_table'),
            'status',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                'nullable' => true,
                'comment' => 'deleted'
            ]
        );
        $setup->getConnection()
            ->addForeignKey(
                $setup->getFkName(
                    'kishor_trainer_table',                   // priTableName
                    'order_id',                  // priColumnName
                    'sales_order',                          // refTableName
                    'id'                                 // refColumnName
                ),
                $setup->getTable('kishor_trainer_table'),
                'order_id',                      // column
                $setup->getTable('sales_order'), 
                'id',                                    // refColumn
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE // onDelete
    );
}
}

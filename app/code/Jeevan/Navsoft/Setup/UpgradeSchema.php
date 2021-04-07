<?php 
namespace Jeevannew\Nav\Setup;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;
class UpgradeSchema implements \Magento\Framework\Setup\UpgradeSchemaInterface{
 
	public function upgrade(SchemaSetupInterface $setup,ModuleContextInterface $context){
        $setup->startSetup();
        if (version_compare($context->getVersion(), '1.0.0', '<')) {
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
            $setup->getTable('jeevan_navsoft_table'),
            'taxvat',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'nullable' => true,
                'comment' => 'TaxVat',
                'LENGTH'=>255
            ]
        );
        $setup->getConnection()->changeColumn(
            $setup->getTable('jeevan_navsoft_table'),
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
            $setup->getTable('jeevan_navsoft_table'),
            'deleted',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                'nullable' => true,
                'comment' => 'deleted'
            ]
        );
         $setup->getConnection()->addColumn(
            $setup->getTable('jeevan_navsoft_table'),
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
                    'jeevan_navsoft_table',                   // priTableName
                    'order_id',                  // priColumnName
                    'sales_order',                          // refTableName
                    'id'                                 // refColumnName
                ),
                $setup->getTable('jeevan_navsoft_table'),
                'order_id',                      // column
                $setup->getTable('sales_order'), 
                'id',                                    // refColumn
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE // onDelete
    );
}
}

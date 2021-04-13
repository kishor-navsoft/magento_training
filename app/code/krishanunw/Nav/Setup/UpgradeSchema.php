<?php 
namespace krishanunw\Nav\Setup;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;
class UpgradeSchema implements \Magento\Framework\Setup\UpgradeSchemaInterface{
 
	public function upgrade(SchemaSetupInterface $setup,ModuleContextInterface $context){
        $setup->startSetup();
        if (version_compare($context->getVersion(), '1.1.2', '<')) {
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
            $setup->getTable('krishanunw_table'),
            'taxvat',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'nullable' => true,
                'comment' => 'TaxVat',
                'LENGTH'=>255
            ]
        );
        $setup->getConnection()->addColumn(
            $setup->getTable('krishanunw_table'),
            'status',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                'nullable' => true,
                'comment' => 'status',
                'LENGTH'=>1
            ]
        );
         $setup->getConnection()->dropColumn($setup->getTable('krishanunw_table'), 'order_id');
         $setup->getConnection()->addColumn(
            $setup->getTable('krishanunw_table'),
            'order_id',
            [
             'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
             'nullable' => false,
             'unsigned' =>true,
             'comment' => 'OrderId',
             'LENGTH'=>10
            ]
        );
        
        $setup->getConnection()
            ->addForeignKey(
                $setup->getFkName(
                    'krishanunw_table',                   // priTableName
                    'order_id',                  // priColumnName
                    'sales_order',                          // refTableName
                    'entity_id'                                 // refColumnName
                ),
                $setup->getTable('krishanunw_table'),
                'order_id',                      // column
                $setup->getTable('sales_order'), 
                'entity_id',                                    // refColumn
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE // onDelete
    );
}
}

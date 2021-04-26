<?php

namespace Jeevannew\Nav\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        // Get tutorial_simplenews table
        $tableName = $installer->getTable('jeevannew_nav_table');
        // Check if the table already exists
        if ($installer->getConnection()->isTableExists($tableName) != true) {
            // Create tutorial_simplenews table
            $table = $installer->getConnection()
                ->newTable($tableName)
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'ID'
                )
                ->addColumn(
                    'order_id',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'default' => ''],
                    'OrderId'
                )
                ->setComment('New Order Table')
                ->setOption('type', 'InnoDB')
                ->setOption('charset', 'utf8');
            $installer->getConnection()->createTable($table);
    //         $installer->getConnection()->addForeignKey(
    //             $setup->getFkName(
    //                 'jeevannew_nav_table',                   // priTableName
    //                 'order_id',                  // priColumnName
    //                 'sales_order',                          // refTableName
    //                 'entity_id'                                 // refColumnName
    //             ),
    //             $setup->getTable('jeevannew_nav_table'),
    //             'order_id',                      // column
    //             $setup->getTable('sales_order'), 
    //             'entity_id',                                    // refColumn
    //             \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE // onDelete
    // );
        }

        $installer->endSetup();
    }
}
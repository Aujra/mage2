<?php


namespace Kind\Ingreidents\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\InstallSchemaInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        $table_kind_ingreidents_ingredient = $setup->getConnection()->newTable($setup->getTable('kind_ingreidents_ingredient'));

        
        $table_kind_ingreidents_ingredient->addColumn(
            'ingredient_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,),
            'Entity ID'
        );
        

        
        $table_kind_ingreidents_ingredient->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            100,
            [],
            'name'
        );
        

        
        $table_kind_ingreidents_ingredient->addColumn(
            'content',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'content'
        );
        

        
        $table_kind_ingreidents_ingredient->addColumn(
            'images',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'images'
        );
        

        $setup->getConnection()->createTable($table_kind_ingreidents_ingredient);

        $setup->endSetup();
    }
}

<?php


namespace Kind\Ingreidents\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $setup->startSetup();

        $version = $context->getVersion();
        $connection = $setup->getConnection();
        $tablename = "kind_ingreidents_ingredient";
        if (version_compare($version, '1.0.3') < 0)
            $connection->addColumn(
                $setup->getTable($tablename),
                'products',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'comment' =>'Assigned Products',
                    'nullable' => true,
                ]
            );
        $setup->endSetup();
    }
}

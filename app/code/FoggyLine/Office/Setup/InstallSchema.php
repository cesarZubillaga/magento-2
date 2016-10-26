<?php

namespace FoggyLine\Office\Setup;


use FoggyLine\Office\Model\Employee;
use League\CLImate\TerminalObject\Basic\Tab;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $this->department($setup);
        $this->employee($setup);
        $tables = [];
        $tables[Employee::EAV_ENTITY_TABLE_DATETIME] = array(
            'type' => Table::TYPE_DATETIME,
            'size' => [],
            'options' => [],
            'comment' => '',

        );
        $tables[Employee::EAV_ENTITY_TABLE_DECIMAL] = array(
            'type' => Table::TYPE_DECIMAL,
            'size' => '12,4',
            'options' => [],

        );
        $tables[Employee::EAV_ENTITY_TABLE_TEXT] = array(
            'type' => Table::TYPE_TEXT,
            'size' => [],
            'options' => [],

        );
        $tables[Employee::EAV_ENTITY_TABLE_INT] = array(
            'type' => Table::TYPE_INTEGER,
            'size' => [],
            'options' => [],

        );
        $tables[Employee::EAV_ENTITY_TABLE_VARCHAR] = array(
            'type' => Table::TYPE_TEXT,
            'size' => 55,
            'options' => [],

        );
        foreach ($tables as $table=>$value){
            $this->createEav($setup, $table,  $value['type'], $value['size'],  $value['options']);
        }
        $setup->endSetup();
    }

    /**
     * @param SchemaSetupInterface $setup
     */
    private function department(SchemaSetupInterface $setup)
    {
        $table = $setup->getConnection()
            ->newTable($setup->getTable('foggyline_office_department'))
            ->addColumn(
                'entity_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Entity_ID'
            )
            ->addColumn(
                'name',
                Table::TYPE_TEXT,
                64,
                [],
                'Name'
            )
            ->setComment('Foggyline Office Department Table')
        ;
        $setup->getConnection()->createTable($table);
    }

    /**
     * @param SchemaSetupInterface $setup
     */
    private function employee(SchemaSetupInterface $setup)
    {
        $table = $setup->getConnection()
            ->newTable($setup->getTable(Employee::EAV_ENTITY_TABLE))
            ->addColumn(
                'entity_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Entity_ID'
            )
            ->addColumn(
                'department_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Department_Id'
            )
            ->addColumn(
                'email',
                Table::TYPE_TEXT,
                64,
                [],
                'Email'
            )
            ->addColumn(
                'first_name',
                Table::TYPE_TEXT,
                64,
                [],
                'First Name'
            )
            ->addColumn(
                'last_name',
                Table::TYPE_TEXT,
                64,
                [],
                'Last Name'
            )
            ->setComment('Foogyline Office Employee Table')
        ;
        $setup->getConnection()->createTable($table);
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param $table
     * @param $type
     * @param array $options
     */
    private function createEav(SchemaSetupInterface $setup, $table, $type, $size, array $options)
    {
        $aIndex = ['entity_id', 'attribute_id', 'store_id'];
        $table = $setup->getConnection()
            ->newTable($setup->getTable($table))
            ->addColumn(
                'value_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Value_ID'
            )
            ->addColumn(
                'attribute_id',
                Table::TYPE_SMALLINT,
                null,
                ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                'Attribute ID'
            )
            ->addColumn(
                'store_id',
                Table::TYPE_SMALLINT,
                null,
                ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                'Store ID'
            )
            ->addColumn(
                'entity_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                'Entity ID'
            )
            ->addColumn(
                'value',
                $type,
                $size,
                $options,
                'Value'
            )
            ->addIndex(
                $setup->getIdxName(
                    $table,
                    $aIndex,
                    AdapterInterface::INDEX_TYPE_UNIQUE
                ),
                $aIndex,
                ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
            )
            ->addIndex(
                $setup->getIdxName($table,
                    ['store_id']
                ),
                ['store_id']
            )
            ->addIndex(
                $setup->getIdxName($table,
                    ['attribute_id']
                ),
                ['attribute_id']
            )
            ->addForeignKey(
                $setup->getFkName($table,
                    'attribute_id',
                    'eav_attribute',
                    'attribute_id'
                ),
                'attribute_id',
                $setup->getTable('eav_attribute'),
                'attribute_id',
                Table::ACTION_CASCADE
            )
            ->addForeignKey(
                $setup->getFkName($table,
                    'entity_id',
                    Employee::EAV_ENTITY_TABLE,
                    'entity_id'
                ),
                'entity_id',
                $setup->getTable(Employee::EAV_ENTITY_TABLE),
                'entity_id',
                Table::ACTION_CASCADE
            )
            ->addForeignKey(
                $setup->getFkName($table,
                    'store_id',
                    'store',
                    'store_id'
                ),
                'store_id',
                $setup->getTable('store'),
                'store_id',
                Table::ACTION_CASCADE
            )
            ->setComment('Employee Decimal Attribute Backend Table')
        ;
        $setup->getConnection()->createTable($table);
    }

}
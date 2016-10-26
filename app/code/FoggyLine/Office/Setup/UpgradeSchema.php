<?php
namespace FoggyLine\Office\Setup;


use FoggyLine\Office\Model\Department;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use FoggyLine\Office\Model\Employee;
use \Magento\Framework\DB\Ddl\Table;
/**
 * @codeCoverageIgnore
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $employeeEntityTable    = Employee::EAV_ENTITY_TABLE;
        $departmentEntityTable  = Department::ENTITY;
        $setup->getConnection()
            ->addForeignKey(
                $setup->getFkName($employeeEntityTable, 'department_id', $departmentEntityTable, 'entity_id'),
                $setup->getTable($employeeEntityTable),
                'department_id',
                $setup->getTable($departmentEntityTable),
                'entity_id',
                Table::ACTION_CASCADE
            );
        $setup->endSetup();
    }
}

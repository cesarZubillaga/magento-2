<?php
namespace FoggyLine\Office\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use FoggyLine\Office\Model\Employee;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var \FoggyLine\Office\Setup\EmployeeSetupFactory
     */
    private $employeeSetupFactory;

    public function __construct(\FoggyLine\Office\Setup\EmployeeSetupFactory $employeeSetupFactory)
    {
        $this->employeeSetupFactory = $employeeSetupFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $employeeSetup = $this->employeeSetupFactory->create(['setup' => $setup]);
        $employeeSetup->installEntities();
        $employeeSetup->addAttribute(
            Employee::ENTITY, 'service_years', ['type' => 'int']
        );
        $employeeSetup->addAttribute(
            Employee::ENTITY, 'dob', ['type' => 'datetime']
        );
        $employeeSetup->addAttribute(
            Employee::ENTITY, 'salary', ['type' => 'decimal']
        );
        $employeeSetup->addAttribute(
            Employee::ENTITY, 'vat_number', ['type' => 'varchar']
        );
        $employeeSetup->addAttribute(
            Employee::ENTITY, 'note', ['type' => 'text']
        );
        $setup->endSetup();
    }
}
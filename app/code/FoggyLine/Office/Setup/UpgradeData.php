<?php

namespace FoggyLine\Office\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use \FoggyLine\Office\Model\DepartmentFactory;
use \FoggyLine\Office\Model\EmployeeFactory;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var DepartmentFactory
     */
    protected $departmentFactory;

    /**
     * @var EmployeeFactory
     */
    protected $employeeFactory;

    /**
     * UpgradeData constructor.
     * @param DepartmentFactory $departmentFactory
     * @param EmployeeFactory $employeeFactory
     */
    public function __construct(DepartmentFactory $departmentFactory, EmployeeFactory $employeeFactory)
    {
        $this->departmentFactory    = $departmentFactory;
        $this->employeeFactory      = $employeeFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        //TODO: Create new instance of the entity.
        $setup->endSetup();
    }
}
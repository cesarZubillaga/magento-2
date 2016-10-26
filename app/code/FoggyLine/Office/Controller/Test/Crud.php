<?php

namespace FoggyLine\Office\Controller\Test;

use FoggyLine\Office\Controller\Test;
use FoggyLine\Office\Model\DepartmentFactory;
use Magento\Framework\App\Action\Context;
use FoggyLine\Office\Model\EmployeeFactory;

class Crud extends Test
{
    protected $employee;

    protected $department;

    public function __construct(Context $context, EmployeeFactory $employee, DepartmentFactory $department)
    {
        $this->employee     = $employee;
        $this->department   = $department;
        return parent::__construct($context);
    }

    public function execute()
    {
        $department = ($this->getRequest()->getParam('department'));
        // TODO: Implement execute() method.
        if($department){
            $name = ($this->getRequest()->getParam('name'));
            $department = $this->department->create();
            $department->setName($name);
            $department->save();
        }else{
            $employee = $this->employee->create();

            $employee
                ->load(1)
                ->setVatNumber(1234)
                ->setNote(rand(12.00,30.00))
                ->setFirstName('César Zubillaga')
                ->setSalary(rand(12.00,30.00))
                ->setServiceYears(rand(1,10))
                ->setDob('2016-01-01')
                ->setDepartmentId(2)
            ;
            $employee->save();
            echo 'Success';
        }
    }

}
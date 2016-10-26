<?php
namespace FoggyLine\Office\Setup;

use Magento\Eav\Setup\EavSetup;
use \FoggyLine\Office\Model\Employee;

class EmployeeSetup extends EavSetup
{
    public function getDefaultEntities()
    {
        $entities = [
            Employee::ENTITY => [
                'entity_model' => 'FoggyLine\Office\Model\ResourceModel\Employee',
                'table' => Employee::EAV_ENTITY_TABLE,
                'attributes' => [
                    'department_id' => [
                        'type' => 'static',
                    ],
                    'email' => [
                        'type' => 'static',
                    ],
                    'first_name' => [
                        'type' => 'static',
                    ],
                    'last_name' => [
                        'type' => 'static',
                    ],
                ],
            ],
        ];
        return $entities;
    }
}
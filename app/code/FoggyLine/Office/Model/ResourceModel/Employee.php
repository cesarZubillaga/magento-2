<?php
namespace FoggyLine\Office\Model\ResourceModel;

use Magento\Eav\Model\Entity\AbstractEntity;

class Employee extends AbstractEntity
{
    /**
     * The read and write connections m ust be named, else, Magento produces an error using this entities.
     */
    protected function _construct()
    {
        $this->_read    = 'foggyline_office_employee_read';
        $this->_write   = 'foggyline_office_employee_write';
    }

    public function getEntityType()
    {
        if (empty($this->_type)) {
            $this->setType(\FoggyLine\Office\Model\Employee::ENTITY);
        }
        return parent::getEntityType();
    }
}
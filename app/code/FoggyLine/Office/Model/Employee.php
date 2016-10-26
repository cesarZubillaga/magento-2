<?php
namespace FoggyLine\Office\Model;

use Magento\Framework\Model\AbstractModel;

class Employee extends  AbstractModel
{
    const DEPARTMENT_ID = 'department_id';
    const VAT_NUMBER    = 'vat_number';
    const SERVICE_YEARS = 'service_years';
    const DOB           = 'dob';
    const SALARY        = 'salary';
    const NOTE          = 'note';

    const ENTITY                    = 'foggyline_office_employee';
    const EAV_ENTITY_TABLE          = 'foggyline_office_employee_entity';
    const EAV_ENTITY_TABLE_DECIMAL  = 'foggyline_office_employee_entity_decimal';
    const EAV_ENTITY_TABLE_DATETIME = 'foggyline_office_employee_entity_datetime';
    const EAV_ENTITY_TABLE_INT      = 'foggyline_office_employee_entity_int';
    const EAV_ENTITY_TABLE_TEXT     = 'foggyline_office_employee_entity_text';
    const EAV_ENTITY_TABLE_VARCHAR  = 'foggyline_office_employee_entity_varchar';

    static function getEavTables()
    {
        return array(
            self::EAV_ENTITY_TABLE,
            self::EAV_ENTITY_TABLE_DECIMAL,
            self::EAV_ENTITY_TABLE_DATETIME,
            self::EAV_ENTITY_TABLE_INT,
            self::EAV_ENTITY_TABLE_TEXT,
        );
    }

    public function _construct()
    {
        $this->_init('FoggyLine\Office\Model\ResourceModel\Employee');
    }

    /**
     * @param $value
     * @return $this
     */
    public function setVatNumeber($value)
    {
        return $this->setData(self::VAT_NUMBER, $value);
    }
    /**
     * @param $value
     * @return $this
     */
    public function setVatNumeber($value)
    {
        return $this->setData(self::VAT_NUMBER, $value);
    }
    /**
     * @param $value
     * @return $this
     */
    public function setVatNumeber($value)
    {
        return $this->setData(self::VAT_NUMBER, $value);
    }
    /**
     * @param $value
     * @return $this
     */
    public function setVatNumeber($value)
    {
        return $this->setData(self::VAT_NUMBER, $value);
    }
    /**
     * @param $value
     * @return $this
     */
    public function setVatNumeber($value)
    {
        return $this->setData(self::VAT_NUMBER, $value);
    }

    /**
     * @param $departamentId
     * @return $this
     */
    public function setDepartamentId($value)
    {
        return $this->setData(self::DEPARTMENT_ID, $value);
    }
}
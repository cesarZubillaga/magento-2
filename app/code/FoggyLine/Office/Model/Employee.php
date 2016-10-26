<?php
namespace FoggyLine\Office\Model;

use Magento\Framework\Model\AbstractModel;

class Employee extends AbstractModel
{
    const DEPARTMENT_ID = 'department_id';
    const VAT_NUMBER = 'vat_number';
    const SERVICE_YEARS = 'service_years';
    const DOB = 'dob';
    const SALARY = 'salary';
    const NOTE = 'note';
    const FIRST_NAME = 'first_name';
    const EMAIL = 'email';

    const ENTITY = 'foggyline_office_employee';
    const EAV_ENTITY_TABLE = 'foggyline_office_employee_entity';
    const EAV_ENTITY_TABLE_DECIMAL = 'foggyline_office_employee_entity_decimal';
    const EAV_ENTITY_TABLE_DATETIME = 'foggyline_office_employee_entity_datetime';
    const EAV_ENTITY_TABLE_INT = 'foggyline_office_employee_entity_int';
    const EAV_ENTITY_TABLE_TEXT = 'foggyline_office_employee_entity_text';
    const EAV_ENTITY_TABLE_VARCHAR = 'foggyline_office_employee_entity_varchar';

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
     * @param $departamentId
     * @return $this
     */
    public function setDepartmentId($value)
    {
        return $this->setData(self::DEPARTMENT_ID, $value);
    }

    /**
     * @param $value
     * @return $this
     */
    public function setEmail($value)
    {
        return $this->setData(self::EMAIL, $value);
    }

    /**
     * @param $value
     * @return $this
     */
    public function setFirstName($value)
    {
        return $this->setData(self::FIRST_NAME, $value);
    }

    /**
     * @param $value
     * @return $this
     */
    public function setServiceYears($value)
    {
        return $this->setData(self::SERVICE_YEARS, $value);
    }

    /**
     * @param $value
     * @return $this
     */
    public function setDob($value)
    {
        return $this->setData(self::DOB, $value);
    }

    /**
     * @param $value
     * @return $this
     */
    public function setSalary($value)
    {
        return $this->setData(self::SALARY, $value);
    }

    /**
     * @param $value
     * @return $this
     */
    public function setNote($value)
    {
        return $this->setData(self::NOTE, $value);
    }

    /**
     * @param $value
     * @return $this
     */
    public function setVatNumber($value)
    {
        return $this->setData(self::VAT_NUMBER, $value);
    }

    /**
     * @param $value
     * @return $this
     */
    public function getDepartmentId($value)
    {
        return $this->setData(self::DEPARTMENT_ID, $value);
    }

    /**
     * @return $this
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * @return $this
     */
    public function getFirstName()
    {
        return $this->getData(self::FIRST_NAME);
    }

    /**
     * @return $this
     */
    public function getServiceYears()
    {
        return $this->getData(self::SERVICE_YEARS);
    }

    /**
     * @return $this
     */
    public function getDob()
    {
        return $this->getData(self::DOB);
    }

    /**
     * @return $this
     */
    public function getSalary()
    {
        return $this->getData(self::SALARY);
    }

    /**
     * @return $this
     */
    public function getNote()
    {
        return $this->getData(self::NOTE);
    }

    /**
     * @return $this
     */
    public function getVatNumber()
    {
        return $this->getData(self::VAT_NUMBER);
    }
}
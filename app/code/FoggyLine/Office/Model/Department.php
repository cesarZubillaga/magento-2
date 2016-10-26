<?php
namespace FoggyLine\Office\Model;

use Magento\Framework\Model\AbstractModel;

class Department extends AbstractModel
{
    const NAME      = 'name';
    const ENTITY    = 'foggyline_office_department';

    protected function _construct()
    {
        $this->_init('FoggyLine\Office\Model\ResourceModel\Department');
    }

    public function setName($value)
    {
        return $this->setData(self::NAME, $value);
    }
}
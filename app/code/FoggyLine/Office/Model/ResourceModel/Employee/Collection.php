<?php
namespace FoggyLine\Office\Model\ResourceModel\Employee;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'FoggyLine\Office\Model\Employee',
            'FoggyLine\Office\Model\ResourceModel\Employee'
            );
    }
}
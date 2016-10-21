<?php
namespace FoggyLine\Office\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'FoggyLine\Office\Model\Department',
            'FoggyLine\Office\Model\ResourceModel\Department'
            );
    }
}
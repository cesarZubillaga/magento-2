<?php

namespace FoggyLine\Office\Model;

use Magento\Framework\Model\AbstractModel;

class Departament extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('FoggyLine\Office\Model\ResourceModel\Department');
    }
}
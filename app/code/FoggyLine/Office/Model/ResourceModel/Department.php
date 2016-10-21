<?php
namespace FoggyLine\Office\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 21/10/2016
 * Time: 16:33
 */
class Department extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('foggyline_office_department', 'entity_id');
    }
}
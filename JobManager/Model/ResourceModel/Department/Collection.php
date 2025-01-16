<?php

namespace Learning\JobManager\Model\ResourceModel\Department;

class  Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    protected function _construct()
    {
        $this->_init('Learning\JobManager\Model\Department', 'department_id');
    }
}

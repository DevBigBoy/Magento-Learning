<?php

namespace Learning\JobManager\Model;

use Magento\Framework\Model\AbstractModel;

class Department  extends AbstractModel
{

    protected function _construct()
    {
        $this->_init('Learning\JobManager\Model\ResourceModel\Department');
    }

}

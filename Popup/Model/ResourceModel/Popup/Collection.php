<?php

namespace Learning\Popup\Model\ResourceModel\Popup;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Learning\Popup\Model\Popup;
use Learning\Popup\Model\ResourceModel\Popup as PopupResource;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Popup::class, PopupResource::class);
    }
}

<?php

namespace Learning\Popup\Model\ResourceModel\Popup;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Learning\Popup\Model\Popup as ModelPopup;
use Learning\Popup\Model\ResourceModel\Popup as ModelPopupResource;

class Collection extends AbstractCollection
{
    protected function _construct(){
        $this->_init(
            ModelPopup::class,
            ModelPopupResource::class
        );
    }
}

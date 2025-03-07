<?php

namespace Learning\Popup\Model;

use Learning\Popup\Api\Data\PopupInterface;
use Magento\Framework\Model\AbstractModel;
use Learning\Popup\Model\ResourceModel\Popup as PopupResource;

class Popup extends AbstractModel implements PopupInterface
{

    protected function _construct()
    {
        $this->_init(PopupResource::class);
    }


    public function getName()
    {
        // TODO: Implement getName() method.
    }

    public function getContent()
    {
        // TODO: Implement getContent() method.
    }

    public function getCreatedAt()
    {
        // TODO: Implement getCreatedAt() method.
    }

    public function getUpdatedAt()
    {
        // TODO: Implement getUpdatedAt() method.
    }

    public function getIsActive()
    {
        // TODO: Implement getIsActive() method.
    }

    public function getTimeOut()
    {
        // TODO: Implement getTimeOut() method.
    }

    public function setName($name)
    {
        // TODO: Implement setName() method.
    }

    public function setContent($content)
    {
        // TODO: Implement setContent() method.
    }

    public function setCreatedAt($createdAt)
    {
        // TODO: Implement setCreatedAt() method.
    }

    public function setUpdatedAt($updatedAt)
    {
        // TODO: Implement setUpdatedAt() method.
    }

    public function setIsActive($isActive)
    {
        // TODO: Implement setIsActive() method.
    }

    public function setTimeOut($timeout)
    {
        // TODO: Implement setTimeOut() method.
    }
}

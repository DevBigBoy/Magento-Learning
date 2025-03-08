<?php

namespace Learning\Popup\Model;

use Learning\Popup\Api\Data\PopupInterface;
use Magento\Framework\Model\AbstractModel;
use Learning\Popup\Model\ResourceModel\Popup as PopupResource;

class Popup extends AbstractModel implements PopupInterface
{

    protected function _construct()
    {
        $this->_eventPrefix = 'learning_popup';
        $this->_eventObject = 'popup';
        $this->_idFieldName = 'popup_id';

        $this->_init(PopupResource::class);
    }

    public function getPopupId(): int
    {
        return $this->getData(self::POPUP_ID);
    }

    public function setPopupId(int $id): PopupInterface
    {
        return $this->setData(self::POPUP_ID, $id);
    }

    public function getName(): string
    {
        return $this->getData(self::NAME);
    }

    public function setName(string $name): PopupInterface
    {
        return $this->setData(self::NAME, $name);
    }

    public function getContent(): string
    {
        return $this->getData(self::CONTENT);
    }

    public function setContent(string $content): PopupInterface
    {
        return $this->setData(self::CONTENT, $content);
    }

    public function setCreatedAt(string $createdAt): PopupInterface
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    public function setUpdatedAt(string $updatedAt): PopupInterface
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    public function setIsActive($isActive): PopupInterface
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    public function getIsActive(): bool
    {
        return $this->getData(self::IS_ACTIVE);
    }

    public function getTimeOut(): int
    {
        return $this->getData(self::TIME_OUT);
    }

    public function setTimeOut(int $timeout): PopupInterface
    {
        return $this->setData(self::TIME_OUT, $timeout);
    }
}

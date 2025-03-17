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

    /**
     * @return int
     */
    public function getPopupId(): int
    {
        return (int) $this->getData(self::POPUP_ID);
    }

    /**
     * @param int $id
     * @return \Learning\Popup\Api\Data\PopupInterface
     */
    public function setPopupId(int $id): PopupInterface
    {
        return $this->setData(self::POPUP_ID, $id);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->getData(self::NAME);
    }

    /**
     * @param string $name
     * @return \Learning\Popup\Api\Data\PopupInterface
     */
    public function setName(string $name): PopupInterface
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * @param string $content
     * @return \Learning\Popup\Api\Data\PopupInterface
     */
    public function setContent(string $content): PopupInterface
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * @param string $createdAt
     * @return \Learning\Popup\Api\Data\PopupInterface
     */
    public function setCreatedAt(string $createdAt): PopupInterface
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @param string $updatedAt
     * @return \Learning\Popup\Api\Data\PopupInterface
     */
    public function setUpdatedAt(string $updatedAt): PopupInterface
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * @param bool $isActive
     * @return PopupInterface
     */
    public function setIsActive(bool $isActive): PopupInterface
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * @return bool
     */
    public function getIsActive(): bool
    {
        return $this->getData(self::IS_ACTIVE);
    }

    /**
     * @return int
     */
    public function getTimeOut(): int
    {
        return (int) $this->getData(self::TIME_OUT);
    }

    /**
     * @param int $timeout
     * @return \Learning\Popup\Api\Data\PopupInterface
     */
    public function setTimeOut(int $timeout): PopupInterface
    {
        return $this->setData(self::TIME_OUT, $timeout);
    }
}

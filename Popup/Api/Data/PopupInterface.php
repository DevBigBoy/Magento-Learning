<?php

namespace Learning\Popup\Api\Data;

interface PopupInterface
{
    const POPUP_ID = 'popup_id';
    const NAME = 'name';
    const CONTENT = 'content';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const IS_ACTIVE = 'is_active';
    const TIME_OUT = 'time_out';

    const DISABLED = 0;
    const ENABLED = 1;

    /**
     * @return int
     */
    public function getPopupId(): int;

    /**
     * @param int $id
     * @return \Learning\Popup\Api\Data\PopupInterface
     */
    public function setPopupId(int $id): PopupInterface;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return \Learning\Popup\Api\Data\PopupInterface
     */
    public function setName(string $name): PopupInterface;

    /**
     * @return string
     */
    public function getContent(): string;

    /**
     * @param string $content
     * @return PopupInterface
     */
    public function setContent(string $content): PopupInterface;


    /**
     * @param string $createdAt
     * @return \Learning\Popup\Api\Data\PopupInterface
     */
    public function setCreatedAt(string $createdAt): PopupInterface;

    /**
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * @return string
     */
    public function getUpdatedAt(): string;

    /**
     * @param string $updatedAt
     * @return \Learning\Popup\Api\Data\PopupInterface
     */
    public function setUpdatedAt(string $updatedAt): PopupInterface;

    /**
     * @param bool $isActive
     * @return \Learning\Popup\Api\Data\PopupInterface
     */
    public function setIsActive(bool $isActive): PopupInterface;

    /**
     * @return bool
     */
    public function getIsActive(): bool;

    /**
     * @return int
     */
    public function getTimeOut(): int;

    /**
     * @param int $timeout
     * @return \Learning\Popup\Api\Data\PopupInterface
     */
    public function setTimeOut(int $timeout): PopupInterface;

}

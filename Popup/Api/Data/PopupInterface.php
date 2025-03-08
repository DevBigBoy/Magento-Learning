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

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getPopupId(): ?int;

    /**
     * Set ID
     *
     * @param int $id
     * @return PopupInterface
     */
    public function setPopupId(int $id): PopupInterface;

    /**
     * Get Name
     *
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * Set Name
     *
     * @param string $name
     * @return PopupInterface
     */
    public function setName(string $name): PopupInterface;

    /**
     * Get content
     *
     * @return string|null
     */

    public function getContent(): ?string;
    /**
     * Set content
     *
     * @param string $content
     * @return PopupInterface
     */
    public function setContent(string $content): PopupInterface;


    /**
     * Set creation time
     *
     * @param string $createdAt
     * @return PopupInterface
     */
    public function setCreatedAt(string $createdAt): PopupInterface;

    /**
     * Get Created at
     *
     * @return string|null
     */

    public function getCreatedAt();

    /**
     * Get Updated at
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set update time
     *
     * @param string $updatedAt
     * @return PopupInterface
     */
    public function setUpdatedAt(string $updatedAt): PopupInterface;

    /**
     * Set is active
     *
     * @param bool|int $isActive
     * @return PopupInterface
     */
    public function setIsActive($isActive): PopupInterface;

    /**
     * Is active
     *
     * @return bool|null
     */
    public function getIsActive(): ?bool;

    /**
     * Get Time out
     *
     * @return int|null
     */

    public function getTimeOut(): ?int;

    /**
     * Set Time Out
     *
     * @param int $timeout
     * @return PopupInterface
     */
    public function setTimeOut(int $timeout): PopupInterface;

}

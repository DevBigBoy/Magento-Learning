<?php

namespace Learning\Popup\Api;

use Learning\Popup\Api\Data\PopupInterface;

interface PopupRepositoryInterface
{
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Learning\Popup\Api\Data\PopupSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * @param PopupInterface $popup
     * @return int
     */
    public function save(PopupInterface $popup): int;

    /**
     * @param int $popupId
     * @return \Learning\Popup\Api\Data\PopupInterface
     * @throws Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById(int $popupId): PopupInterface;

    /**
     * @param \Learning\Popup\Api\Data\PopupInterface $popup
     * @return void
     */
    public function delete(PopupInterface $popup): void;

    /**
     * @param int $popupId
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws  \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById(int $popupId): bool;
}

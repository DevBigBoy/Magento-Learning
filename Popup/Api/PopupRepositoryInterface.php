<?php

namespace Learning\Popup\Api;

use Learning\Popup\Api\Data\PopupInterface;
use Magento\Framework\Exception\NoSuchEntityException;

interface PopupRepositoryInterface
{
    public function getList();

    public function save(PopupInterface $popup): void;

    /**
     * @param int $popupId
     * @return PopupInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $popupId): PopupInterface;

    public function delete(PopupInterface $popup): void;

    public function deleteById(PopupInterface $popupId): bool;
}

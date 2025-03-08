<?php

namespace Learning\Popup\Api;

use Learning\Popup\Api\Data\PopupInterface;

interface PopupRepositoryInterface
{
    public function getList();

    public function save(PopupInterface $popup);

    public function getById($popupId);

    public function delete(PopupInterface $popup);

    public function deleteById($popupId);
}

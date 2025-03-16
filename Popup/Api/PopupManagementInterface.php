<?php

namespace Learning\Popup\Api;

use Learning\Popup\Api\Data\PopupInterface;

interface PopupManagementInterface
{
    /**
     * @return PopupInterface
     */
    public function getApplicablePopup(): PopupInterface;

}

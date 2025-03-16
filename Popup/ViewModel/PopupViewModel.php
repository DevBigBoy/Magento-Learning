<?php

namespace Learning\Popup\ViewModel;


use Learning\Popup\Api\Data\PopupInterface;
use Learning\Popup\Api\PopupManagementInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class PopupViewModel implements ArgumentInterface
{

    /**
     * @param PopupManagementInterface $popupManagement
     */
    public function __construct(
        private readonly PopupManagementInterface $popupManagement,
    )
    {}

    public function getPopup(): PopupInterface
    {
        return $this->popupManagement->getApplicablePopup();
    }
}

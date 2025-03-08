<?php

namespace Learning\Popup\Controller\Adminhtml\Index;


use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;

class Index extends Action
{
    public function execute(): ResultInterface
    {
        /** @var Page $resultPage  */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        /** ID From Menu Item id */
        $resultPage->setActiveMenu('Learning_Popup::popup');
        $resultPage->addBreadcrumb(__('Popup'), __('Popup'));
        $resultPage->addBreadcrumb(__('Manage Popups'), __('Manage Popups'));
        $resultPage->getConfig()->getTitle()->prepend(__('Popups'));
        return $resultPage;
    }
}

<?php

declare(strict_types=1);

namespace Learning\JobManager\Controller\Adminhtml\Department;

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
        $resultPage->setActiveMenu('Learning_JobManager::department');
        $resultPage->addBreadcrumb(__('Department'), __('Department'));
        $resultPage->addBreadcrumb(__('Manage Departments'), __('Manage Departments'));
        $resultPage->getConfig()->getTitle()->prepend(__('Departments'));
        return $resultPage;
    }
}

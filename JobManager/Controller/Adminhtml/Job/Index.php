<?php

declare(strict_types=1);

namespace Learning\JobManager\Controller\Adminhtml\Job;

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
        $resultPage->setActiveMenu('Learning_JobManager::job');
        $resultPage->addBreadcrumb(__('Job'), __('Job'));
        $resultPage->addBreadcrumb(__('Manage Jobs'), __('Manage Jobs'));
        $resultPage->getConfig()->getTitle()->prepend(__('Jobs'));
        return $resultPage;
    }
}

<?php

declare(strict_types=1);

namespace Learning\Popup\Controller\Adminhtml\Popup;

use Learning\Popup\Model\Popup;
use Magento\Backend\Model\View\Result\Redirect;
use Learning\Popup\Api\Data\PopupInterfaceFactory;
use Learning\Popup\Api\PopupRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action implements HttpPostActionInterface
{

    private PopupInterfaceFactory $popupFactory;
    private PopupRepositoryInterface $popupRepository;
    private DataPersistorInterface $dataPersistor;

    /**
     * @param PopupInterfaceFactory $popup
     * @param PopupRepositoryInterface $popupRepository
     * @param DataPersistorInterface $dataPersistor
     * @param Context $context
     */
    public function __construct(
        PopupInterfaceFactory   $popupFactory,
        PopupRepositoryInterface $popupRepository,
        DataPersistorInterface $dataPersistor,
        Context $context
    )
    {
        $this->popupFactory = $popupFactory;
        $this->popupRepository = $popupRepository;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            if (isset($data['is_active']) && $data['is_active'] === 'true') {
                $data['is_active'] = 1;
            }
            if (empty($data['popup_id'])) {
                $data['popup_id'] = null;
            }

            /** @var Popup $model */
            $popup = $this->popupFactory->create();
            $id = (int) $this->getRequest()->getParam('popup_id');

            if ($id) {
                try {
                    $popup = $this->popupRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This popup no longer exists.'));
                    return  $resultRedirect->setPath('*/*/');
                }
            }

            $popup->setData($data);

            try {
                $this->popupRepository->save($popup);
                $this->messageManager->addSuccessMessage(__('The popup has been saved.'));
                $this->dataPersistor->clear('manage_popup_popup');
                return  $resultRedirect->setPath('*/*/');
            }catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the popup.'));
            }

            $this->dataPersistor->set('manage_popup_popup', $data);
            return $resultRedirect->setPath('*/*/edit', ['popup_id' => $id]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}

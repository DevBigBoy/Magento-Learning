<?php

namespace Learning\Popup\Ui\Popup;

use Learning\Popup\Model\ResourceModel\Popup\Collection;
use Learning\Popup\Model\ResourceModel\Popup\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Ui\DataProvider\ModifierPoolDataProvider;

class DataProvider extends ModifierPoolDataProvider
{
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    private array $loadedData = [];

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $blockCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     * @param PoolInterface|null $pool
     */
    public function __construct(
       string $name,
       string $primaryFieldName,
       string $requestFieldName,
       CollectionFactory $blockCollectionFactory,
       DataPersistorInterface $dataPersistor,
       array $meta = [],
       array $data = [],
       PoolInterface $pool = null
    ) {
        $this->collection = $blockCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
    }

    /**
     * @return array
     */
    public function getData():array
    {
        if (!empty($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        /** @var \Learning\Popup\Model\Popup $popup */
        foreach ($items as $popup) {
            $this->loadedData[$popup->getId()] = $popup->getData();
        }

        $data = $this->dataPersistor->get('manage_popup_popup');

        if (!empty($data)) {
            $popup = $this->collection->getNewEmptyItem();
            $popup->setData($data);
            $this->loadedData[$popup->getId()] = $popup->getData();
            $this->dataPersistor->clear('manage_popup_popup');
        }

        return $this->loadedData;
    }
}

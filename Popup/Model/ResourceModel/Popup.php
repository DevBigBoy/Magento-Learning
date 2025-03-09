<?php

namespace Learning\Popup\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use phpseclib3\File\ASN1\Maps\ReasonFlags;

class Popup extends AbstractDb
{
    private const TABLE_NAME = 'learning_popup';
    protected const  FIELD_NAME= 'popup_id';

    protected function _construct()
    {
       $this->_init(
         self::TABLE_NAME,
         self::FIELD_NAME
       );
    }

    protected function _beforeSave(AbstractModel $object)
    {
        $object->setData('updated_at', 0);
        return parent::_beforeSave($object);
    }

}

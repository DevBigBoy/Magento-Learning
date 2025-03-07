<?php

namespace Learning\Popup\Api\Data;

use _PHPStan_d5312c05b\React\Http\Client\Client;
use Braintree\Exception\Timeout;

interface PopupInterface
{
    const ID = 'popup_id';
    const NAME = 'name';
    const CONTENT = 'content';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const IS_ACTIVE = 'is_active';
    const TIME_OUT = 'time_out';

    public function getId();
    public function getName();
    public function getContent();
    public function getCreatedAt();
    public function getUpdatedAt();
    public function getIsActive();
    public function getTimeOut();

    public function setId($id);
    public function setName($name);
    public function setContent($content);
    public function setCreatedAt($createdAt);
    public function setUpdatedAt($updatedAt);
    public function setIsActive($isActive);
    public function setTimeOut($timeout);
}

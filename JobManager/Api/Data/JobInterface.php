<?php

namespace Learning\JobManager\Api\Data;

use Aws\DataExchange\DataExchangeClient;
use Composer\Repository\LockArrayRepository;

interface JobInterface
{

    const TABLE_NAME = 'learning_job';
    const FIELD_ID = 'entity_id';

    const TITLE = 'title';
    const TYPE = 'type';
    const LOCATION = 'location';
    const DATE = 'date';
    const DESCRIPTION = 'description';
    const STATUS = 'status';
    const DEPARTMENT_ID = 'department_id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


}

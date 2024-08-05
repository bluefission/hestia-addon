<?php

namespace AddOns\Hestia\Domain\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class UrgencyModel extends Model {
    protected $_table = 'urgencies';
    protected $_fields = [
        'urgency_id',
        'name',
        'created_at',
        'updated_at',
    ];
}
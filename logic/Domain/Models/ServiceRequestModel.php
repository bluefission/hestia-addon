<?php

namespace AddOns\Hestia\Domain\Models;

use App\Domain\Models\User\UserModel;
use BlueFission\BlueCore\Model\ModelSql as Model;

class ServiceRequestModel extends Model {
    protected $_table = 'service_requests';
    protected $_fields = [
        'service_request_id',
        'user_id',
        'lodging_id',
        'title',
        'description',
        'service_category_id',
        'budget',
        'urgency_id',
        'created_at',
        'updated_at',
    ];

    public function images() {
        return $this->descendants(ImageModel::class, 'lodging_id', 'parent_id');
    }

    public function lodging() {
        return $this->ancestor(LodgingModel::class, 'lodging_id');
    }

    public function user() {
        return $this->ancestor(UserModel::class, 'user_id');
    }

    public function category() {
        return $this->ancestor(ServiceCategoryModel::class, 'service_category_id');
    }
}
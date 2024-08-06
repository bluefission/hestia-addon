<?php

namespace AddOns\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;


class ServiceRequest extends ValueObject
{
    public $service_request_id;
    public $profile_id;
    public $lodging_id;
    public $title;
    public $description;
    public $service_category_id;
    public $budget;
    public $urgency_id;
    public $photos;
    public $created_at;
    public $updated_at;
}
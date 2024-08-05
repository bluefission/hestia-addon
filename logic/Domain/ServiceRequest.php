<?php

namespace AddOns\Hestia\Domain\ValueObjects;

class ServiceRequest
{
    public $service_request_id;
    public $user_id;
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
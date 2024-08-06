<?php

namespace AddOns\Hestia\Domain;

use BlueFission\BlueCore\ValueObject;

class Urgency extends ValueObject
{
    public $urgency_id;
    public $name;
    public $description;
    public $created_at;
    public $updated_at;
}
<?php

namespace AddOns\Hestia\Domain\Enums;

enum ServiceChargeTypeEnum: string {
	case FLAT = 'Flat';
	case HOURLY = 'Hourly';
	case MIXED = 'Parts and Labor/Mixed';
}
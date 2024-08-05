<?php

namespace AddOns\Hestia\Domain\Enums;

enum ServiceTimeframeUnitEnum: string {
	case MINUTE = 'Minute';
	case HOUR = 'Hour';
	case DAY = 'Day';
	case WEEK = 'Week';
	case MONTH = 'Month';
	case YEAR = 'Year';
	case RECURRING = 'Recurring';
	case OTHER = 'Other';
	case UNKNOWN = 'Unknown';
}
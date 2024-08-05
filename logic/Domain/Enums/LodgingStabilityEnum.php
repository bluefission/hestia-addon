<?php

namespace AddOns\Hestia\Domain\Enums;

enum LodgingStabilityEnum: string {
	case STABLE = 'Stable';
	case MODERATELY_STABLE = 'Moderately Stable';
	case PERMANENT = 'Permanent';
	case TEMPORARY = 'Temporary';
	case AT_RISK = 'At Risk';
	case UNSTABLE = 'Unstable';
	case HOMELESS = 'Homeless';
	case UNKNOWN = 'Unknown';
}
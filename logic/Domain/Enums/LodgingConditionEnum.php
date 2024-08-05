<?php

namespace AddOns\Hestia\Domain\Enums;

enum LodgingCondition: string {
	case LIKE_NEW = 'Like New';
	case GOOD = 'Good';
	case FAIR = 'Fair';
	case POOR = 'Poor';
	case BAD = 'Bad';
	case VERY_BAD = 'Very Bad';
	case UNINHABITABLE = 'Uninhabitable';
	case UNKNOWN = 'Unknown';
}
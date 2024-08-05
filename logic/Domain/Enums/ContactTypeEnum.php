<?php

namespace AddOns\Hestia\Domain\Enums;

enum ContactTypeEnum: string {
	case PRIMARY = 'Primary';
	case SECONDARY = 'Secondary';
	case EMERGENCY = 'Emergency';
}
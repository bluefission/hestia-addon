<?php

namespace AddOns\Hestia\Domain\Enums;

enum BudgetFrequencyEnum: string {
	case DAILY = 'Daily';
	case WEEKLY = 'Weekly';
	case BIWEEKLY = 'Bi-Weekly';
	case MONTHLY = 'Monthly';
	case QUARTERLY = 'Quarterly';
	case SEMI_ANNUALLY = 'Semi-Annually';
	case YEARLY = 'Annually';
	case OTHER = 'Other';
}
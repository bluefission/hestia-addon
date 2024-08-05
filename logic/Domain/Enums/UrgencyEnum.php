<?php

namespace AddOns\Hestia\Domain\Enums;

enum UrgencyEnum: string {
    case IMMEDIATE = 'Immediate';
    case ONE_TO_TWO_DAYS = '1-2 days';
    case A_WEEK = 'A week';
    case A_MONTH = 'A month';
    case ABOUT_THREE_MONTHS = 'About three months';
    case A_YEAR = 'A year';
}
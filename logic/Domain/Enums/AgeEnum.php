<?php

namespace AddOns\Hestia\Domain\Enums;

enum AgeEnum: string {
    case INFANT = 'Infant';
    case CHILD = 'Child/Minor';
    case ADULT = 'Adult';
    case SENIOR = 'Senior/Elderly';
}
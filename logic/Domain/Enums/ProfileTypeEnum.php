<?php

namespace AddOns\Hestia\Domain\Enums;

enum ProfileTypeEnum: string {
	case OWNER = 'Owner';
	case MANAGER = 'Manager';
	case RESIDENT = 'Resident';
	case GUEST = 'Guest';
	case VENDOR = 'Vendor';
	case CONTRACTOR = 'Contractor';
	case SEEKER = 'Seeker';
	case EMPLOYEE = 'Employee';
}
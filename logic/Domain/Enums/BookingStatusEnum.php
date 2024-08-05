<?php

namespace AddOns\Hestia\Domain\Enums;

enum BookingStatusEnum: string {
	case UNCONFIRMED = 'Unconfirmed';
	case PENDING = 'Pending';
	case APPROVED = 'Approved';
	case ACTIVE = 'Active';
	case CANCELLED = 'Cancelled';
	case COMPLETED = 'Completed';
	case NO_SHOW = 'No Show';
	case REJECTED = 'Rejected';
	case EXPIRED = 'Expired';
	case UNPAID = 'Unpaid';
	case REFUNDED = 'Refunded';
	case RESCHEDULED = 'Rescheduled';
}
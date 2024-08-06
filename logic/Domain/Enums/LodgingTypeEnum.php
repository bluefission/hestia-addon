<?php

namespace AddOns\Hestia\Domain\Enums;

enum LodgingTypeEnum: string {
	case HOUSE = 'House';
	case APARTMENT = 'Apartment';
	case CONDO = 'Condo';
	case TOWNHOUSE = 'Townhouse';
	case DUPLEX = 'Duplex';
	case TRIPLEX = 'Triplex';
	case FOURPLEX = 'Fourplex';
	case MOBILE_HOME = 'Mobile Home';
	case RV = 'RV';
	case VAN = 'Van';
	case TINY_HOME = 'Tiny Home';
	case HOUSEBOAT = 'Houseboat';
	case BOAT = 'Boat';
	case PENTHOUSE = 'Penthouse';
	case CABIN = 'Cabin';
	case COTTAGE = 'Cottage';
	case BUNGALOW = 'Bungalow';
	case HOTEL_ROOM = 'Hotel Room';
	case MOTEL_ROOM = 'Motel Room';
	case HOSTEL_ROOM = 'Hostel Room';
	case BED_AND_BREAKFAST = 'Bed and Breakfast';
	case GUEST_HOUSE = 'Guest House';
	case TENT = 'Tent';
	case YURT = 'Yurt';
	case SHELTER = 'Shelter';
	case HALFWAY_HOUSE = 'Halfway House';
	case OTHER = 'Other';
}
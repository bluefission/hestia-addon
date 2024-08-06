<?php

namespace AddOns\Hestia\Domain\Enums;

enum LodgingMetaKeyEnum: string {
	case PRICE = 'Price';
	case STYLE = 'Style';
	case BEDROOMS = 'Bedrooms';
	case BATHROOMS = 'Bathrooms';
	case SQUARE_FEET = 'Square Feet';
	case LOT_SIZE = 'Lot Size';
	case YEAR_BUILT = 'Year Built';
	case YEAR_RENOVATED = 'Year Renovated';
	case PARKING = 'Parking';
	case HEATING = 'Heating';
	case COOLING = 'Cooling';
	case STORIES = 'Stories';
	case FLOOR = 'Floor';
	case CONSTRUCTION = 'Construction';
	case ROOF = 'Roof';
	case EXTERIOR = 'Exterior';
	case FLOORING = 'Flooring';
	case APPLIANCES = 'Appliances';
	case AMENITIES = 'Amenities';
	case UTILITIES = 'Utilities';
	case HOA = 'HOA';
	case TAXES = 'Taxes';
	case INSURANCE = 'Insurance';
	case OTHER = 'Other';
}
<?php

namespace AddOns\Hestia\Domain\Enums;

enum ServiceCategoryEnum: string {
	case CLEANING = 'Cleaning';
	case REPAIR = 'Repair';
	case MAINTENANCE = 'Maintenance';
	case REMODELING = 'Remodeling';
	case RENOVATION = 'Renovation';
	case RESTORATION = 'Restoration';
	case CONSTRUCTION = 'Construction';
	case DEMOLITION = 'Demolition';
	case MOVING = 'Moving';
	case STORAGE = 'Storage';
	case HAULING = 'Hauling';
	case PLUMBING = 'Plumbing';
	case ELECTRICAL = 'Electrical';
	case HVAC = 'HVAC';
	case TREE_REMOVAL = 'Tree Removal';
	case CARPENTRY = 'Carpentry';
	case PAINTING = 'Painting';
	case FLOORING = 'Flooring';
	case ROOFING = 'Roofing';
	case SIDING = 'Siding';
	case WINDOWS = 'Windows';
	case DOORS = 'Doors';
	case GUTTERS = 'Gutters';
	case DECKS = 'Decks';
	case FENCES = 'Fences';
	case LAWN_CARE = 'Lawn Care';
	case SNOW_REMOVAL = 'Snow Removal';
	case LANDSCAPING = 'Landscaping';
	case PEST_CONTROL = 'Pest Control';
	case SECURITY = 'Security';
	case INSPECTION = 'Inspection';
	case CONSULTATION = 'Consultation';
	case PROPERTY_MANAGEMENT = 'Property Management';
	case OTHER = 'Other';
}
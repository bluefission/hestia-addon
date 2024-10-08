<?php

use BlueFission\BlueCore\Datasource\Generator;
use AddOns\Hestia\Domain\Models\ContactDetailTypeModel;
use AddOns\Hestia\Domain\Models\ContactTypeModel;
use AddOns\Hestia\Domain\Models\LodgingConditionModel;
use AddOns\Hestia\Domain\Models\LodgingStabilityModel;
use AddOns\Hestia\Domain\Models\LodgingTypeModel;
use AddOns\Hestia\Domain\Models\ProfileTypeModel;
use AddOns\Hestia\Domain\Models\ServiceCategoryModel;
use AddOns\Hestia\Domain\Models\ServiceChargeTypeModel;
use AddOns\Hestia\Domain\Models\ServiceTimeframeUnitModel;
use AddOns\Hestia\Domain\Models\UrgencyModel;
use AddOns\Hestia\Domain\Models\BudgetFrequencyModel;
use AddOns\Hestia\Domain\Models\BookingStatusModel;
use AddOns\Hestia\Domain\Models\LodgingMetaKeyModel;
use AddOns\Hestia\Domain\Models\AgeModel;

use AddOns\Hestia\Domain\Enums\ContactDetailTypeEnum;
use AddOns\Hestia\Domain\Enums\ContactTypeEnum;
use AddOns\Hestia\Domain\Enums\LodgingConditionEnum;
use AddOns\Hestia\Domain\Enums\LodgingStabilityEnum;
use AddOns\Hestia\Domain\Enums\LodgingTypeEnum;
use AddOns\Hestia\Domain\Enums\ProfileTypeEnum;
use AddOns\Hestia\Domain\Enums\BudgetFrequencyEnum;
use AddOns\Hestia\Domain\Enums\ServiceCategoryEnum;
use AddOns\Hestia\Domain\Enums\ServiceChargeTypeEnum;
use AddOns\Hestia\Domain\Enums\ServiceTimeframeUnitEnum;
use AddOns\Hestia\Domain\Enums\UrgencyEnum;
use AddOns\Hestia\Domain\Enums\BookingStatusEnum;
use AddOns\Hestia\Domain\Enums\LodgingMetaKeyEnum;
use AddOns\Hestia\Domain\Enums\AgeEnum;

class SystemDataSeeder extends Generator
{
    public function populate()
    {
        $metaKeyTypes = [
            LodgingMetaKeyEnum::PRICE->value => 'number',
            LodgingMetaKeyEnum::STYLE->value => 'string',
            LodgingMetaKeyEnum::BEDROOMS->value => 'number',
            LodgingMetaKeyEnum::BATHROOMS->value => 'number',
            LodgingMetaKeyEnum::SQUARE_FEET->value => 'number',
            LodgingMetaKeyEnum::LOT_SIZE->value => 'number',
            LodgingMetaKeyEnum::YEAR_BUILT->value => 'number',
            LodgingMetaKeyEnum::YEAR_RENOVATED->value => 'number',
            LodgingMetaKeyEnum::PARKING->value => 'json',
            LodgingMetaKeyEnum::HEATING->value => 'string',
            LodgingMetaKeyEnum::COOLING->value => 'string',
            LodgingMetaKeyEnum::STORIES->value => 'number',
            LodgingMetaKeyEnum::FLOOR->value => 'number',
            LodgingMetaKeyEnum::CONSTRUCTION->value => 'string',
            LodgingMetaKeyEnum::ROOF->value => 'string',
            LodgingMetaKeyEnum::EXTERIOR->value => 'json',
            LodgingMetaKeyEnum::FLOORING->value => 'json',
            LodgingMetaKeyEnum::APPLIANCES->value => 'json',
            LodgingMetaKeyEnum::AMENITIES->value => 'json',
            LodgingMetaKeyEnum::UTILITIES->value => 'json',
            LodgingMetaKeyEnum::HOA->value => 'number',
            LodgingMetaKeyEnum::TAXES->value => 'number',
            LodgingMetaKeyEnum::INSURANCE->value => 'number',
            LodgingMetaKeyEnum::OTHER->value => 'json',
        ];

        foreach (ContactDetailTypeEnum::cases() as $type) {
            $model = new ContactDetailTypeModel();
            $model->name = $type->value;
            $model->description = $type->value;
            $model->write();
        }

        foreach (ContactTypeEnum::cases() as $type) {
            $model = new ContactTypeModel();
            $model->name = $type->value;
            $model->description = $type->value;
            $model->write();
        }

        foreach (LodgingConditionEnum::cases() as $condition) {
            $model = new LodgingConditionModel();
            $model->name = $condition->value;
            $model->description = $condition->value;
            $model->write();
        }

        foreach (LodgingStabilityEnum::cases() as $stability) {
            $model = new LodgingStabilityModel();
            $model->name = $stability->value;
            $model->description = $stability->value;
            $model->write();
        }

        foreach (LodgingTypeEnum::cases() as $type) {
            $model = new LodgingTypeModel();
            $model->name = $type->value;
            $model->description = $type->value;
            $model->write();
        }

        foreach (ProfileTypeEnum::cases() as $type) {
            $model = new ProfileTypeModel();
            $model->name = $type->value;
            $model->description = $type->value;
            $model->write();
        }

        foreach (BudgetFrequencyEnum::cases() as $frequency) {
            $model = new BudgetFrequencyModel();
            $model->name = $frequency;
            $model->description = $frequency;
            $model->write();
        }

        foreach (ServiceCategoryEnum::cases() as $category) {
            $model = new ServiceCategoryModel();
            $model->name = $category->value;
            $model->description = $category->value;
            $model->write();
        }

        foreach (ServiceChargeTypeEnum::cases() as $chargeType) {
            $model = new ServiceChargeTypeModel();
            $model->name = $chargeType->value;
            $model->write();
        }

        foreach (ServiceTimeframeUnitEnum::cases() as $unit) {
            $model = new ServiceTimeframeUnitModel();
            $model->name = $unit->value;
            $model->write();
        }

        foreach (UrgencyEnum::cases() as $urgency) {
            $model = new UrgencyModel();
            $model->name = $urgency->value;
            $model->description = $urgency->value;
            $model->write();
        }

        foreach (BookingStatusEnum::cases() as $status) {
            $model = new BookingStatusModel();
            $model->name = $status->value;
            $model->description = $status->value;
            $model->write();
        }

        foreach (LodgingMetaKeyEnum::cases() as $key) {
            $model = new LodgingMetaKeyModel();
            $model->name = $key->value;
            $model->type = $metaKeyTypes[$key->value];
            $model->description = $key->value;
            $model->write();
        }

        foreach (AgeEnum::cases() as $age) {
            $model = new AgeModel();
            $model->name = $age->value;
            $model->description = $age->value;
            $model->write();
        }
    }
}
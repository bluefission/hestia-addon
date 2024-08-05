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
use AddOns\Hestia\Domain\Enums\BookingStatusEnum

class SystemDataSeeder extends Generator
{
    public function populate()
    {
        foreach (ContactDetailTypeEnum::cases() as $type) {
            $model = new ContactDetailTypeModel();
            $model->name = $type->value;
            $model->description = $type->value;
            $model->save();
        }

        foreach (ContactTypeEnum::cases() as $type) {
            $model = new ContactTypeModel();
            $model->name = $type->value;
            $model->description = $type->value;
            $model->save();
        }

        foreach (LodgingConditionEnum::cases() as $condition) {
            $model = new LodgingConditionModel();
            $model->name = $condition->value;
            $model->description = $condition->value;
            $model->save();
        }

        foreach (LodgingStabilityEnum::cases() as $stability) {
            $model = new LodgingStabilityModel();
            $model->name = $stability->value;
            $model->description = $stability->value;
            $model->save();
        }

        foreach (LodgingTypeEnum::cases() as $type) {
            $model = new LodgingTypeModel();
            $model->name = $type->value;
            $model->description = $type->value;
            $model->save();
        }

        foreach (ProfileTypeEnum::cases() as $type) {
            $model = new ProfileTypeModel();
            $model->name = $type->value;
            $model->description = $type->value;
            $model->save();
        }

        foreach (BudgetFrequencyEnum::cases() as $frequency) {
            $model = new BudgetFrequencyModel();
            $model->name = $frequency;
            $model->description = $frequency;
            $model->save();
        }

        foreach (ServiceCategoryEnum::cases() as $category) {
            $model = new ServiceCategoryModel();
            $model->name = $category->value;
            $model->description = $category->value;
            $model->save();
        }

        foreach (ServiceChargeTypeEnum::cases() as $chargeType) {
            $model = new ServiceChargeTypeModel();
            $model->name = $chargeType->value;
            $model->save();
        }

        foreach (ServiceTimeframeUnitEnum::cases() as $unit) {
            $model = new ServiceTimeframeUnitModel();
            $model->name = $unit->value;
            $model->save();
        }

        foreach (UrgencyEnum::cases() as $urgency) {
            $model = new UrgencyModel();
            $model->name = $urgency->value;
            $model->description = $urgency->value;
            $model->save();
        }

        foreach (BookingStatusEnum::cases() as $status) {
            $model = new BookingStatusModel();
            $model->name = $status->value;
            $model->description = $status->value;
            $model->save();
        }
    }
}
<?php

use BlueFission\BlueCore\Datasource\Generator;
use Faker\Factory as Faker;
use AddOns\Hestia\Domain\Models\ProfileModel;
use AddOns\Hestia\Domain\Models\ProfileTypeModel;
use AddOns\Hestia\Domain\Models\LodgingModel;
use AddOns\Hestia\Domain\Models\LodgingTypeModel;
use AddOns\Hestia\Domain\Models\LodgingConditionModel;
use AddOns\Hestia\Domain\Models\LodgingMetaDataModel;
use AddOns\Hestia\Domain\Models\LodgingMetaKeyModel;
use AddOns\Hestia\Domain\Models\LodgingStabilityModel;
use AddOns\Hestia\Domain\Models\BudgetFrequencyModel;
use AddOns\Hestia\Domain\Models\AddressModel;
use AddOns\Hestia\Domain\Models\ContactModel;
use AddOns\Hestia\Domain\Models\ContactTypeModel;
use AddOns\Hestia\Domain\Models\ContactDetailModel;
use AddOns\Hestia\Domain\Models\ContactDetailTypeModel;
use AddOns\Hestia\Domain\Models\ServiceProviderModel;
use AddOns\Hestia\Domain\Models\ServiceCategoryModel;
use App\Domain\User\Models\UserModel;
use App\Domain\User\Models\CredentialModel;
use App\Domain\User\Models\CredentialStatusModel;
use App\Domain\User\CredentialStatus;
use AddOns\Hestia\Domain\Enums\ContactDetailTypeEnum;
use AddOns\Hestia\Domain\Enums\ContactTypeEnum;
use AddOns\Hestia\Domain\Enums\LodgingConditionEnum;
use AddOns\Hestia\Domain\Enums\LodgingStabilityEnum;
use AddOns\Hestia\Domain\Enums\LodgingTypeEnum;
use AddOns\Hestia\Domain\Enums\ProfileTypeEnum;
use AddOns\Hestia\Domain\Enums\BudgetFrequencyEnum;
use AddOns\Hestia\Domain\Enums\ServiceCategoryEnum;
use BlueFission\Arr;

class DemoHestiaDataSeeder extends Generator
{
    public function populate()
    {
        $faker = Faker::create();

        $verifiedStatus = (new CredentialStatusModel())->read(['name' => CredentialStatus::VERIFIED])->all()->first();

        $stylesArray = ['Cape Cod', 'Colonial', 'Craftsman', 'Ranch', 'Victorian', 'Tudor', 'Mediterranean', 'Contemporary', 'Modern', 'Farmhouse', 'Cottage', 'Bungalow', 'Spanish', 'French', 'Georgian', 'Greek Revival', 'Italianate', 'Mid-Century Modern', 'Prairie', 'Split-Level', 'Townhouse'];

        $constructionArray = ['Brick', 'Concrete', 'Log', 'Metal', 'Stone', 'Stucco', 'Vinyl', 'Wood', 'Other'];

        $roofArray = ['Asphalt', 'Metal', 'Tile', 'Slate', 'Wood', 'Rubber', 'Other'];

        $heatingArray = ['Central', 'Forced Air', 'Heat Pump', 'Radiant', 'Baseboard', 'Wall', 'Other'];

        $coolingArray = ['Central', 'Window', 'Wall', 'Ductless', 'Evaporative', 'Other'];

        $flooringArray = ['Carpet', 'Tile', 'Wood', 'Laminate', 'Vinyl', 'Concrete', 'Other'];

        $appliancesArray = ['Refrigerator', 'Oven', 'Stove', 'Microwave', 'Dishwasher', 'Washer', 'Dryer', 'Garbage Disposal', 'Other'];

        $amenitiesArray = ['Pool', 'Hot Tub', 'Fireplace', 'Deck', 'Patio', 'Balcony', 'Fenced Yard', 'Garden', 'Other'];

        $utilitiesArray = ['Electricity', 'Gas', 'Water', 'Sewer', 'Trash', 'Internet', 'Cable', 'Phone', 'Other'];

        $exteriorArray = ['Brick', 'Concrete', 'Log', 'Metal', 'Stone', 'Stucco', 'Vinyl', 'Wood', 'Other'];

        $hoaArray = ['Yes', 'No'];

        // Instantiate Models
        $lodging = new LodgingModel();
        $user = new UserModel();
        $credential = new CredentialModel();
        $profile = new ProfileModel();
        $profileType = new ProfileTypeModel();
        $metadata = new LodgingMetaDataModel();
        $metakeys = new LodgingMetaKeyModel();
        $lodgingStability = new LodgingStabilityModel();
        $budgetFrequency = new BudgetFrequencyModel();
        $serviceProvider = new ServiceProviderModel();
        $serviceCategory = new ServiceCategoryModel();
        $lodgingType = new LodgingTypeModel();
        $lodgingCondition = new LodgingConditionModel();
        $address = new AddressModel();
        $contact = new ContactModel();
        $contactType = new ContactTypeModel();
        $contactDetail = new ContactDetailModel();
        $contactDetailType = new ContactDetailTypeModel();

        // Seed fake users, profiles, and credentials
        for ($i = 0; $i < 10; $i++) {
            // Create User
            $user->clear();
            $user->realname = $faker->name();
            $user->displayname = $faker->userName();
            $user->write();
            echo 'Creating user '.$user->status()."\n";

            // Create Credential
            $credential->clear();
            $credential->username = $user->displayname;
            $credential->password = password_hash('password', PASSWORD_DEFAULT); // simple password for demo
            $credential->is_primary = 1;
            $credential->credential_status_id = $verifiedStatus->credential_status_id;
            $credential->user_id = $user->user_id;
            $credential->write();
            echo 'Creating credential '.$credential->status()."\n";

            $profileTypeValue = null;
            if ($i < 10) {
                $profileTypeValue = ProfileTypeEnum::VENDOR;
            } elseif ($i < 20) {
                $profileTypeValue = ProfileTypeEnum::OWNER;
            } else {
                $profileTypeValue = ProfileTypeEnum::SEEKER;
            }

            // Create Profile
            $profile->clear();
            $profile->profile_type_id = $profileType->clear()
                ->field('name', $profileTypeValue->value)
                ->read()
                ->field('profile_type_id');
            $profile->user_id = $user->user_id;
            $profile->title = $faker->jobTitle();
            $profile->first_name = $faker->firstName();
            $profile->last_name = $faker->lastName();
            $profile->suffix = $faker->suffix();
            $profile->current_lodging_id = null;
            $profile->lodging_stability_id = $lodgingStability->clear()
                ->field('name', LodgingStabilityEnum::cases()[rand(0, count(LodgingStabilityEnum::cases()) - 1)]->value)
                ->read()
                ->field('logding_stability_id');
            $profile->budget = $faker->randomFloat(2, 1000, 10000);
            $profile->budget_frequency_id = $budgetFrequency->clear()
                ->field('name', BudgetFrequencyEnum::cases()[rand(0, count(BudgetFrequencyEnum::cases()) - 1)]->value)
                ->read()
                ->field('budget_frequency_id');
            $profile->notes = $faker->paragraph();
            $profile->write();
            echo 'Creating profile '.$profile->status()."\n";

            if ($i < 10) {
                // Seed fake service providers
                $serviceProvider->clear();
                $serviceProvider->service_category_id = $serviceCategory->clear()
                    ->field('name', ServiceCategoryEnum::cases()[rand(0, count(ServiceCategoryEnum::cases()) - 1)]->value)
                    ->read()
                    ->field('service_category_id');
                $serviceProvider->profile_id = $profile->profile_id;
                $serviceProvider->name = $faker->company();
                $serviceProvider->description = $faker->catchPhrase();
                $serviceProvider->notes = $faker->paragraph();
                $serviceProvider->write();
                echo 'Creating service provider '.$serviceProvider->status()."\n";

                $address->clear();
                $address->parent_id = $serviceProvider->service_provider_id;
                $address->parent_type = ServiceProviderModel::class;
                $address->address_line_one = $faker->streetAddress();
                $address->address_line_two = $faker->secondaryAddress();
                $address->city = $faker->city();
                $address->state = $faker->state();
                $address->zip = $faker->postcode();
                $address->country = $faker->country();
                $address->write();
                echo 'Creating address '.$address->status()."\n";

            } elseif ($i < 20) {
                // Seed fake homeowners
                $count = rand(1, 4);
                for ($j = 0; $j < $count; $j++) {
                    $lodging->clear();
                    $lodging->lodging_type_id = $lodgingType->clear()
                        ->field('name', LodgingTypeEnum::cases()[rand(0, count(LodgingTypeEnum::cases()) - 1)]->value)
                        ->read()
                        ->field('lodging_type_id');
                    $lodging->lodging_condition_id = $lodgingCondition->clear()
                        ->field('name', LodgingConditionEnum::cases()[rand(0, count(LodgingConditionEnum::cases()) - 1)]->value)
                        ->read()
                        ->field('lodging_condition_id');
                    $lodging->profile_id = $profile->profile_id;
                    $lodging->description = $faker->paragraph();
                    $lodging->notes = $faker->paragraph();
                    $lodging->write();
                    echo 'Creating lodging '.$lodging->status()."\n";
                }

                $profile->current_lodging_id = $lodging->lodging_id;
                $profile->write();

                // Seed metadata
                $metadata->clear();
                $metakeys->clear();
                $keys = $metakeys->read()->all();

                $metadata->lodging_id = $lodging->lodging_id;

                $yearBuilt = null;
                $yearRenovated = null;
                $stories = null;
                $floors = null;

                foreach ($keys as $key) {
                    $metadata->lodging_meta_key_id = $key['lodging_meta_key_id'];
                
                    switch($key['name']) {
                        case 'Price':
                            $value = $faker->randomFloat(2, 1000, 10000);
                            break;
                        case 'Style':
                            $value = $stylesArray[rand(0, count($stylesArray) - 1)];
                            break;
                        case 'Bedrooms':
                            $value = $faker->numberBetween(1, 5);
                            break;
                        case 'Bathrooms':
                            $value = $faker->numberBetween(1, 5);
                            break;
                        case 'Square Feet':
                            $value = $faker->numberBetween(500, 5000);
                            break;
                        case 'Lot Size':
                            $value = $faker->numberBetween(5000, 50000);
                            break;
                        case 'Year Built':
                            $yearBuilt = $yearBuilt ?? $faker->year(); // should always be in the past and smaller than renovation date
                            if (!$yearBuilt) {
                                $yearBuilt = $faker->year();
                            }
                            while ($yearBuilt > $yearRenovated) {
                                $yearBuilt = $faker->year();
                            }
                            $value = $yearBuilt;
                            break;
                        case 'Year Renovated':
                            $yearRenovated = $yearRenovated ?? $faker->year(); // should always be in the past and larger than built date
                            if (!$yearBuilt) {
                                $yearBuilt = $faker->year();
                            }
                            while ($yearRenovated < $yearBuilt) {
                                $yearRenovated = $faker->year();
                            }
                            $value = $yearRenovated;
                            break;
                        case 'Parking':
                            $value = $faker->numberBetween(1, 5);
                            break;
                        case 'Heating':
                            $value = $heatingArray[rand(0, count($heatingArray) - 1)];
                            break;
                        case 'Cooling':
                            $value = $coolingArray[rand(0, count($coolingArray) - 1)];
                            break;
                        case 'Stories':
                            if ($floors) {
                                continue 2;
                            }
                            $stories = $stories ?? $faker->numberBetween(1, 3);
                            $value = $stories;
                            break;
                        case 'Floor':
                            if ($stories) {
                                continue 2;
                            }
                            $floor = $floor ?? $faker->numberBetween(1, 3);
                            $value = $floor;
                            break;
                        case 'Construction':
                            $value = $constructionArray[rand(0, count($constructionArray) - 1)];
                            break;
                        case 'Roof':
                            $value = $roofArray[rand(0, count($roofArray) - 1)];
                            break;
                        case 'Exterior':
                            $value = $exteriorArray[rand(0, count($exteriorArray) - 1)];
                            break;
                        case 'Flooring':
                            $value = $flooringArray[rand(0, count($flooringArray) - 1)];
                            break;
                        case 'Appliances':
                            $value = $appliancesArray[rand(0, count($appliancesArray) - 1)];
                            break;
                        case 'Amenities':
                            $value = $amenitiesArray[rand(0, count($amenitiesArray) - 1)];
                            break;
                        case 'Utilities':
                            $value = $utilitiesArray[rand(0, count($utilitiesArray) - 1)];
                            break;
                        case 'HOA':
                            $value = $faker->randomFloat(2, 100, 500);
                            break;
                        case 'Taxes':
                            $value = $faker->randomFloat(2, 1000, 5000);
                            break;
                        case 'Insurance':
                            $value = $faker->randomFloat(2, 100, 500);
                            break;
                        case 'Other':
                            $value = $faker->word();
                            break;
                        default:
                            $value = $faker->word();
                            break;
                    }

                    if ( $key['type'] == 'json' ) {
                        $value = Arr::make($value)->toJson();
                    }

                    $metadata->value = $value;
                    $metadata->lodging_id = $lodging->lodging_id;
                    $metadata->write();
                    echo 'Creating metadata '.$metadata->status()."\n";
                }

                $address->clear();
                $address->parent_id = $lodging->lodging_id;
                $address->parent_type = LodgingModel::class;
                $address->address_line_one = $faker->streetAddress();
                $address->address_line_two = $faker->secondaryAddress();
                $address->city = $faker->city();
                $address->state = $faker->state();
                $address->zip = $faker->postcode();
                $address->country = $faker->country();
                $address->write();
                echo 'Creating address '.$address->status()."\n";
            } else {
                // Seed fake seekers
                $hasLodging = rand(0, 1);
                if ( $hasLodging ) {
                    $lodging->clear();
                    $lodging->lodging_type_id = $lodgingType->clear()
                        ->field('name', LodgingTypeEnum::cases()[rand(0, count(LodgingTypeEnum::cases()) - 1)]->value)
                        ->read()
                        ->field('lodging_type_id');
                    $lodging->lodging_condition_id = $lodgingCondition->clear()
                        ->field('name', LodgingConditionEnum::cases()[rand(0, count(LodgingConditionEnum::cases()) - 1)]->value)
                        ->read()
                        ->field('lodging_condition_id');
                    $lodging->profile_id = $profile->profile_id;
                    $lodging->description = $faker->paragraph();
                    $lodging->notes = $faker->paragraph();
                    $lodging->write();
                    echo 'Creating lodging '.$lodging->status()."\n";

                    $profile->current_lodging_id = $lodging->lodging_id;
                    $profile->write();
                }

                $contact->clear();
                $contact->profile_id = $profile->profile_id;
                $contact->contact_type_id = $contactType->clear()
                    ->field('name', ContactTypeEnum::cases()[rand(0, count(ContactTypeEnum::cases()) - 1)]->value)
                    ->read()
                    ->field('contact_type_id');
                $contact->name = $faker->name();
                $contact->description = $faker->paragraph();
                $contact->notes = $faker->paragraph();
                $contact->write();
                echo 'Creating contact '.$contact->status()."\n";

                $contactDetail->clear();
                $contactDetail->contact_id = $contact->contact_id;
                $contactDetail->contact_detail_type_id = $contactDetailType->clear()
                    ->field('name', ContactDetailTypeEnum::cases()[rand(0, count(ContactDetailTypeEnum::cases()) - 1)]->value)
                    ->read()
                    ->field('contact_detail_type_id');
                $contactDetail->name = $faker->word();
                $contactDetail->value = $faker->phoneNumber();
                $contactDetail->notes = $faker->paragraph();
                $contactDetail->is_primary = rand(0, 1);
                $contactDetail->is_public = rand(0, 1);
                $contactDetail->is_verified = rand(0, 1);
                $contactDetail->write();
                echo 'Creating contact detail '.$contactDetail->status()."\n";
            }
        }
    }
}
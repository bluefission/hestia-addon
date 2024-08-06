<?php

use BlueFission\BlueCore\Datasource\Generator;
use Faker\Factory as Faker;
use AddOns\Hestia\Domain\Models\ProfileModel;
use AddOns\Hestia\Domain\Models\LodgingModel;
use AddOns\Hestia\Domain\Models\AddressModel;
use AddOns\Hestia\Domain\Models\ContactModel;
use AddOns\Hestia\Domain\Models\ContactDetailModel;
use AddOns\Hestia\Domain\Models\ServiceProviderModel;
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

class DemoHestiaDataSeeder extends Generator
{
    public function populate()
    {
        $faker = Faker::create();

        $verifiedStatus = (new CredentialStatusModel())->read(['name' => CredentialStatus::VERIFIED])->first();

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

        // Seed fake users, profiles, and credentials
        for ($i = 0; $i < 30; $i++) {
            // Create User
            $user = new UserModel();
            $user->realname = $faker->name();
            $user->displayname = $faker->userName();
            $user->save();

            // Create Credential
            $credential = new CredentialModel();
            $credential->username = $user->displayname;
            $credential->password = password_hash('password', PASSWORD_DEFAULT); // simple password for demo
            $credential->is_primary = 1;
            $credential->credential_status_id = $verifiedStatus->credential_status_id;
            $credential->user_id = $user->user_id;
            $credential->save();

            // Create Profile
            $profile = new ProfileModel();
            $profile->user_id = $user->user_id;
            $profile->title = $faker->jobTitle();
            $profile->first_name = $faker->firstName();
            $profile->last_name = $faker->lastName();
            $profile->suffix = $faker->suffix();
            $profile->budget = $faker->randomFloat(2, 1000, 10000);
            $profile->budget_frequency_id = BudgetFrequencyEnum::cases()[rand(0, count(BudgetFrequencyEnum::cases()) - 1)]->value;
            $profile->notes = $faker->paragraph();
            $profile->save();

            if ($i < 10) {
                // Seed fake service providers
                $serviceProvider = new ServiceProviderModel();
                $serviceProvider->service_category_id = ServiceCategoryEnum::cases()[rand(0, count(ServiceCategoryEnum::cases()) - 1)]->value;
                $serviceProvider->profile_id = $profile->profile_id;
                $serviceProvider->name = $faker->company();
                $serviceProvider->description = $faker->catchPhrase();
                $serviceProvider->notes = $faker->paragraph();
                $serviceProvider->save();

                $address = new AddressModel();
                $address->parent_id = $serviceProvider->service_provider_id;
                $address->parent_type = ServiceProviderModel::class;
                $address->address_line_one = $faker->streetAddress();
                $address->address_line_two = $faker->secondaryAddress();
                $address->city = $faker->city();
                $address->state = $faker->state();
                $address->zip = $faker->postcode();
                $address->country = $faker->country();
                $address->save();
            } elseif ($i < 20) {
                // Seed fake homeowners
                $lodging = new LodgingModel();
                $lodging->lodging_type_id = LodgingTypeEnum::cases()[rand(0, count(LodgingTypeEnum::cases()) - 1)]->value;
                $lodging->lodging_condition_id = LodgingConditionEnum::cases()[rand(0, count(LodgingConditionEnum::cases()) - 1)]->value;
                $lodging->profile_id = $profile->profile_id;
                $lodging->description = $faker->paragraph();
                $lodging->notes = $faker->paragraph();
                $lodging->save();

                // Seed metadata
                $metadata = new LodgingMetaDataModel();
                $metakeys = new LodgingMetaKeyModel();
                $keys = $metakeys->read()->all();

                $metadata->lodging_id = $lodging->lodging_id;

                $yearBuilt = null;
                $yearRenovated = null;
                $stories = null;
                $floors = null;

                foreach ($keys as $key) {
                    $metadata->lodging_meta_key_id = $key->lodging_meta_key_id;

                    switch($key->name) {
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
                                continue;
                            }
                            $stories = $stories ?? $faker->numberBetween(1, 3);
                            $value = $stories;
                            break;
                        case 'Floor':
                            if ($stories) {
                                continue;
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
                    }

                    $metadata->value = $value;
                    $metadata->lodging_id = $lodging->lodging_id;
                    $metadata->save();
                }

                $address = new AddressModel();
                $address->parent_id = $lodging->lodging_id;
                $address->parent_type = LodgingModel::class;
                $address->address_line_one = $faker->streetAddress();
                $address->address_line_two = $faker->secondaryAddress();
                $address->city = $faker->city();
                $address->state = $faker->state();
                $address->zip = $faker->postcode();
                $address->country = $faker->country();
                $address->save();
            } else {
                // Seed fake seekers
                $contact = new ContactModel();
                $contact->profile_id = $profile->profile_id;
                $contact->contact_type_id = ContactTypeEnum::cases()[rand(0, count(ContactTypeEnum::cases()) - 1)]->value;
                $contact->name = $faker->name();
                $contact->description = $faker->paragraph();
                $contact->notes = $faker->paragraph();
                $contact->save();

                $contactDetail = new ContactDetailModel();
                $contactDetail->contact_id = $contact->contact_id;
                $contactDetail->contact_detail_type_id = ContactDetailTypeEnum::cases()[rand(0, count(ContactDetailTypeEnum::cases()) - 1)]->value;
                $contactDetail->name = $faker->word();
                $contactDetail->value = $faker->phoneNumber();
                $contactDetail->notes = $faker->paragraph();
                $contactDetail->is_primary = rand(0, 1);
                $contactDetail->is_public = rand(0, 1);
                $contactDetail->is_verified = rand(0, 1);
                $contactDetail->save();
            }
        }
    }
}
?>

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
                $lodging->built_year = $faker->year($max = 'now');
                // renovated_year should be after built_year
                $reno_year = $faker->year($max = 'now');
                while ($reno_year < $lodging->built_year) {
                    $reno_year = $faker->year($max = 'now');
                }
                $lodging->renovated_year = $reno_year;
                $lodging->description = $faker->paragraph();
                $lodging->notes = $faker->paragraph();
                $lodging->save();

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

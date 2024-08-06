<?php

use BlueFission\BlueCore\Datasource\Delta;
use BlueFission\Data\Storage\Structure\MysqlStructure as Structure;
use BlueFission\Data\Storage\Structure\MysqlScaffold as Scaffold;

class ScaffoldHestiaTables extends Delta
{
    public function change()
    {
        Scaffold::create('hestia_profiles', function (Structure $entity) {
            $entity->incrementer('profile_id');
            $entity->numeric('user_id')->foreign('users', 'user_id');
            $entity->text('title')->null();
            $entity->text('first_name');
            $entity->text('last_name');
            $entity->numeric('current_lodging_id');
            $entity->numeric('lodging_stability_id');
            $entity->text('suffix')->null();
            $entity->decimal('budget', 10, 2)->null();
            $entity->numeric('budget_frequency')->null();
            $entity->text('notes')->null();
            $entity->timestamps();
        });

        Scaffold::create('hestia_profile_types', function (Structure $entity) {
            $entity->incrementer('profile_type_id');
            $entity->text('name');
            $entity->text('description')->null();
            $entity->timestamps();
        });

        Scaffold::create('hestia_addresses', function (Structure $entity) {
            $entity->incrementer('address_id');
            $entity->numeric('parent_id');
            $entity->text('parent_type');
            $entity->text('address_line_one');
            $entity->text('address_line_two')->null();
            $entity->text('city');
            $entity->text('state');
            $entity->text('zip');
            $entity->text('country');
            $entity->timestamps();
        });

        Scaffold::create('hestia_contact_details', function (Structure $entity) {
            $entity->incrementer('contact_detail_id');
            $entity->numeric('contact_id')->foreign('hestia_contacts', 'contact_id');
            $entity->numeric('contact_detail_type_id')->foreign('hestia_contact_detail_types', 'contact_detail_type_id');
            $entity->text('name');
            $entity->text('value');
            $entity->text('notes')->null();
            $entity->boolean('is_primary')->default(0);
            $entity->boolean('is_public')->default(0);
            $entity->boolean('is_verified')->default(0);
            $entity->timestamps();
        });

        Scaffold::create('hestia_contact_detail_types', function (Structure $entity) {
            $entity->incrementer('contact_detail_type_id');
            $entity->text('name');
            $entity->text('description')->null();
            $entity->timestamps();
        });

        Scaffold::create('hestia_contacts', function (Structure $entity) {
            $entity->incrementer('contact_id');
            $entity->numeric('profile_id')->foreign('hestia_profiles', 'profile_id');
            $entity->numeric('contact_type_id')->foreign('hestia_contact_types', 'contact_type_id');
            $entity->text('name');
            $entity->text('description')->null();
            $entity->text('notes')->null();
            $entity->timestamps();
        });

        Scaffold::create('hestia_contact_to_lodging', function (Structure $entity) {
            $entity->incrementer('contact_to_lodging_id');
            $entity->numeric('contact_id');
            $entity->numeric('lodging_id');
            $entity->timestamps();
        });

        Scaffold::create('hestia_contact_types', function (Structure $entity) {
            $entity->incrementer('contact_type_id');
            $entity->text('name');
            $entity->text('description')->null();
            $entity->timestamps();
        });

        Scaffold::create('hestia_budget_frequencies', function (Structure $entity) {
            $entity->incrementer('budget_frequency_id');
            $entity->text('name');
            $entity->text('description')->null();
            $entity->timestamps();
        });

        Scaffold::create('hestia_images', function (Structure $entity) {
            $entity->incrementer('image_id');
            $entity->numeric('parent_id');
            $entity->text('parent_type');
            $entity->text('path');
            $entity->text('description')->null();
            $entity->text('notes')->null();
            $entity->timestamps();
        });

        Scaffold::create('hestia_lodging_assessment_items', function (Structure $entity) {
            $entity->incrementer('lodging_assessment_item_id');
            $entity->numeric('lodging_assessment_id')->foreign('hestia_lodging_assessments', 'lodging_assessment_id');
            $entity->numeric('service_id')->foreign('hestia_services', 'service_id');
            $entity->text('priority');
            $entity->text('comments')->null();
            $entity->text('timeframe')->null();
            $entity->numeric('service_timeframe_unit_id')->null();
            $entity->decimal('cost', 10, 2)->null();
            $entity->numeric('service_charge_type_id')->null();
            $entity->timestamps();
        });

        Scaffold::create('hestia_lodging_assessments', function (Structure $entity) {
            $entity->incrementer('lodging_assessment_id');
            $entity->numeric('lodging_report_id')->foreign('hestia_lodging_reports', 'lodging_report_id');
            $entity->numeric('service_provider_id')->foreign('hestia_service_providers', 'service_provider_id');
            $entity->text('comments')->null();
            $entity->timestamps();
        });

        Scaffold::create('hestia_lodging_conditions', function (Structure $entity) {
            $entity->incrementer('lodging_condition_id');
            $entity->text('name');
            $entity->text('description')->null();
            $entity->timestamps();
        });

        Scaffold::create('hestia_lodging_meta_data', function (Structure $entity) {
            $entity->incrementer('lodging_meta_data_id');
            $entity->numeric('lodging_meta_key_id')->foreign('hestia_lodging_meta_keys', 'lodging_meta_key_id');
            $entity->numeric('lodging_id')->foreign('hestia_lodgings', 'lodging_id');
            $entity->text('value');
            $entity->timestamps();
        });

        Scaffold::create('hestia_lodging_meta_keys', function (Structure $entity) {
            $entity->incrementer('lodging_meta_key_id');
            $entity->text('name');
            $entity->text('type');
            $entity->text('description')->null();
            $entity->timestamps();
        });

        Scaffold::create('hestia_lodgings', function (Structure $entity) {
            $entity->incrementer('lodging_id');
            $entity->numeric('lodging_type_id')->foreign('hestia_lodging_types', 'lodging_type_id');
            $entity->numeric('lodging_condition_id')->foreign('hestia_lodging_conditions', 'lodging_condition_id');
            $entity->numeric('profile_id')->foreign('hestia_profiles', 'profile_id');
            $entity->numeric('built_year')->null();
            $entity->numeric('renovated_year')->null();
            $entity->text('description')->null();
            $entity->text('notes')->null();
            $entity->timestamps();
        });

        Scaffold::create('hestia_lodging_reports', function (Structure $entity) {
            $entity->incrementer('lodging_report_id');
            $entity->numeric('lodging_id')->foreign('hestia_lodgings', 'lodging_id');
            $entity->text('report');
            $entity->timestamps();
        });

        Scaffold::create('hestia_lodging_requests', function (Structure $entity) {
            $entity->incrementer('lodging_request_id');
            $entity->numeric('profile_id')->foreign('profiles', 'profile_id');
            $entity->numeric('budget');
            $entity->text('location');
            $entity->datetime('start_date');
            $entity->numeric('duration');
            $entity->numeric('number_of_rooms');
            $entity->numeric('number_of_people');
            $entity->boolean('pets');
            $entity->boolean('smoking');
            $entity->text('allergies');
            $entity->text('description')->null();
            $entity->text('notes')->null();
            $entity->text('status');
            $entity->timestamps();
        });

        Scaffold::create('hestia_ages', function (Structure $entity) {
            $entity->incrementer('age_id');
            $entity->text('name');
            $entity->text('description')->null();
            $entity->timestamps();
        });

        Scaffold::create('hestia_additional_people', function (Structure $entity) {
            $entity->incrementer('additional_person_id');
            $entity->numeric('parent_id');
            $entity->text('parent_type');
            $entity->numeric('profile_id')->foreign('hestia_profiles', 'profile_id')->null();
            $entity->numeric('age_id')->foreign('hestia_ages', 'age_id')->null();
        });

        Scaffold::create('hestia_lodging_stabilities', function (Structure $entity) {
            $entity->incrementer('lodging_stability_id');
            $entity->text('name');
            $entity->text('description')->null();
            $entity->timestamps();
        });

        Scaffold::create('hestia_lodging_types', function (Structure $entity) {
            $entity->incrementer('lodging_type_id');
            $entity->text('name');
            $entity->text('description')->null();
            $entity->timestamps();
        });

        Scaffold::create('hestia_roommate_requests', function (Structure $entity) {
            $entity->incrementer('roommate_request_id');
            $entity->numeric('profile_id')->foreign('profiles', 'profile_id');
            $entity->numeric('budget');
            $entity->text('location');
            $entity->datetime('start_date');
            $entity->numeric('duration');
            $entity->numeric('number_of_rooms');
            $entity->numeric('number_of_people');
            $entity->boolean('pets');
            $entity->boolean('smoking');
            $entity->text('allergies');
            $entity->text('description')->null();
            $entity->text('notes')->null();
            $entity->text('status');
            $entity->timestamps();
        });

        Scaffold::create('hestia_service_categories', function (Structure $entity) {
            $entity->incrementer('service_category_id');
            $entity->text('name');
            $entity->text('description')->null();
            $entity->timestamps();
        });

        Scaffold::create('hestia_service_charge_types', function (Structure $entity) {
            $entity->incrementer('service_charge_type_id');
            $entity->text('name');
            $entity->timestamps();
        });

        Scaffold::create('hestia_services', function (Structure $entity) {
            $entity->incrementer('service_id');
            $entity->numeric('service_category_id')->foreign('hestia_service_categories', 'service_category_id');
            $entity->numeric('service_type_id')->foreign('hestia_service_types', 'service_type_id');
            $entity->text('name');
            $entity->text('description')->null();
            $entity->timestamps();
        });

        Scaffold::create('hestia_service_providers', function (Structure $entity) {
            $entity->incrementer('service_provider_id');
            $entity->numeric('service_category_id')->foreign('hestia_service_categories', 'service_category_id');
            $entity->numeric('profile_id')->foreign('hestia_profiles', 'profile_id');
            $entity->text('name');
            $entity->text('description')->null();
            $entity->text('notes')->null();
            $entity->timestamps();
        });

        Scaffold::create('hestia_booking_statusus', function (Structure $entity) {
            $entity->incrementer('booking_status_id');
            $entity->text('name');
            $entity->text('description')->null();
            $entity->timestamps();
        });

        Scaffold::create('hestia_bookings', function (Structure $entity) {
            $entity->incrementer('booking_id');
            $entity->numeric('lodging_id')->foreign('hestia_lodgings', 'lodging_id');
            $entity->numeric('service_provider_id')->foreign('hestia_service_providers', 'service_provider_id');
            $entity->datetime('datetime');
            $entity->numeric('duration');
            $entity->text('booking_status_id')->foreign('hestia_booking_statuses', 'booking_status_id');
            $entity->timestamps();
        });

        Scaffold::create('hestia_service_provider_to_services', function (Structure $entity) {
            $entity->incrementer('service_provider_to_service_id');
            $entity->numeric('service_provider_id')->foreign('hestia_service_providers', 'service_provider_id');
            $entity->numeric('service_id')->foreign('hestia_services', 'service_id');
            $entity->timestamps();
        });

        Scaffold::create('hestia_service_timeframe_units', function (Structure $entity) {
            $entity->incrementer('service_timeframe_unit_id');
            $entity->text('name');
            $entity->timestamps();
        });

        Scaffold::create('hestia_service_types', function (Structure $entity) {
            $entity->incrementer('service_type_id');
            $entity->text('name');
            $entity->text('description')->null();
            $entity->timestamps();
        });

        Scaffold::create('hestia_service_requests', function (Structure $entity) {
            $entity->incrementer('service_request_id');
            $entity->numeric('profile_id')->foreign('profiles', 'profile_id');
            $entity->numeric('lodging_id')->foreign('hestia_lodgings', 'lodging_id');
            $entity->text('title');
            $entity->text('description')->null();
            $entity->numeric('service_category_id')->foreign('hestia_service_categories', 'service_category_id');
            $entity->decimal('budget', 10, 2)->null();
            $entity->numeric('urgency_id')->foreign('urgencies', 'urgency_id');
            $entity->timestamps();
        });

        Scaffold::create('hestia_urgencies', function (Structure $entity) {
            $entity->incrementer('urgency_id');
            $entity->text('name');
            $entity->text('description')->null();
            $entity->timestamps();
        });
    }

    public function revert()
    {
        Scaffold::delete('hestia_urgencies');
        Scaffold::delete('hestia_service_requests');
        Scaffold::delete('hestia_service_types');
        Scaffold::delete('hestia_service_timeframe_units');
        Scaffold::delete('hestia_service_provider_to_services');
        Scaffold::delete('hestia_bookings');
        Scaffold::delete('hestia_service_providers');
        Scaffold::delete('hestia_services');
        Scaffold::delete('hestia_service_charge_types');
        Scaffold::delete('hestia_service_categories');
        Scaffold::delete('hestia_roommate_requests');
        Scaffold::delete('hestia_lodging_types');
        Scaffold::delete('hestia_lodging_stabilities');
        Scaffold::delete('hestia_lodging_requests');
        Scaffold::delete('hestia_lodging_reports');
        Scaffold::delete('hestia_lodgings');
        Scaffold::delete('hestia_lodging_meta_keys');
        Scaffold::delete('hestia_lodging_meta_data');
        Scaffold::delete('hestia_lodging_conditions');
        Scaffold::delete('hestia_lodging_assessments');
        Scaffold::delete('hestia_lodging_assessment_items');
        Scaffold::delete('hestia_images');
        Scaffold::delete('hestia_contact_types');
        Scaffold::delete('hestia_contact_to_lodging');
        Scaffold::delete('hestia_contacts');
        Scaffold::delete('hestia_contact_detail_types');
        Scaffold::delete('hestia_contact_details');
        Scaffold::delete('hestia_addresses');
        Scaffold::delete('hestia_profile_types');
        Scaffold::delete('hestia_profiles');
    }
}
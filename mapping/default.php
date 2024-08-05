<?php
use BlueFission\Services\Mapping;

// Hestia
Mapping::add('/home', ['AddOns\Hestia\Business\Http\DashboardController', 'index'], 'hestia.home', 'get');

// Admin
Mapping::add('/modules/dashboard', ['AddOns\Hestia\Business\Http\DashboardController', 'dashboard'], 'hestia.dashboard', 'get')->gateway('auth');

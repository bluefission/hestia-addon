<?php
use BlueFission\Services\Mapping;

// Hestia
Mapping::add('/home', ['AddOns\Hestia\Business\Http\DashboardController', 'index'], 'hestia.home', 'get');
Mapping::add('/seeker-signup', ['AddOns\Hestia\Business\Http\DashboardController', 'seekerSignup'], 'hestia.seeker-signup', 'get');
Mapping::add('/owner-signup', ['AddOns\Hestia\Business\Http\DashboardController', 'ownerSignup'], 'hestia.owner-signup', 'get');
Mapping::add('/signup', ['AddOns\Hestia\Business\Http\DashboardController', 'signup'], 'hestia.signup', 'get');
Mapping::add('/login', ['AddOns\Hestia\Business\Http\DashboardController', 'login'], 'hestia.login', 'get');

// Admin
Mapping::add('admin/modules/hestia', ['AddOns\Hestia\Business\Http\AdminController', 'main'], 'hestia.dashboard', 'get')->gateway('admin:auth');

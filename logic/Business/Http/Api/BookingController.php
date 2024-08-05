<?php

namespace AddOns\Hestia\Business\Http\Api\Admin;

use BlueFission\Services\Request;
use BlueFission\Services\Authenticator;
use BlueFission\BlueCore\BaseController;
use AddOns\Hestia\Domain\Queries\IAllBookingsQuery;
use AddOns\Hestia\Domain\Repositories\IBookingRepository;
use AddOns\Hestia\Domain\Booking;
use AddOns\Hestia\Domain\Booking;

class BookingController extends BaseController {

	public function index( IAllBookingsByUserQuery $query ) {
		$bookings = $query->fetch();
		return response($bookings);
	}

	public function providerHistory( $booking_id, IBookingRepository $repository, Authenticator $auth ) {
		$serviceProvider = $repository->find($booking_id);
		$bookings = $serviceProvider->bookings();
		return response($bookings);
	}

	public function book( Request $request, IBookingRepository $repository, Authenticator $auth ) {
		$booking = new Booking;
		foreach ($request->all() as $key => $value) {
			if ( property_exists($booking, $key) ) {
				$booking->$key = $value;
			}
		}

		// Save the new model
		$model = $repository->save($booking);

		// Return the model
		return response($model);
	}
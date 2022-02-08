<?php

use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VenueController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!

|
*/
// This works fine for all methods in the venue class
// Route::apiResource('venues', VenueController::class);

// Same functionality as apiResource, but divided for better control
Route::get("showAllVenues", [VenueController::class, "index"]);
Route::post("createVenues", [VenueController::class, "store"]);
Route::patch("updateVenue/{venue}", [VenueController::class, "update"])->name('venue.update');;
Route::get("showVenueById/{id}", [VenueController::class, "show"]);
Route::delete("destroy/{id}", [VenueController::class, "destroy"]);
Route::post("createUser", [UserController::class, "createUser"]);

// Booking Routes
Route::get("showAllBookings", [BookingController::class, "index"]);
Route::post("createBooking", [BookingController::class, "store"]);
Route::get("showBookingById/{id", [BookingController::class, "show"]);
Route::patch("updateBooking/{id}", [BookingController::class, "update"]);


Route::post("login", [UserController::class, "login"])->name('login');
// Use this middleware if the user is logged in
Route::group(["middleware" => ["auth:sanctum"]], function () {
    // User Routes
    Route::get("profile", [UserController::class, "dashboard"]);
    Route::post("logout", [UserController::class, "logout"]);

//    Venue Routes
    // Route::get("showAllVenues",[VenueController::class,"index"]);
    // Route::post("createVenues",[VenueController::class,"store"]);
    // Route::put("updateVenue{id}",[VenueController::class,"update"]);
    // Route::get("showVenueById/{id}",[VenueController::class,"show"]);
    // Route::delete("destroy{id}",[VenueController::class,"destroy"]);

});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

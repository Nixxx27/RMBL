<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');




Route::group(['middleware' => ['auth']],
    function () {

Route::resource('employees', 'EmployeeController'); 
    	
Route::resource('patients', 'PatientController'); 



Route::resource('collectors', 'CollectorController'); 



##ABOUT ACCOUNTS
Route::POST('accounts/assignedto/{id}','AccountController@assignedto');
Route::POST('accounts/addfunds/{id}','AccountController@addfunds');
Route::resource('accounts', 'AccountController'); 

##ABOUT LOANS
Route::GET('loans/by/{id}','LoanController@view_all_loans_of_borrower');
Route::GET('loans/search_borrowers','LoanController@search_borrowers');
Route::GET('loans/is_borrower_exist','LoanController@is_borrower_exist');
Route::resource('loans', 'LoanController'); 


Route::POST('borrowers_loans/payments/{id}','BorrowerLoansController@borrowers_loans_payments');
Route::resource('borrowersloans', 'BorrowerLoansController'); 
## -- ABOUT LOANS --##
Route::GET('sl/home_employee_search','SickLeaveController@home_employee_search');
Route::GET('sl/home_employee_search_by_name','SickLeaveController@home_employee_search_by_name');

Route::resource('sl', 'SickLeaveController'); 


#SETTINGS
Route::POST('interest/update/{id}','SettingsController@update_interest');
Route::GET('interest','SettingsController@interest');
		    
Route::get('/home', 'HomeController@index')->name('home');

});#END OF MIDDLEWARE AUTH
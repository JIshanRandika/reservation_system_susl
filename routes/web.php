<?php

use Illuminate\Support\Facades\Route;

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

// Route::group(['middleware'=>"web"],function(){

// });

Route::get('/','App\Http\Controllers\PagesController@getHome' );
Route::post('/check-availability','App\Http\Controllers\PagesController@checkavailable' );

Route::get('/contact','App\Http\Controllers\PagesController@getContact' )->middleware('CustomAuth');
Route::post('/contact/submit', 'App\Http\Controllers\MessagesController@submit');


Route::get('/af', 'App\Http\Controllers\AgriFarmController@getagrifarm')->middleware('CustomAuth');
Route::post('/af/submit', 'App\Http\Controllers\AgriFarmController@submit')->name('af_submit');;

Route::get('/afd', 'App\Http\Controllers\AgriDinningController@getdinning')->middleware('CustomAuth');
//Route::get('/afd', 'App\Http\Controllers\AgriDinningController@dropDownShow')->middleware('CustomAuth');
Route::post('/afd/submit', 'App\Http\Controllers\AgriDinningController@submit')->name('afd_submit');


Route::get('/nest', 'App\Http\Controllers\NestController@getnest')->middleware('CustomAuth');
//Route::get('/nest', 'App\Http\Controllers\NestController@dropDownShow')->middleware('CustomAuth');
Route::post('/nest/submit', 'App\Http\Controllers\NestController@submit')->name('nest_submit');

//Route::get('/','App\Http\Controllers\HomeController@gethr');

Route::get('/hr', 'App\Http\Controllers\HrController@gethr')->middleware('CustomAuth');
Route::post('/hr/submit', 'App\Http\Controllers\HrController@submit')->name('hr_submit');

Route::get('/avu', 'App\Http\Controllers\AVUController@getavu')->middleware('CustomAuth');
//Route::get('/avu', 'App\Http\Controllers\AVUController@dropDownShow')->middleware('CustomAuth');
Route::post('/avu/submit', 'App\Http\Controllers\AVUController@submit')->name('avu_submit');;

// Route::get('/af', 'App\Http\Controllers\SendEmailVCController@index');
Route::post('/af/send', 'App\Http\Controllers\AgriFarmController@send');
Route::post('/hr/send', 'App\Http\Controllers\HrController@send');
Route::post('/nest/send', 'App\Http\Controllers\NestController@send');

Route::get('/view_reports','App\Http\Controllers\PagesController@view_reports' )->middleware('ReportGeneratorMiddleware');

Route::get('/admin','App\Http\Controllers\PagesController@admin' )->middleware('AdminMiddleware');
Route::get('/vc','App\Http\Controllers\PagesController@vc' )->middleware('VCMiddleware');
Route::get('/avucoordinator','App\Http\Controllers\PagesController@avucoordinator' )->middleware('AVUCoordinator');
Route::get('/nestcoordinator','App\Http\Controllers\PagesController@nestcoordinator' )->middleware('NestCoordinatorMiddleware');
Route::get('/agricoordinator','App\Http\Controllers\PagesController@agricoordinator' )->middleware('AgriFarmCoordinatorMiddleware');
Route::get('/hrcoordinator','App\Http\Controllers\PagesController@hrcoordinator' )->middleware('HrCoordinatorMiddleware');

Route::get('/hrreg','App\Http\Controllers\PagesController@hrreg' )->middleware('HrRegistarMiddleware');
Route::get('/nestreg','App\Http\Controllers\PagesController@nestreg' )->middleware('NestRegistarMiddleware');
Route::get('/guestbooking','App\Http\Controllers\PagesController@guestbooking' );

Route::get('/dean_hod','App\Http\Controllers\PagesController@dean_hod' )->middleware('DeanHodMiddleware');

Route::get('/viewagribooking', 'App\Http\Controllers\SendEmailVCController@viewagribooking')->name('viewagribooking');
Route::get('/viewvcagribooking', 'App\Http\Controllers\SendEmailVCController@viewvcagribooking')->name('viewvcagribooking');
Route::get('/download-agrispdf', 'App\Http\Controllers\SendEmailVCController@downloadpdf')->name('downloadpdf');
Route::get('/download-agrismonthpdf', 'App\Http\Controllers\SendEmailVCController@downloadmonthpdf')->name('downloadmonthpdf');
Route::get('/download-agriyearpdf', 'App\Http\Controllers\SendEmailVCController@downloadyearpdf')->name('downloadyearpdf');

Route::get('/viewcthrbooking', 'App\Http\Controllers\ViewHrBookingController@viewcthrbooking')->name('viewcthrbooking')->middleware('CareTakerMiddleware');
Route::get('/viewhrbooking', 'App\Http\Controllers\ViewHrBookingController@viewhrbooking')->name('viewhrbooking');
Route::get('/viewreghrbooking', 'App\Http\Controllers\ViewHrBookingController@viewreghrbooking')->name('viewreghrbooking');
Route::get('/viewvchrbooking', 'App\Http\Controllers\ViewHrBookingController@viewvchrbooking')->name('viewvchrbooking');
Route::get('/download-hrpdf', 'App\Http\Controllers\ViewHrBookingController@downloadpdf')->name('downloadpdf');
Route::get('/download-hrmonthpdf', 'App\Http\Controllers\ViewHrBookingController@downloadmonthpdf')->name('downloadmonthpdf');
Route::get('/download-hryearpdf', 'App\Http\Controllers\ViewHrBookingController@downloadyearpdf')->name('downloadyearpdf');

Route::get('/viewregnestbooking', 'App\Http\Controllers\ViewNestBookingController@viewregnestbooking')->name('viewregnestbooking');
Route::get('/viewnestbooking', 'App\Http\Controllers\ViewNestBookingController@viewnestbooking')->name('viewnestbooking');
Route::get('/download-pdf', 'App\Http\Controllers\ViewNestBookingController@downloadpdf')->name('downloadpdf');
Route::get('/download-monthpdf', 'App\Http\Controllers\ViewNestBookingController@downloadmonthpdf')->name('downloadmonthpdf');
Route::get('/download-yearpdf', 'App\Http\Controllers\ViewNestBookingController@downloadyearpdf')->name('downloadyearpdf');
Route::get('/viewvcnestbooking', 'App\Http\Controllers\ViewNestBookingController@viewvcnestbooking')->name('viewvcnestbooking');

Route::get('showadminaf/{id}','App\Http\Controllers\AdminAgriSBookingController@showaf');
Route::post('showadminaf/{id}','App\Http\Controllers\AdminAgriSBookingController@vcapprove');
Route::get('showaf/{id}','App\Http\Controllers\SendEmailVCController@showaf');
Route::post('showaf/{id}','App\Http\Controllers\SendEmailVCController@addvccomment');
Route::get('/viewdeanhodagrisbooking', 'App\Http\Controllers\SendEmailVCController@viewdeanhodagrisbooking')->name('viewdeanhodagrisbooking');  
Route::get('showrecagri/{id}','App\Http\Controllers\SendEmailVCController@getRecommendation');
Route::get('showvcagri/{id}','App\Http\Controllers\SendEmailVCController@vcapprove');

Route::get('showadminhr/{id}','App\Http\Controllers\AdminHrBookingController@showhr');
Route::post('showadminhr/{id}','App\Http\Controllers\AdminHrBookingController@vcapprove');
Route::get('showhr/{id}','App\Http\Controllers\ViewHrBookingController@showhr');
Route::get('showreghr/{id}','App\Http\Controllers\ViewHrBookingController@showreghr');
Route::get('showvchr/{id}','App\Http\Controllers\ViewHrBookingController@vcapprove');
Route::post('showhr/{id}','App\Http\Controllers\ViewHrBookingController@Update');
Route::get('showrechr/{id}','App\Http\Controllers\ViewHrBookingController@getRecommendation');
Route::post('showhrdean/{id}','App\Http\Controllers\ViewHrBookingController@addheadcomment');
Route::post('showhrvc/{id}','App\Http\Controllers\ViewHrBookingController@addvccomment');
Route::post('showreghr/{id}','App\Http\Controllers\ViewHrBookingController@addregcomment');
Route::get('/viewdeanhodhrbooking', 'App\Http\Controllers\ViewHrBookingController@viewdeanhodhrbooking')->name('viewdeanhodhrbooking');  

Route::get('showadminnest/{id}','App\Http\Controllers\AdminNestBookingController@shownest');
Route::post('showadminnest/{id}','App\Http\Controllers\AdminNestBookingController@vcapprove');
Route::get('shownest/{id}','App\Http\Controllers\ViewNestBookingController@shownest');
Route::get('showregnest/{id}','App\Http\Controllers\ViewNestBookingController@showregnest');
Route::get('showvcnest/{id}','App\Http\Controllers\ViewNestBookingController@vcapprove');
Route::post('shownest/{id}','App\Http\Controllers\ViewNestBookingController@Update');
Route::get('showrecnest/{id}','App\Http\Controllers\ViewNestBookingController@getRecommendation');
Route::post('shownestdean/{id}','App\Http\Controllers\ViewNestBookingController@addheadcomment');
Route::post('shownestvc/{id}','App\Http\Controllers\ViewNestBookingController@addvccomment');
Route::post('showregnest/{id}','App\Http\Controllers\ViewNestBookingController@addregcomment');
Route::get('/viewdeanhodnestbooking', 'App\Http\Controllers\ViewNestBookingController@viewdeanhodnestbooking')->name('viewdeanhodnestbooking');  


Route::get('/viewagridbooking', 'App\Http\Controllers\ViewAFDBookingController@viewagridbooking')->name('viewagridbooking');
Route::get('/viewvcagridbooking', 'App\Http\Controllers\ViewAFDBookingController@viewvcagridbooking')->name('viewvcagridbooking');
Route::get('/download-agridpdf', 'App\Http\Controllers\ViewAFDBookingController@downloadpdf')->name('downloadpdf');
Route::get('/download-agridmonthpdf', 'App\Http\Controllers\ViewAFDBookingController@downloadmonthpdf')->name('downloadmonthpdf');
Route::get('/download-agridyearpdf', 'App\Http\Controllers\ViewAFDBookingController@downloadyearpdf')->name('downloadyearpdf');

Route::get('showadmin/{id}','App\Http\Controllers\AdminDBookingController@show');
Route::post('showadmin/{id}','App\Http\Controllers\AdminDBookingController@vcapprove');
Route::get('show/{id}','App\Http\Controllers\ViewAFDBookingController@show');
//Route::post('show/{id}','App\Http\Controllers\ViewAFDBookingController@vcapprove');
Route::post('show/{id}','App\Http\Controllers\ViewAFDBookingController@addvccomment');
Route::get('/viewdeanhodagridbooking', 'App\Http\Controllers\ViewAFDBookingController@viewdeanhodagridbooking')->name('viewdeanhodagridbooking');  
Route::get('showrecagrid/{id}','App\Http\Controllers\ViewAFDBookingController@getRecommendation');
Route::get('showvcagrid/{id}','App\Http\Controllers\ViewAFDBookingController@vcapprove');


//Route::get('/viewhrbooking', 'App\Http\Controllers\ViewHrBookingController@viewhrbooking')->name('viewhrbooking'); 
 
//Route::get('/viewavubooking', 'App\Http\Controllers\ViewAVUBookingController@viewavubooking')->name('viewavubooking'); 

Route::get('/viewadminagribooking', 'App\Http\Controllers\AdminAgriSBookingController@viewadminagribooking')->name('viewadminagribooking')->middleware('AdminMiddleware');
Route::get('/viewadminnestbooking', 'App\Http\Controllers\AdminNestBookingController@viewadminnestbooking')->name('viewadminnestbooking')->middleware('AdminMiddleware'); 
Route::get('/viewadminafdbooking', 'App\Http\Controllers\AdminDBookingController@viewadminafdbooking')->name('viewadminafdbooking')->middleware('AdminMiddleware');
Route::get('/viewadminhrbooking', 'App\Http\Controllers\AdminHrBookingController@viewadminhrbooking')->name('viewadminhrbooking')->middleware('AdminMiddleware');
Route::get('/viewadminavubooking', 'App\Http\Controllers\AdminAVUBookingController@viewadminavubooking')->name('viewadminavubooking')->middleware('AdminMiddleware'); 

Route::get('/viewreportagribooking', 'App\Http\Controllers\SendEmailVCController@viewreportagribooking')->name('viewreportagribooking')->middleware('ReportGeneratorMiddleware');
Route::get('/viewreportnestbooking', 'App\Http\Controllers\ViewNestBookingController@viewreportnestbooking')->name('viewreportnestbooking')->middleware('ReportGeneratorMiddleware'); 
Route::get('/viewreportagridbooking', 'App\Http\Controllers\ViewAFDBookingController@viewreportafdbooking')->name('viewreportafdbooking')->middleware('ReportGeneratorMiddleware');
Route::get('/viewreporthrbooking', 'App\Http\Controllers\ViewHrBookingController@viewreporthrbooking')->name('viewreporthrbooking')->middleware('ReportGeneratorMiddleware');
Route::get('/viewreportavubooking', 'App\Http\Controllers\ViewAVUBookingController@viewreportavubooking')->name('viewreportavubooking')->middleware('ReportGeneratorMiddleware'); 

Route::get('/viewguestagribooking', 'App\Http\Controllers\SendEmailVCController@viewguestagribooking')->name('viewguestagribooking');
Route::get('/viewguestnestbooking', 'App\Http\Controllers\ViewNestBookingController@viewguestnestbooking')->name('viewguestnestbooking'); 
Route::get('/viewguestagridbooking', 'App\Http\Controllers\ViewAFDBookingController@viewguestagridbooking')->name('viewguestagridbooking');
Route::get('/viewguesthrbooking', 'App\Http\Controllers\ViewHrBookingController@viewguesthrbooking')->name('viewguesthrbooking');
Route::get('/viewguestavubooking', 'App\Http\Controllers\ViewAVUBookingController@viewguestavubooking')->name('viewguestavubooking'); 


Route::get('/viewavubooking', 'App\Http\Controllers\ViewAVUBookingController@viewavubooking')->name('viewavubooking');
Route::get('/viewdeanhodavubooking', 'App\Http\Controllers\ViewAVUBookingController@viewdeanhodavubooking')->name('viewdeanhodavubooking');  
Route::get('/viewSelectavubooking', 'App\Http\Controllers\ViewAVUBookingController@viewSelectavubooking')->name('viewSelectavubooking'); 

Route::get('/download-avupdf', 'App\Http\Controllers\ViewAVUBookingController@downloadpdf')->name('downloadpdf');
Route::get('/download-avumonthpdf', 'App\Http\Controllers\ViewAVUBookingController@downloadmonthpdf')->name('downloadmonthpdf');
Route::get('/download-avuyearpdf', 'App\Http\Controllers\ViewAVUBookingController@downloadyearpdf')->name('downloadyearpdf');

//Route::get('approve/{BookingId}','App\Http\Controllers\SendEmailVCController@edit');
Route::get('hrapprove/{BookingId}','App\Http\Controllers\ViewHrBookingController@edit');
Route::get('nestapprove/{BookingId}','App\Http\Controllers\ViewNestBookingController@edit');

Route::get('avuconfirm/{BookingId}','App\Http\Controllers\ViewAVUBookingController@edit');
Route::get('avunotconfirm/{BookingId}','App\Http\Controllers\ViewAVUBookingController@reject');
Route::get('avuadminconfirm/{BookingId}','App\Http\Controllers\AdminAVUBookingController@edit');
Route::get('avuadminnotconfirm/{BookingId}','App\Http\Controllers\AdminAVUBookingController@reject');

Route::get('avurecommend/{BookingId}','App\Http\Controllers\ViewAVUBookingController@recommend');
Route::get('avunnotrecommend/{BookingId}','App\Http\Controllers\ViewAVUBookingController@notrecommend');
Route::get('showavudean/{id}','App\Http\Controllers\ViewAVUBookingController@showavudean');
Route::post('showavudean/{id}','App\Http\Controllers\ViewAVUBookingController@addheadcomment');
Route::get('showrecavu/{id}','App\Http\Controllers\ViewAVUBookingController@getRecommendation');


Route::get('nestrecommend/{BookingId}','App\Http\Controllers\ViewNestBookingController@recommend');
Route::get('nestnotrecommend/{BookingId}','App\Http\Controllers\ViewNestBookingController@notrecommend');
Route::get('nestconfirm/{BookingId}','App\Http\Controllers\ViewNestBookingController@confirm');
Route::get('nestconfirm/request-payment/{BookingId}','App\Http\Controllers\ViewNestBookingController@requestpayment');
Route::get('nestnotconfirm/{BookingId}','App\Http\Controllers\ViewNestBookingController@reject');
Route::get('nestregconfirm/{BookingId}','App\Http\Controllers\ViewNestBookingController@regconfirm');
Route::get('nestregapprove/{BookingId}','App\Http\Controllers\ViewNestBookingController@regapprove');
Route::get('nestregnotconfirm/{BookingId}','App\Http\Controllers\ViewNestBookingController@regreject');
Route::get('nestadminconfirm/{BookingId}','App\Http\Controllers\AdminNestBookingController@confirm');
Route::get('nestadminnotconfirm/{BookingId}','App\Http\Controllers\AdminNestBookingController@reject');

Route::get('nestapprove/{BookingId}','App\Http\Controllers\ViewNestBookingController@nestapprove');
Route::get('nestnotapprove/{BookingId}','App\Http\Controllers\ViewNestBookingController@nestnotapprove');
Route::get('shownestvc/{id}','App\Http\Controllers\ViewNestBookingController@shownestvc');
Route::get('shownestdean/{id}','App\Http\Controllers\ViewNestBookingController@shownestdean');

Route::get('hrrecommend/{BookingId}','App\Http\Controllers\ViewHrBookingController@recommend');
Route::get('hrnotrecommend/{BookingId}','App\Http\Controllers\ViewHrBookingController@notrecommend');
Route::get('hrconfirm/{BookingId}','App\Http\Controllers\ViewHrBookingController@confirm');
Route::get('hrconfirm/request-payment/{BookingId}','App\Http\Controllers\ViewHrBookingController@requestPayment');
Route::get('hrnotconfirm/{BookingId}','App\Http\Controllers\ViewHrBookingController@reject');
Route::get('hrregconfirm/{BookingId}','App\Http\Controllers\ViewHrBookingController@regconfirm');
Route::get('hrregapprove/{BookingId}','App\Http\Controllers\ViewHrBookingController@regapprove');
Route::get('hrregnotconfirm/{BookingId}','App\Http\Controllers\ViewHrBookingController@regreject');
Route::get('hradminconfirm/{BookingId}','App\Http\Controllers\AdminHrBookingController@confirm');
Route::get('hradminnotconfirm/{BookingId}','App\Http\Controllers\AdminHrBookingController@reject');

Route::get('hrapprove/{BookingId}','App\Http\Controllers\ViewHrBookingController@hrapprove');
Route::get('hrnotapprove/{BookingId}','App\Http\Controllers\ViewHrBookingController@hrnotapprove');
Route::get('showhrvc/{id}','App\Http\Controllers\ViewHrBookingController@showhrvc');
Route::get('showhrdean/{id}','App\Http\Controllers\ViewHrBookingController@showhrdean');


Route::get('afrecommend/{BookingId}','App\Http\Controllers\SendEmailVCController@recommend');
Route::get('afnotrecommend/{BookingId}','App\Http\Controllers\SendEmailVCController@notrecommend');
Route::get('afconfirm/{BookingId}','App\Http\Controllers\SendEmailVCController@confirm');
Route::get('afconfirm/request-payment/{BookingId}','App\Http\Controllers\SendEmailVCController@requestPayment');
Route::get('afnotconfirm/{BookingId}','App\Http\Controllers\SendEmailVCController@reject');
Route::get('afadminconfirm/{BookingId}','App\Http\Controllers\AdminAgriSBookingController@confirm');
Route::get('afadminnotconfirm/{BookingId}','App\Http\Controllers\AdminAgriSBookingController@reject');

// cancel
Route::get('afdcancel/{BookingId}','App\Http\Controllers\ViewAFDBookingController@cancelBooking');
Route::get('afcancel/{BookingId}','App\Http\Controllers\AgriFarmController@cancelBooking');
Route::get('nestcancel/{BookingId}','App\Http\Controllers\ViewNestBookingController@cancelBooking');
Route::get('hrcancel/{BookingId}','App\Http\Controllers\ViewHrBookingController@cancelBooking');

Route::get('afsapprove/{BookingId}','App\Http\Controllers\SendEmailVCController@afsapprove');
Route::get('afsnotapprove/{BookingId}','App\Http\Controllers\SendEmailVCController@afsnotapprove');
Route::get('showafsvc/{id}','App\Http\Controllers\SendEmailVCController@showafsvc');
Route::get('showafdean/{id}','App\Http\Controllers\SendEmailVCController@showafdean');
Route::post('showafdean/{id}','App\Http\Controllers\SendEmailVCController@addheadcomment');

Route::get('afdrecommend/{BookingId}','App\Http\Controllers\ViewAFDBookingController@recommend');
Route::get('afdnotrecommend/{BookingId}','App\Http\Controllers\ViewAFDBookingController@notrecommend');
Route::get('afdconfirm/{BookingId}','App\Http\Controllers\ViewAFDBookingController@confirm');
Route::get('afdconfirm/request-payment/{BookingId}','App\Http\Controllers\ViewAFDBookingController@requestPayment');
Route::get('afdnotconfirm/{BookingId}','App\Http\Controllers\ViewAFDBookingController@reject');
Route::get('afdadminconfirm/{BookingId}','App\Http\Controllers\AdminDBookingController@confirm');
Route::get('afdadminnotconfirm/{BookingId}','App\Http\Controllers\AdminDBookingController@reject');

Route::get('afdapprove/{BookingId}','App\Http\Controllers\ViewAFDBookingController@afdapprove');
Route::get('afdnotapprove/{BookingId}','App\Http\Controllers\ViewAFDBookingController@afdnotapprove');
Route::get('showafdvc/{id}','App\Http\Controllers\ViewAFDBookingController@showafdvc');
Route::get('showafddean/{id}','App\Http\Controllers\ViewAFDBookingController@showafddean');
Route::post('showafddean/{id}','App\Http\Controllers\ViewAFDBookingController@addheadcomment');

Route::get('/edit-records','App\Http\Controllers\UserDetailsController@index')->middleware('AdminMiddleware');;
Route::get('edit/{id}','App\Http\Controllers\UserDetailsController@show');
Route::post('edit/{id}','App\Http\Controllers\UserDetailsController@edit');
Route::get('delete/{id}','App\Http\Controllers\UserDetailsController@destroy');

Route::get('/guest-records','App\Http\Controllers\UserDetailsController@guestonly')->middleware('AdminMiddleware');
Route::get('editguest/{id}','App\Http\Controllers\UserDetailsController@showguest');
Route::post('editguest/{id}','App\Http\Controllers\UserDetailsController@editguest');

Route::get('/guest-show','App\Http\Controllers\UserDetailsController@guestshowonly');

Route::get('/view-msg','App\Http\Controllers\UserDetailsController@showmsg')->middleware('AdminMiddleware');;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

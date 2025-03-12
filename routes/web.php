<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChurchController;
use App\Http\Controllers\EventController;
use App\Models\Event;
use App\Models\Baptism_folder;
use App\Models\ConfirmationFolder;
use App\Models\WeddingFolder;
use App\Models\Funeral_folder;
use App\Models\Book_folder;
use App\Models\Schedule;
use App\Http\Controllers\BaptismFolderController;
use App\Http\Controllers\ManagebookController;
use App\Http\Controllers\BookFolderController;
use App\Http\Controllers\BookRecordController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\FuneralFolderController;
use App\Http\Controllers\FuneralRecordController;
use App\Http\Controllers\ConfirmationRecordController;
use App\Http\Controllers\ConfirmationFolderController;
use App\Http\Controllers\WeddingFolderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ScheduleController;


Route::get('/','App\Http\Controllers\ChurchController@index')->middleware('auth');
//batptism
Route::get('/baptism', [BaptismFolderController::class, 'index'])->name('baptism.index')->middleware('auth');
Route::post('/add-year', [BaptismFolderController::class, 'addYear'])->name('add.year')->middleware('auth');
Route::get('/baptism_archive/{id}', [BaptismFolderController::class, 'archive'])->name('baptism.archive')->middleware('auth');
Route::get('/baptism_retrieve/{year}', [BaptismFolderController::class, 'retrieve'])->name('baptism.retrieve')->middleware('auth');
Route::get('/baptism_archive/month/{year}', [BaptismFolderController::class, 'month'])->name('baptism.archive.month')->middleware('auth');
//book
Route::get('/book/{baptism_id}', [BookFolderController::class, 'showByBaptism'])->name('book.showByBaptism')->middleware('auth');
Route::get('/book_archived/{baptism_id}', [BookFolderController::class, 'showByBaptismArchived'])->name('book.showByBaptismArchived')->middleware('auth');
Route::get('/book_archived/retrieve/{baptism_id}', [BookFolderController::class, 'retrieve'])->name('book.retrieve')->middleware('auth');
Route::post('/book/store', [BookFolderController::class, 'store'])->name('book.store')->middleware('auth');
Route::get('/bookfolder_archive/{id}', [BookFolderController::class, 'archive'])->name('bookfolder.archive')->middleware('auth');


//baptism_record
Route::put('/baptism-record/{id}', [BookRecordController::class, 'update'])->name('baptism.record.update')->middleware('auth');
Route::get('/godparents/{baptism_id}', [BookRecordController::class, 'getGodparents'])->middleware('auth');
Route::put('/baptism-record/{id}', [BookRecordController::class, 'update'])->name('baptism.record.update')->middleware('auth');
Route::get('/book_record/{baptism_id}', [BookRecordController::class, 'showByBaptism'])->name('book_record.showByBaptism')->middleware('auth');
Route::get('/book_record_archived/{baptism_id}', [BookRecordController::class, 'showByBaptismArchived'])->name('book_record.showByBaptismArchived')->middleware('auth');
Route::get('/delete_record/{id}', [BookRecordController::class, 'destroy'])->name('book_record.destroy')->middleware('auth');
Route::get('/checkbaptism/{id}', [BookRecordController::class, 'check'])->name('book_record.check')->middleware('auth');
Route::post('/book_record/{baptism_id}', [BookRecordController::class, 'store'])->name('baptism.record.store')->middleware('auth');
Route::get('/book-record/{id}', [BookRecordController::class, 'showInfo'])->name('book.record.info')->middleware('auth');
Route::get('/bookrecord/archive/{id}', [BookRecordController::class, 'archive'])->name('bookrecord.archive')->middleware('auth');
Route::get('/bookrecord_retrieve/{id}', [BookRecordController::class, 'retrieve'])->name('bookrecord.retrieve')->middleware('auth');
Route::get('/baptism_certificate/{id}', [BookRecordController::class, 'certificate'])->name('book_record.certificate')->middleware('auth');
Route::get('/baptism_print/{id}', [BookRecordController::class, 'print'])->name('book_record.print')->middleware('auth');

//check baptism record limit


Route::get('/check-baptism-date', [BookRecordController::class, 'checkBaptismDate']);
Route::get('/check-confirmation-date', [ConfirmationRecordController::class, 'checkConfirmation']);
Route::get('/check-wedding-date', [WeddingFolderController::class, 'checkwedding']);
Route::get('/check-funeral-date', [FuneralRecordController::class, 'checkfuneral']);

//confirmation
Route::get('/confirmation', [ConfirmationFolderController::class, 'index'])->name('baptism.index')->middleware('auth');
Route::get('/confirmationfolder/archive/{id}', [ConfirmationFolderController::class, 'archive'])->name('confirmationfolder.archive')->middleware('auth');
Route::get('/confirmationfolder/archive/retrieve/{year}', [ConfirmationFolderController::class, 'retrieve'])->name('confirmationfolder.retrieve')->middleware('auth');
Route::get('/confirmationfolder/archive/month/{year}', [ConfirmationFolderController::class, 'month'])->name('confirmationfolder.archive.month')->middleware('auth');
Route::post('/add-year-confirmation', [ConfirmationFolderController::class, 'addYear'])->name('add.year.confirmation')->middleware('auth');
//confirmation record
Route::get('/confirmation_record/{confirmation_id}', [ConfirmationRecordController::class, 'showByFuneral'])->name('funeral_record.showByFuneral')->middleware('auth');
Route::get('/confirmation_record_archive/{confirmation_id}', [ConfirmationRecordController::class, 'showByFuneralArchived'])->name('funeral_record.showByFuneralArchived')->middleware('auth');
Route::post('/confirmation-record', [ConfirmationRecordController::class, 'store'])->name('confirmation.record.store')->middleware('auth');
Route::get('/confirmation/{id}', [ConfirmationRecordController::class, 'showConfirmationInfo'])->name('confirmation.info')->middleware('auth');
Route::get('/confirmation/delete/{id}', [ConfirmationRecordController::class, 'destroy'])->name('confirmation.destroy')->middleware('auth');
Route::get('/confirmation/status/{id}', [ConfirmationRecordController::class, 'status'])->name('confirmation.status')->middleware('auth');
Route::get('/confirmationrecord/archive/{id}', [ConfirmationRecordController::class, 'archive'])->name('confirmationrecord.archive')->middleware('auth');
Route::get('/confirmationrecord/archive/retrieve/{id}', [ConfirmationRecordController::class, 'retrieve'])->name('confirmationrecord.retrieve')->middleware('auth');
Route::put('/confirmation-record/update', [ConfirmationRecordController::class, 'update'])->name('confirmation.record.update')->middleware('auth');

Route::get('/confirmation_certificate/{id}', [ConfirmationRecordController::class, 'certificate'])->name('book_record.certificate')->middleware('auth');
Route::get('/confirmation_print/{id}', [ConfirmationRecordController::class, 'print'])->name('book_record.print')->middleware('auth');
//wedding
Route::post('/wedding-record', [WeddingFolderController::class, 'store'])->name('wedding.record.store')->middleware('auth');
Route::get('/wedding_record/{wedding_id}', [WeddingFolderController::class, 'showByWedding'])->name('wedding_record.showByWedding')->middleware('auth');
Route::get('/wedding_record_archived/{wedding_id}', [WeddingFolderController::class, 'showByWeddingArchived'])->name('wedding_record.showByWeddingArchived')->middleware('auth');
Route::get('/wedding', [WeddingFolderController::class, 'index'])->name('wedding.index')->middleware('auth');
Route::get('/wedding/destroy/{id}', [WeddingFolderController::class, 'delete'])->name('wedding.destroy')->middleware('auth');
Route::get('/wedding/status/{id}', [WeddingFolderController::class, 'status'])->name('wedding.status')->middleware('auth');
Route::post('/add-year-wedding', [WeddingFolderController::class, 'addYear'])->name('add.year.wedding')->middleware('auth');
Route::get('/weddingfolder/archive/{id}', [WeddingFolderController::class, 'archive'])->name('weddingfolder.archive')->middleware('auth');
Route::get('/weddingfolder/archive/month/{year}', [WeddingFolderController::class, 'month'])->name('weddingfolder.archive.month')->middleware('auth');
Route::get('/weddingrecord/archive/{id}', [WeddingFolderController::class, 'archive_record'])->name('weddingrecord.archive')->middleware('auth');
Route::get('/weddingrecord/archive/retrieve/{year}', [WeddingFolderController::class, 'retrieve'])->name('weddingrecord.retrive')->middleware('auth');
Route::get('/weddingrecord/archive/retrieverecord/{id}', [WeddingFolderController::class, 'retrieve'])->name('weddingrecord.retrive')->middleware('auth');

Route::put('/weddings/update', [WeddingFolderController::class, 'update'])->name('weddings.update')->middleware('auth'); // Update a wedding record
Route::get('/wedding_info/{wedding_id}', [WeddingFolderController::class, 'showWeddingInfo'])->name('wedding.info')->middleware('auth');
//funeral
Route::get('/funeral', [FuneralFolderController::class, 'index'])->name('funeral.index')->middleware('auth');
Route::get('/funeral_record', 'App\Http\Controllers\ChurchController@funeral_record')->middleware('auth');

Route::post('/add-year-funeral', [FuneralFolderController::class, 'addYear'])->name('add.year.funeral')->middleware('auth');
Route::get('/funeralfolder/archive/{id}', [FuneralFolderController::class, 'archive'])->name('funeralfolder.archive')->middleware('auth');
Route::get('/funeralfolder/archive/retrieve/{year}', [FuneralFolderController::class, 'retrieve'])->name('funeralfolder.retrieve')->middleware('auth');
Route::get('/funeralfolder/archive/month/{year}', [FuneralFolderController::class, 'month'])->name('funeralfolder.archive,month')->middleware('auth');


//funeralRecord
Route::get('/funeral_record/{funerals_id}', [FuneralRecordController::class, 'showByFuneral'])->name('funeral_record.showByFuneral')->middleware('auth');
Route::get('/funeral_record/destroy/{id}', [FuneralRecordController::class, 'destroy'])->name('funeral_record.destroy')->middleware('auth');
Route::get('/funeral_record/status/{id}', [FuneralRecordController::class, 'status'])->name('funeral_record.status')->middleware('auth');
Route::get('/funeral_record_archived/{funerals_id}', [FuneralRecordController::class, 'showByFuneralArchived'])->name('funeral_record.showByFuneralArchived')->middleware('auth');
Route::get('/funeral_record_archived/retrieve/{id}', [FuneralRecordController::class, 'retrieve'])->name('funeral_record.retrieve')->middleware('auth');
Route::post('/funeral-record', [FuneralRecordController::class, 'store'])->name('funeral.record.store')->middleware('auth');
Route::put('/funeral-record/update', [FuneralRecordController::class, 'update'])->name('funeral.record.update')->middleware('auth');
Route::get('/funeral/{id}', [FuneralRecordController::class, 'showFuneralInfo'])->name('funeral.info')->middleware('auth');
Route::get('/funeralrecord/archive/{id}', [FuneralRecordController::class, 'archive'])->name('funeralrecord.archive')->middleware('auth');
//members
Route::get('/member', [MemberController::class, 'index'])->name('members.index')->middleware('auth');
Route::post('/member', [MemberController::class, 'store'])->name('member.store')->middleware('auth');
Route::resource('members', MemberController::class)->middleware('auth');
Route::put('/members/{member}', [MemberController::class, 'update'])->name('members.update')->middleware('auth');
Route::get('/members/archive/{id}', [MemberController::class, 'archive'])->name('members.archive')->middleware('auth');
Route::get('/members/archive/retrieve/{id}', [MemberController::class, 'retrieve'])->name('members.retrieve')->middleware('auth');
//volunteer
Route::get('/volunteer', [VolunteerController::class, 'index'])->name('volunteers.index')->middleware('auth');
Route::post('/volunteer', [VolunteerController::class, 'store'])->name('volunteer.store')->middleware('auth');
Route::resource('volunteers', VolunteerController::class)->middleware('auth')->middleware('auth');
Route::put('/volunteers/{volunteer}', [VolunteerController::class, 'update'])->name('volunteers.update')->middleware('auth');
Route::get('/volunteers/archive/{id}', [VolunteerController::class, 'archive'])->name('volunteers.archive')->middleware('auth');
Route::get('/volunteers/archive/retrieve/{id}', [VolunteerController::class, 'retrieve'])->name('volunteers.retrieve')->middleware('auth');

Route::get('/collection', [CollectionController::class, 'index'])->middleware('auth');
Route::get('/collection_info/{id}', [CollectionController::class, 'info'])->name('collection.info')->middleware('auth');
Route::post('/collection/store', [CollectionController::class, 'store'])->name('collection.store')->middleware('auth');
Route::get('/collection_records/archive/{id}', [CollectionController::class, 'archive'])->name('collection_records.archive')->middleware('auth');

Route::get('/donation', [DonationController::class, 'index'])->middleware('auth');
Route::post('/donation/store', [DonationController::class, 'store'])->name('donation.store')->middleware('auth');
Route::get('/donation_info/{id}', [DonationController::class, 'info'])->name('donations.info')->middleware('auth');
Route::get('/donations/archive/{id}', [DonationController::class, 'archive'])->name('donations.archive')->middleware('auth');
Route::get('/calendars','App\Http\Controllers\ChurchController@calendar' )->middleware('auth');


Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index')->middleware('auth');
Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store')->middleware('auth');
Route::get('/payment_info/{id}', [PaymentController::class, 'info'])->name('payment.info')->middleware('auth');
Route::get('/payment/archive/{id}', [PaymentController::class, 'archive'])->name('payment.archive')->middleware('auth');


Route::get('/archive', [ArchiveController::class, 'index'])->name('archives.index')->middleware('auth');
Route::get('/archives/{category}', [ArchiveController::class, 'fetch'])->name('archives.fetch')->middleware('auth');

//mangebook
Route::get('/managebook', [ManagebookController::class, 'index'])->name('managebook.index')->middleware('auth');



Route::get('/schedules', [ScheduleController::class, 'index'])->name('calendar.index')->middleware('auth');
Route::post('/events/store', [ScheduleController::class, 'store'])->name('events.store')->middleware('auth');
Route::post('/events/update', [ScheduleController::class, 'update'])->name('events.update')->middleware('auth');
Route::post('/events/delete', [ScheduleController::class, 'destroy'])->name('events.delete')->middleware('auth');
Route::get('/events/load', [ScheduleController::class, 'load'])->name('events.load')->middleware('auth');


Route::get('schedules', [ScheduleController::class, 'index'])->name('calendar.index')->middleware('auth');
Route::post('calendar', [ScheduleController::class, 'store'])->name('calendar.store')->middleware('auth');
Route::patch('calendar/update/{id}', [ScheduleController::class, 'update'])->name('calendar.update');
Route::delete('calendar/destroy/{id}', [ScheduleController::class, 'destroy'])->name('calendar.destroy');

Route::post('/', 'App\Http\Controllers\EventController@store');
Route::get('/get-events', function() {
    $events = Schedule::all(); 
    return response()->json($events);
});

use Illuminate\Http\Request;
//baptism
Route::get('/api/check-year-month', function (Request $request) {
    $year = $request->query('year');
    $month = $request->query('month');

    $exists = Baptism_folder::where('year', $year)
                ->where('month', $month)
                ->exists();

    return response()->json(['exists' => $exists]);
});
Route::post('/api/add-year', function (Request $request) {
    $request->validate([
        'year'  => 'required|integer',
        'month' => 'required|string'
    ]);

    // Double-check to prevent duplicates
    $exists = Baptism_folder::where('year', $request->year)
                ->where('month', $request->month)
                ->exists();

    if ($exists) {
        return response()->json(['success' => false, 'message' => 'Record already exists.']);
    }

    $baptism = new Baptism_folder();
    $baptism->year  = $request->year;
    $baptism->month = $request->month;
    $baptism->save();

    return response()->json(['success' => true, 'message' => 'Year added successfully!']);
});
//confirmation
Route::get('/api/check-year-month-confirmation', function (Request $request) {
    $year = $request->query('year');
    $month = $request->query('month');

    $exists = ConfirmationFolder::where('year', $year)
                ->where('month', $month)
                ->exists();

    return response()->json(['exists' => $exists]);
});
Route::post('/api/add-year-confirmation', function (Request $request) {
    $request->validate([
        'year'  => 'required|integer',
        'month' => 'required|string'
    ]);

    // Double-check to prevent duplicates
    $exists = ConfirmationFolder::where('year', $request->year)
                ->where('month', $request->month)
                ->exists();

    if ($exists) {
        return response()->json(['success' => false, 'message' => 'Record already exists.']);
    }

    $confirmation = new ConfirmationFolder();
    $confirmation->year  = $request->year;
    $confirmation->month = $request->month;
    $confirmation->save();

    return response()->json(['success' => true, 'message' => 'Year added successfully!']);
});

//wedding
Route::get('/api/check-year-month-wedding', function (Request $request) {
    $year = $request->query('year');
    $month = $request->query('month');

    $exists = WeddingFolder::where('year', $year)
                ->where('month', $month)
                ->exists();

    return response()->json(['exists' => $exists]);
});
Route::post('/api/add-year-wedding', function (Request $request) {
    $request->validate([
        'year'  => 'required|integer',
        'month' => 'required|string'
    ]);

    // Double-check to prevent duplicates
    $exists = WeddingFolder::where('year', $request->year)
                ->where('month', $request->month)
                ->exists();

    if ($exists) {
        return response()->json(['success' => false, 'message' => 'Record already exists.']);
    }

    $confirmation = new WeddingFolder();
    $confirmation->year  = $request->year;
    $confirmation->month = $request->month;
    $confirmation->save();

    return response()->json(['success' => true, 'message' => 'Year added successfully!']);
});

//funeral
Route::get('/api/check-year-month-funeral', function (Request $request) {
    $year = $request->query('year');
    $month = $request->query('month');

    $exists = Funeral_folder::where('year', $year)
                ->where('month', $month)
                ->exists();

    return response()->json(['exists' => $exists]);
});
Route::post('/api/add-year-funeral', function (Request $request) {
    $request->validate([
        'year'  => 'required|integer',
        'month' => 'required|string'
    ]);

    // Double-check to prevent duplicates
    $exists = Funeral_folder::where('year', $request->year)
                ->where('month', $request->month)
                ->exists();

    if ($exists) {
        return response()->json(['success' => false, 'message' => 'Record already exists.']);
    }

    $confirmation = new Funeral_folder();
    $confirmation->year  = $request->year;
    $confirmation->month = $request->month;
    $confirmation->save();

    return response()->json(['success' => true, 'message' => 'Year added successfully!']);
});
Auth::routes();



<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CaseStudyController;
use App\Http\Controllers\CounselingTypeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ServiceHomeController;
use App\Http\Controllers\CounselorAssignmentController;
use App\Http\Controllers\SpecializationsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\TalentController;
use App\Models\Specializations;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register.show');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('login', [LoginController::class, 'login'])->middleware('guest');
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// home dkk
Route::get('/', function () {
    return view('home.index');
})->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/about/{user}', [AboutController::class, 'show'])->name('about.show');
Route::get('/case-studies', [CaseStudyController::class, 'index'])->name('case-studies');
Route::get('/case-studies/{id}', [CaseStudyController::class, 'show'])->name('case-studies.show');
Route::get('/services', [ServiceHomeController::class, 'index'])->name('services');
Route::get('/services/{slug}', [ServiceHomeController::class, 'show'])->name('services.show');

// Route::resource('/users', UserController::class);
Route::group(['middleware' => ['auth']], function () {
    /**
     * dashboard
     */
    Route::group(['middleware' => 'role:admin|super admin'], function () {
        Route::get('/dashboard/admin', [DashboardController::class, 'adminDashboard'])->name('dashboard.adminDashboard');
        Route::get('/dashboard/admin/chart-data', [DashboardController::class, 'adminChartDashboard'])->name('dashboard.adminChartDashboard');
    });
    Route::group(['middleware' => 'role:mahasiswa'], function () {
        Route::get('/dashboard/user', [DashboardController::class, 'userDashboard'])->name('dashboard.userDashboard');
        Route::get('/dashboard/user/chart-data', [DashboardController::class, 'userChartDashboard'])->name('dashboard.userChartDashboard');
    });
    Route::group(['middleware' => 'role:konselor'], function () {
        Route::get('/dashboard/counselor', [DashboardController::class, 'counselorDashboard'])->name('dashboard.counselorDashboard');
        Route::get('/dashboard/counselor/chart-data', [DashboardController::class, 'counselorChartDashboard'])->name('dashboard.counselorChartDashboard');
    });

    /**
     * profile
     */
    Route::middleware(['middleware' => 'role:super admin|admin|mahasiswa|konselor'])->group(function () {
        Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/account', [UserProfileController::class, 'updateAccount'])->name('profile.update.account');
        Route::put('/profile/counselor', [UserProfileController::class, 'updateCounselorDetails'])->name('counselor.profile.update');
    });

    /**
     * Specialization
     */
    Route::resource('specialization', SpecializationsController::class);

    /**
     * Counseling Type
     */
    Route::resource('counselingType', CounselingTypeController::class);

    /**
     * Assignment
     */
    Route::resource('assignment', CounselorAssignmentController::class)
        ->parameters(['assignment' => 'user']);

    /**
     * users
     */
    Route::group(['middleware' => ['role:admin|super admin']], function () {
        Route::resource('/users', UserController::class);
    });

    /**
     * roles
     */
    Route::group(['middleware' => ['role:admin|super admin']], function () {
        Route::resource('/roles', RoleController::class);
    });

    /**
     * appointment
     */
    Route::group(['middleware' => ['role:mahasiswa']], function () {
        Route::get('/appointments/select-type', [AppointmentController::class, 'selectType'])->name('appointments.select-type');
        Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
        Route::get('/appointments/create/{counselingType}', [AppointmentController::class, 'create'])->name('appointments.create');
        Route::get('/appointments/riwayat/mahasiswa', [AppointmentController::class, 'riwayatMahasiswa'])->name('appointments.riwayatMahasiswa');
        //
        Route::get('/appointments/{meeting}/refleksi-diri', [AppointmentController::class, 'refleksiDiri'])->name('appointments.refleksiDiri');
        Route::post('/appointments/{meeting}/refleksi-diri', [AppointmentController::class, 'storeRefleksiDiri'])->name('appointments.storeRefleksiDiri');
        Route::get('/appointments/{meeting}/refleksi-result', [AppointmentController::class, 'refleksiResult'])->name('appointments.refleksiResult');
        Route::get('/appointments/pasien/pending', [AppointmentController::class, 'pasien'])->name('appointments.pasien');
        Route::get('/appointments/approved/pasien', [AppointmentController::class, 'approvedPasien'])->name('appointments.approvedPasien');
        Route::get('/appointments/completed/pasien', [AppointmentController::class, 'completedPasien'])->name('appointments.completedPasien');
    });
    Route::group(['middleware' => ['role:konselor|admin']], function () {
        Route::get('/appointments/counselor', [AppointmentController::class, 'counselor'])->name('appointments.counselor');
        Route::get('/appointments/riwayat/counselor', [AppointmentController::class, 'riwayatCounselor'])->name('appointments.riwayatCounselor');
        Route::get('/appointments/approved/counselor', [AppointmentController::class, 'approvedCounselor'])->name('appointments.approvedCounselor');
        Route::patch('/appointments/{meeting}', [AppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');
        Route::get('/appointment/{meeting}/show', [AppointmentController::class, 'showAppointment'])->name('appointments.showAppointment');
    });
    Route::group(['middleware' => ['role:admin|super admin']], function () {
        Route::get('/appointments/riwayat', [AppointmentController::class, 'riwayat'])->name('appointments.riwayat');
    });

    /**
     * summary
     */
    Route::group(['middleware' => ['role:konselor|admin']], function () {
        Route::get('/appointments/{meeting}/summary/create', [SummaryController::class, 'create'])->name('summary.create');
        Route::post('/appointments/{meeting}/summary', [SummaryController::class, 'store'])->name('summary.store');
        Route::get('/appointments/{meeting}/edit', [SummaryController::class, 'edit'])->name('summary.edit');
        Route::patch('/appointments/{meeting}/summary', [SummaryController::class, 'updateSummary'])->name('summary.updateSummary');
    });
    Route::group(['middleware' => ['role:mahasiswa|konselor|admin']], function () {
        Route::get('/appointments/{meeting}/summary', [SummaryController::class, 'show'])->name('summary.show');
    });

    /**
     * chatbot
     */
    Route::post('/chatbot/send', [ChatbotController::class, 'sendMessage'])->name('chatbot.send');

    /**
     * kuesioner
     */
    Route::group(['middleware' => ['role:mahasiswa|konselor']], function () {
        Route::get('/listKuesioner', [QuestionnaireController::class, 'listKuesioner'])->name('questionnaire.listKuesioner');
        Route::get('/detail-questionnaire/{kuesionerId}', [QuestionnaireController::class, 'detail'])->name('questionnaire.detail');
    });
    Route::group(['middleware' => ['role:mahasiswa|konselor']], function () {
        Route::get('/questionnaire', [QuestionnaireController::class, 'index'])->name('questionnaire.index');
        Route::get('/list-questionnaire', [QuestionnaireController::class, 'list'])->name('questionnaire.list');
        Route::get('/questionnaire-refleksi/{kuesionerId}', [QuestionnaireController::class, 'refleksi'])->name('questionnaire.refleksi');
        Route::post('/questionnaire-refleksi/{kuesionerId}', [QuestionnaireController::class, 'storeRefleksi'])->name('questionnaire.storeRefleksi');
        Route::post('/questionnaire', [QuestionnaireController::class, 'submit'])->name('questionnaire.submit');
    });

    // bakat 
    // bakat 
    Route::prefix('talent')->name('talent.')->group(function () {
        
        Route::get('/search-stage', [TalentController::class, 'searchStage'])->name('search');
        Route::post('/save', [TalentController::class, 'saveStage'])->name('save');
        Route::get('/hasil', [TalentController::class, 'hasil'])->name('hasil');
        Route::post('/export-pdf/{id}', [TalentController::class, 'exportPdf'])->name('cetak_pdf_hasil');
        Route::get('/refleksi', [TalentController::class, 'refleksi'])->name('refleksi');
        // Pastikan ini menggunakan POST, BUKAN GET
        Route::post('/hitung-refleksi', [App\Http\Controllers\TalentController::class, 'hitungRefleksi']);
        Route::get('/hasil-refleksi', [\App\Http\Controllers\TalentController::class, 'hasilRefleksi'])->name('refleksi.hasil');

        // --- RUTE DEVELOPMENT STAGE (APTITUDE) ---
        // Alamat URL: /talent/development-stage
        // Nama Route: talent.development
        Route::get('/development-stage', [TalentController::class, 'aptitudeStage'])->name('development');

        // Alamat URL: /talent/development-stage/save
        // Nama Route: talent.pengembangan.save
        Route::post('/development-stage/save', [TalentController::class, 'saveAptitudePage'])->name('pengembangan.save');

        // Alamat URL: /talent/development-stage/hasil
        // Nama Route: talent.pengembangan.hasil
        Route::get('/development-stage/hasil', [TalentController::class, 'hasilAptitude'])->name('pengembangan.hasil');
        
        Route::post('/export-pdf-aptitude/{id}', [App\Http\Controllers\TalentController::class, 'exportPdfAptitude']);
        // --- RUTE PORTOFOLIO ---
        Route::get('/portofolio', [TalentController::class, 'portofolioStage'])->name('portofolio');
        Route::post('/portofolio/save', [TalentController::class, 'savePortofolioPage'])->name('portofolio.save');
        Route::get('/portofolio/hasil', [TalentController::class, 'hasilPortofolio'])->name('portofolio.hasil');     
        Route::get('/history', [\App\Http\Controllers\TalentController::class, 'history'])->name('history');
        Route::get('/history/penelusuran', [\App\Http\Controllers\TalentController::class, 'historyPenelusuran'])->name('history.penelusuran');
        Route::get('/history/refleksi', [\App\Http\Controllers\TalentController::class, 'historyRefleksi'])->name('history.refleksi');
        Route::get('/history/pengembangan', [\App\Http\Controllers\TalentController::class, 'historyPengembangan'])->name('history.pengembangan');
        Route::get('/history/portofolio', [\App\Http\Controllers\TalentController::class, 'historyPortofolio'])->name('history.portofolio');
    });
    
    
    /**
     * Notification
     */
    Route::get('/notifications/{notification}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
});

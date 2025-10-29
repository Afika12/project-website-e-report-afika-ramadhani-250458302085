<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DataUserController;

Route::get('/', function () {
    return view('welcome');
});

// Route Biasa
Route::get('/santri', function () { // kurung{} fungsinya untuk logikanya dri function
    return ('Halo Namaku Afika');
});

// Route Parameter
Route::get('/halo/{nama}', function ($nama) {
    return 'Selamat Datang' . $nama;
});

// Route Name
Route::get('/buah', function () {
    return 'Mangga, Jeruk, Apel';
})->name('fruit');

// contoh route dengan view
// jika file HTML ada didalam folder maka panggil dulu nama foldernya
// contoh : namaFolder.namaFile
// tetapi jika file HTML nya langsung menyentuh folder view maka langsung saja panggil nama filenya
Route::get('/landing-page', function () {
    return view('landingpage');
});

// Membuat route Admin
route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {  // nyesuaiin sama alias nya 'admin' (ex)
    route::get('/dashboardAdmin', function () { // "/" itu untuk URL 'slice'
        return view('admin.dashboardAdmin'); // knp view karena dashboardAdmin nya itu di bungkus sama folder Admin
    });
    route::controller(DataUserController::class)->group(function () {
        route::get('/data-user', 'index')->name('index.data-user');
        // 
        route::get('/form-data-user', 'formDataUser')->name('form.data-user');
        //  ini route untuk proses create / tambah data user
        route::post('/create-data-user','createDataUser')->name('create.dataUser');
        // ini route untuk menampilkan data edit
        route::get('edit-data-user/{id}', 'editDataUser')->name('edit.dataUser');
        // ini route untuk proses update data user
        route::put('update-data-user/{id}', 'updateDataUser')->name('update.dataUser');
        route::delete('delete-data-user/{id}', 'deleteDataUser')->name('delete.dataUser');
    });
});

// untuk user
route::prefix('user')->middleware(['auth', 'user'])->group(function () {
    route::get('/dashboardUser', function () {
        return view('user.dashboardUser');
    });
});





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

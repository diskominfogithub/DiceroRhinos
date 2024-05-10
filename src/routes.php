Route::controller(AuthController::class)->group(function () {
    // login
    Route::get("/login", "viewLogin")->name("view_login");
    Route::post("/login", "submitLogin")->name("submit_login");
    // login

    // logout user
    Route::post("/logout", "logout")->name("logout");
    // logout user

    // tambah opd
    Route::get("/opd/tambah", "viewBuatOpd")->name("admin.view_buatopd");
    Route::post("/opd/tambah", "submitBuatOpd")->name("admin.submit_buatopd");
    // tambah opd

    // register user untuk opd
    Route::get("/register/{id_opd?}", "viewRegister")->name("admin.register");
    Route::post("/register", "submitRegister")->name("admin.submit_register");
    // register user untuk opd

    // list admin
    Route::get('/list', 'list_admin')->name('list.admin');
    // list admin

    //change password
    Route::get("/ganti_password", "viewGantiPassword")
        ->name("opd.ganti_password");
    Route::post("/ganti_password", "submitGantiPassword")
        ->name("opd.submit_ganti_password");


    // list opd
    Route::get(
        "/list/opd/json",
        "viewListOpdJson"
    )->name("admin.list.opd.json");
    Route::get(
        "/list/opd",
        "viewListOpd"
    )->name("admin.list_opd");
    // list opd
});

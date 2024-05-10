# DiceroRhinos Authentication

### Cara pakai

1. Lakukan instalasi package
   ```
   composer require diskominfogithub/dicerorhinos-auth
   ```
2. Lakukan instalasi package sweet-aler
   ```
   composer require realrashid/sweet-alert
   ```
3. setelah paket terinstall di project, publish file `config` dan `migrations`
4. tambahkan ```Diskominfo\DiceroServiceProvider::class``` di `config/app.php`

```
[
    "providers" => [
        ...,
        Diskominfo\DiceroServiceProvider::class
    ]
]
```

4. publish all `php artisan vendor:publish --tag=all`
8. pada file `DatabaseSeeder.php` ubah

```
    public function run()
    {
        $this->call(DiceroSeeder::class);
    }
```

### Dicero

1. `Dicero::login($formParamUsername,$formParamPassword)`
   , setelah login maka `Dicero` akan me-set nilai session dengan key `user`

```
    [
        "user"=>[
            'username'=>"...",
            "role"=>"...",
            "opd"=>"..."
        ]
    ]
```

> return method dari `Dicero::getAuthenticatedUser()` sama seperti `array` di atas

2. `Dicero::logout()`, logout (membersihkan session)

3. `Dicero::newUser($newUser)`, parameter
   `$newUser` menerima tipe `array associative`

```
[
    "username"=>$isiUsername,
    "password"=>$isiPassword,
    "email"=>$isiEmail,
    "role_id"=>$isiRole_id,
    "opd_id"=>$isiOpd_id
]
```

4. `Dicero::newRole($reqNamaRole)`, `$reqNamaRole` nama role baru yang akan dibuat

5. `Dicero::newOpd($reqNamaOpd)`,
   `$reqNamaOpd` nama opd baru yang akan dibuat

6. `Dicero::getAuthenticatedUser()`, melihat user yang sedang terotentikasi

7. `Dicero::getAllUser()`, melihat semua User
8. catatan untuk middleware pada routes
```
->middleware('admin.login') untuk middleware superadmin
->middleware('opd.login') untuk middleware opd
->middleware('auth.login') untuk middleware semua (all)
```
### Dicero's helpers

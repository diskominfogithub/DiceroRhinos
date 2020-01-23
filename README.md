# DiceroRhinos Authentication




### Cara pakai

1. composer require diskominfogithub/dicerorhinos-auth
2. setelah paket terinstall di project, publish file `config` dan `migrations`
3. tambahkan `Diskominfo\DiceroServiceProvider::class` di `config/app.php`

```
[
    "providers" => [
        ...,
        Diskominfo\DiceroServiceProvider::class
    ]
]
```

4. publish file config `php artisan vendor:publish --tag=config`
5. publish file migrations `php artisan vendor:publish --tag=migrations`
6. publish file seeds `php artisan vendor:publish --tag=seeds`
7. publish file helpers `php artisan vendor:publish --tag=helpers`
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

### Dicero's helpers


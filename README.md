# DiceroRhinos Authentication

## Dicero

methods

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
<?php

return [
    'navigation' => [
        'user' => 'Użytkownicy',
        'company' => 'Firmy',
    ],
    'breadcrumbs' => [
        'dashboard' => 'Pulpit nawigacyjny',
        'user' => 'Użytkownicy',
        'company' => 'Firmy',
        'create' => 'Utwórz',
        'edit' => 'Edytuj',
        'view' => 'Podgląd',
    ],
    'table' => [
        'columns' => [
            'id' => 'ID',
            'name' => 'Nazwa',
            'address' => 'Adres',
            'email' => 'Email',
            'phone' => 'Telefon',
            'created_at' => 'Utworzono',
        ],
        'actions' => [
            'edit' => 'Edytuj',
            'delete' => 'Usuń',
        ],
    ],
    'form' => [
        'fields' => [
            'name' => 'Nazwa',
            'address' => 'Adres',
            'email' => 'Email',
            'phone' => 'Telefon',
            'password' => 'Hasło',
        ],
        'actions' => [
            'save' => 'Zapisz',
            'cancel' => 'Anuluj',
        ],
    ],
];

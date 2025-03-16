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
            'date_of_birth' => 'Data urodzenia',
            'personal_number' => 'PESEL',
        ],
        'actions' => [
            'save' => 'Zapisz',
            'cancel' => 'Anuluj',
        ],
    ],
    'company' => [
        'name' => 'Nazwa Firmy',
        'owner' => 'Właściciel',
        'description' => 'Opis Działalności',
        'tax_number' => 'NIP',
    ]
];

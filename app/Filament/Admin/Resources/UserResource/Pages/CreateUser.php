<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Filament\Admin\Resources\UserResource;
use App\Models\UserDetails;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterSave(): void
    {
        $user = $this->record;
        $userDetails = $user->userDetails;

        if (!$userDetails) {
            $userDetails = new UserDetails();
            $userDetails->user_id = $user->id;
        }

        $userDetails->birthday = $this->data['user_details']['birthday'] ?? null;
        $userDetails->personal_number = $this->data['user_details']['personal_number'] ?? null;
        $userDetails->phone = $this->data['user_details']['phone'] ?? null;
        $userDetails->has_active_subscription = $this->data['user_details']['has_active_subscription'] ?? false;

        $userDetails->save();
    }
}

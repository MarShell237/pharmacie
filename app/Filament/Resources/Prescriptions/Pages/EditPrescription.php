<?php

namespace App\Filament\Resources\Prescriptions\Pages;

use App\Filament\Resources\Prescriptions\PrescriptionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;
use App\Models\Prescription;
use App\Enums\UserRole;
use Filament\Notifications\Notification;
use App\Models\User;


class EditPrescription extends EditRecord
{
    protected static string $resource = PrescriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // DeleteAction::make(),
            Action::make("Valider ordonance")
                ->label("Valider l'ordonance")
                ->visible(fn(Prescription $record) => !filled($record->validated_by_id))
                ->color('success')
                ->requiresConfirmation()
                ->action(function(Prescription $prescription){
                    $prescription->update([
                        'validated_by_id' => auth()->user()->id,
                        'validated_at' => now()
                    ]);
                    $admins = User::role(UserRole::ADMIN->value)->get();
                    foreach($admins as $admin){
                        Notification::make()
                            ->title('Ordonnace valider')
                            ->body("La commande n°{$prescription->id} a été marquée comme validee. Vous pouvez consulter les détails dès maintenant.")
                            ->success()
                            ->actions([
                                Action::make('view')
                                    ->label('Voir la commande')
                                    ->url(url("admin/prescriptions/{$prescription->id}/edit"))
                                    ->button() 
                            ])
                            ->sendToDatabase([$admin]);                        
                    }
                }),
        ];
    }
    
    protected function afterSave(){
        $prescription = $this->record;
        if(filled($prescription->rejected_reason)){
            $user = $prescription->user;
            // $admin = User::role(UserRole::ADMIN->value, 'api')->first();

            $prescription->update([
                'validated_by_id' => auth()->user()->id,
                'rejected_at' => now()
            ]);
            $admins = User::role(UserRole::ADMIN->value)->get();
            foreach($admins as $admin){
                Notification::make()
                    ->title('Ordonnace rejeter')
                    ->body("L'ordonnance n°{$prescription->id} a été marquée comme rejeter. Vous pouvez consulter les détails dès maintenant.")
                    ->success()
                    ->actions([
                        Action::make('view')
                            ->label('Voir la commande')
                            ->url(url("admin/prescriptions/{$prescription->id}/edit"))
                            ->button() 
                    ])
                    ->sendToDatabase([$admin]);                        
            }
        }
    }
}

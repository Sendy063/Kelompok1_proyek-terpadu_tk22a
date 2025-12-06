<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenggunaResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;

class PenggunaResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Kelola Pengguna';
    protected static ?string $pluralModelLabel = 'Pengguna';
    protected static ?string $slug = 'kelola-pengguna';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')->label('Nama Lengkap')->required(),
            TextInput::make('email')->label('Email')->email()->required(),
            TextInput::make('total')->label('Total')->numeric()->prefix('Rp'),
            Select::make('is_admin')->label('Status')->options([
                '1' => 'Admin',
                '0' => 'User',
            ])->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')->label('ID Pengguna')->sortable(),
            TextColumn::make('name')->label('Nama Lengkap')->searchable(),
            TextColumn::make('email')->label('Email')->searchable(),
            TextColumn::make('total')
                ->label('Total')
                ->formatStateUsing(fn ($state) => $state ? 'Rp ' . number_format($state, 0, ',', '.') : '-'),
            BadgeColumn::make('is_admin')->label('Status')->colors([
                'success' => '1',
                'gray' => '0',
            ])->formatStateUsing(fn ($state) => $state == 1 ? 'Admin' : 'User'),
        ])
        ->filters([
            SelectFilter::make('is_admin')
                ->label('Filter Status')
                ->options([
                    '1' => 'Admin',
                    '0' => 'User',
                ]),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ])
        ->defaultSort('id', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenggunas::route('/'),
            'create' => Pages\CreatePengguna::route('/create'),
            'edit' => Pages\EditPengguna::route('/{record}/edit'),
        ];
    }
}
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukTapiokaResource\Pages;
use App\Models\ProdukTapioka;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Support\Facades\Storage;

class ProdukTapiokaResource extends Resource
{
    protected static ?string $model = ProdukTapioka::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Kelola Produk';
    protected static ?string $pluralModelLabel = 'Produk Aci';
    protected static ?string $slug = 'produk-aci';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nama')->required(),
            Textarea::make('deskripsi')->rows(3),
            TextInput::make('harga')->numeric()->required(),
            Select::make('kategori')
                ->options([
                    'jajanan' => 'Jajanan',
                    'pedas' => 'Pedas',
                    'klasik' => 'Klasik',
                ]),
            FileUpload::make('gambar')->image()->directory('tapioka'),
            Toggle::make('promo')->label('Promo?'),
        ]);
    }


public static function table(Table $table): Table
{
    return $table->columns([
        ImageColumn::make('gambar')
    ->circular()
    ->height(50)
    ->url(fn($record) => Storage::url($record->gambar)),
    
        TextColumn::make('nama')->searchable(),
        TextColumn::make('kategori')->badge(),
        TextColumn::make('harga')->money('IDR'),
        IconColumn::make('promo')->boolean()->label('Promo'),
    ])
    ->filters([
        Tables\Filters\SelectFilter::make('kategori')
            ->options([
                'jajanan' => 'Jajanan',
                'pedas' => 'Pedas',
                'klasik' => 'Klasik',
            ]),
    ])
    ->actions([
        Tables\Actions\EditAction::make(),
    ])
    ->bulkActions([
        Tables\Actions\BulkActionGroup::make([
            Tables\Actions\DeleteBulkAction::make(),
        ]),
    ]);
}

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProdukTapiokas::route('/'),
            'create' => Pages\CreateProdukTapioka::route('/create'),
            'edit' => Pages\EditProdukTapioka::route('/{record}/edit'),
        ];
    }
}

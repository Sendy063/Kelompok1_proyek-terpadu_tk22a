<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukTapiokaResource\Pages;
use App\Models\ProdukTapioka;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class ProdukTapiokaResource extends Resource
{
    protected static ?string $model = ProdukTapioka::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Kelola Produk';
    protected static ?string $pluralModelLabel = 'Produk Aci';
    protected static ?string $slug = 'produk-aci';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nama')
                ->label('Nama Produk')
                ->required(),

            Textarea::make('deskripsi')
                ->label('Deskripsi')
                ->rows(3),

            TextInput::make('harga')
                ->label('Harga')
                ->numeric()
                ->required(),

            Select::make('kategori')
                ->label('Kategori')
                ->options([
                    'jajanan' => 'Jajanan',
                    'pedas'   => 'Pedas',
                    'klasik'  => 'Klasik',
                ]),

            FileUpload::make('gambar')
                ->label('Gambar Produk')
                ->image()
                ->imageEditor(false) // biar loading satset
                ->previewable(true)  // preview langsung muncul
                ->enableOpen()       // klik untuk buka gambar
                ->enableDownload()   // bisa download
                ->directory('tapioka')
                ->disk('public')
                ->visibility('public')
                ->preserveFilenames()
                ->maxSize(2048),

            Toggle::make('promo')
                ->label('Promo?'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('gambar')
                ->label('Gambar')
                ->disk('public')
                ->height(50)
                ->circular()
                ->extraImgAttributes(['loading' => 'lazy']), // satset saat scroll

            TextColumn::make('nama')
                ->label('Nama')
                ->searchable(),

            TextColumn::make('kategori')
                ->label('Kategori')
                ->badge(),

            TextColumn::make('harga')
                ->label('Harga')
                ->money('IDR'),

            IconColumn::make('promo')
                ->label('Promo')
                ->boolean(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('kategori')
                ->label('Filter Kategori')
                ->options([
                    'jajanan' => 'Jajanan',
                    'pedas'   => 'Pedas',
                    'klasik'  => 'Klasik',
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
            'index'  => Pages\ListProdukTapiokas::route('/'),
            'create' => Pages\CreateProdukTapioka::route('/create'),
            'edit'   => Pages\EditProdukTapioka::route('/{record}/edit'),
        ];
    }
}
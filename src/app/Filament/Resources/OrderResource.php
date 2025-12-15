<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationLabel = 'Kelola Pesanan';
    protected static ?string $pluralModelLabel = 'Pesanan';
    protected static ?string $slug = 'kelola-pesanan';
    protected static ?int $navigationSort = 3;
    // protected static ?string $navigationGroup = 'Kelola Sistem';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('user_id')
                ->relationship('user', 'name')
                ->label('Pengguna')
                ->required()
                ->searchable()
                ->preload(),
            TextInput::make('customer')->label('Pelanggan')->required(),
            TextInput::make('email')->label('Email')->email()->required(),
            TextInput::make('telepon')->label('Telepon')->required(),
            DatePicker::make('order_date')->label('Tanggal')->required(),
            TextInput::make('total')->label('Total')->numeric()->required(),
            Forms\Components\Textarea::make('alamat')->label('Alamat')->rows(3)->required(),
            // Select::make('payment_method')->label('Metode Pembayaran')->options([
            //     'cod' => 'COD (Bayar di Tempat)',
            //     'transfer_bank' => 'Transfer Bank',
            //     'e_wallet' => 'E-Wallet',
            //     'xendit' => 'Xendit (Berbagai Metode)',
            // ])->required(),
            // Forms\Components\KeyValue::make('items')->label('Item Pesanan')->keyLabel('Produk ID')->valueLabel('Detail Item'),
            Select::make('status')->label('Status')->options([
                'baru' => 'Baru',
                'diproses' => 'Diproses',
                'dikirim' => 'Dikirim',
                'selesai' => 'Selesai',
            ])->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')->label('ID Pesanan')->sortable(),
            TextColumn::make('user.name')->label('Pengguna')->sortable()->searchable(),
            TextColumn::make('customer')->label('Pelanggan')->searchable(),
            TextColumn::make('email')->label('Email')->searchable(),
            TextColumn::make('telepon')->label('Telepon')->searchable(),
            TextColumn::make('order_date')
                ->label('Tanggal')
                ->date('d/m/Y')
                ->sortable(),
            TextColumn::make('total')
                ->label('Total')
                ->formatStateUsing(fn ($state) => $state ? 'Rp ' . number_format($state, 0, ',', '.') : '-'),
            TextColumn::make('payment_method')->label('Metode Pembayaran'),
            BadgeColumn::make('status')->label('Status')->colors([
                'danger' => 'baru',
                'warning' => 'diproses',
                'info' => 'dikirim',
                'success' => 'selesai',
                'xendit' => 'info', // Menambahkan warna untuk Xendit di tabel
            ]),
        ])
        
        ->filters([
            Tables\Filters\SelectFilter::make('status')
                ->label('Filter Status')
                ->options([
                    'baru' => 'Baru',
                    'diproses' => 'Diproses',
                    'dikirim' => 'Dikirim',
                    'selesai' => 'Selesai',
                ]),
        ])
        ->defaultSort('created_at', 'desc');
        
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
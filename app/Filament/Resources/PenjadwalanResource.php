<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenjadwalanResource\Pages;
use App\Filament\Resources\PenjadwalanResource\RelationManagers;
use App\Models\Penjadwalan;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenjadwalanResource extends Resource
{
    protected static ?string $model = Penjadwalan::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Penjadwalan')
                        ->tabs([
                            Tabs\Tab::make('Data Penjadwalan')
                                 ->badgeColor('success')
                                ->schema([
                                    Forms\Components\DatePicker::make('tanggal') 
                                        ->label('Tanggal') 
                                        ->required(),
                                    Forms\Components\TimePicker::make('waktu') ->label('Waktu') ->required(), 
                                    Forms\Components\TextInput::make('no_order') ->label('Number Order'), 
                                    Forms\Components\Select::make('order_type') 
                                    ->label('Tipe Order') 
                                    ->options([ 'kerjasama' => 'Kerjasama', 'walkin' => 'Walk-in', 'online' => 'Online', 'reserve' => 'Reserve', ]) 
                                    ->required(), 
                                    Forms\Components\TextInput::make('nama_pelanggan') 
                                        ->label('Nama Customer') ->required(), 
                                    Forms\Components\TextInput::make('no_hp') 
                                        ->label('Hp Customer') ->tel() ->required(), 
                                    Forms\Components\Select::make('kategori_id') ->label('Kategori') 
                                        ->relationship('kategori', 'name'), 
                                    Forms\Components\Select::make('subkategori_id')
                                         ->label('Subkategori') 
                                         ->relationship('subkategori', 'name') 
                                         ->required(), 
                                    Forms\Components\Select::make('produk_id') 
                                        ->label('Produk') ->relationship('produk', 'name') 
                                        ->required(), 
                                    Forms\Components\TextInput::make('nama_paket') 
                                        ->label('Nama Paket'),
                                    Forms\Components\richEditor::make('keterangan') 
                                        ->label('Keterangan'), 
                                    Forms\Components\Select::make('status') 
                                        ->label('Status') 
                                        ->options([ 'pending' => 'Pending', 'done' => 'Done', 'cancel' => 'Cancel', 'confirmed' => 'Confirmed', ]) ->default('pending') ->required(), 
                                    Forms\Components\Select::make('user_id') 
                                        ->relationship('user', 'name')
                                        ->reactive()
                                         ->required(),

                                ]),
                            Tabs\Tab::make('Data Pegawai')
                                ->schema([
                                    Forms\Components\Repeater::make('pegawai')
                                        ->schema([
                                            Forms\Components\TextInput::make('name')
                                                ->required()
                                                ->maxLength(255),
                                            Forms\Components\TextInput::make('jabatan')
                                                ->required()
                                                ->maxLength(255),
                                        ])
                                        ->columns(3)
                                ]),
                            Tabs\Tab::make('Tab 3')
                                ->schema([
                                    // ...
                                ]),
                        ]) ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanggal'),
                Tables\Columns\TextColumn::make('waktu'),
                Tables\Columns\TextColumn::make('no_order'),
                Tables\Columns\TextColumn::make('order_type'),
                Tables\Columns\TextColumn::make('nama_pelanggan'),
                Tables\Columns\TextColumn::make('no_hp'),
                Tables\Columns\TextColumn::make('kategori.name'),
                Tables\Columns\TextColumn::make('subkategori.name'),
                Tables\Columns\TextColumn::make('produk.name'),
                Tables\Columns\TextColumn::make('nama_paket'),
                Tables\Columns\TextColumn::make('keterangan'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('user.name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenjadwalans::route('/'),
            'create' => Pages\CreatePenjadwalan::route('/create'),
            'edit' => Pages\EditPenjadwalan::route('/{record}/edit'),
        ];
    }
}

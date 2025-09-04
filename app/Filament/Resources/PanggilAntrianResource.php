<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PanggilAntrianResource\Pages;
use App\Filament\Resources\PanggilAntrianResource\RelationManagers\AntrianStoreRelationManager;
use App\Models\Antrian;
use App\Models\Antrianstore;
use App\Models\Layanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class PanggilAntrianResource extends Resource
{
    protected static ?string $model = Antrian::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static ?string $navigationLabel = 'Panggil Antrian';
    protected static ?string $navigationGroup = 'Antrian Management';
    protected static ?string $modelLabel = 'Panggil Antrian';
    protected static ?string $activeNavigationIcon = 'heroicon-s-megaphone';
    protected static ?string $resourceDescription = 'Manajemen pemanggilan antrian dan monitoring layanan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Antrian')
                    ->description('Detail antrian yang akan dipanggil')
                    ->schema([
                        Forms\Components\Select::make('layanan_id')
                            ->label('Layanan')
                            ->options(Layanan::all()->pluck('nama_layanan', 'id'))
                            ->required()
                            ->native(false)
                            ->searchable()
                            ->columnSpan(2),

                        Forms\Components\TextInput::make('kode')
                            ->label('Kode Antrian')
                            ->required()
                            ->maxLength(10)
                            ->default(fn() => strtoupper(Str::random(4)))
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('kuota')
                            ->label('Kuota')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(100)
                            ->default(1)
                            ->columnSpan(1),
                    ])->columns(2),

                Forms\Components\Section::make('Detail Tambahan')
                    ->schema([
                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Catatan')
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('index')
                    ->label('No.')
                    ->rowIndex()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('layanan.nama_layanan')
                    ->label('Layanan')
                    ->searchable()
                    ->sortable()
                    ->color(fn($record) => $record->layanan->warna ?? 'primary'),

                Tables\Columns\TextColumn::make('kode')
                    ->label('Kode')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn($state) => strtoupper($state)),

                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(30)
                    ->tooltip(fn($record) => $record->deskripsi),

                Tables\Columns\BadgeColumn::make('jumlah_antrian')
                    ->label('Jumlah Antrian')
                    ->getStateUsing(fn($record) => AntrianStore::where('antrian_id', $record->id)->count())
                    ->color(fn($state) => $state > 5 ? 'success' : 'warning'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Update')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('layanan')
                    ->relationship('layanan', 'nama_layanan')
                    ->searchable()
                    ->preload()
                    ->label('Filter Berdasarkan Layanan'),

                Tables\Filters\Filter::make('kuota_penuh')
                    ->label('Kuota Terpenuhi')
                    ->query(fn(Builder $query): Builder => $query->where('kuota', '<=', 0))
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->label('Pilih Antrian')
                        ->button()
                        ->color('danger')
                        ->icon('heroicon-o-eye'),
                ])->dropdown(false),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih'),

                    Tables\Actions\BulkAction::make('panggil_bulk')
                        ->label('Panggil Terpilih')
                        ->icon('heroicon-o-megaphone')
                        ->action(function ($records) {
                            $records->each->update(['status' => 'dipanggil']);
                        })
                        ->requiresConfirmation(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Buat Antrian Baru'),
            ])
            ->deferLoading()
            ->persistFiltersInSession();
    }

    public static function getRelations(): array
    {
        return [
            AntrianStoreRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPanggilAntrians::route('/'),
            'view' => Pages\ViewPanggil::route('/{record}'),
        ];
    }

    public static function getPluralModelLabel(): string
    {
        return __('Daftar Antrian');
    }
}

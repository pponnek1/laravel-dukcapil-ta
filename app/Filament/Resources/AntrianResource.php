<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AntrianResource\Pages;
use App\Models\Antrian;
use App\Models\Layanan;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Tables\Table;

class AntrianResource extends Resource
{
    protected static ?string $model = Antrian::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Antrian';

    protected static ?string $navigationBadgeTooltip = 'Antrian Aktif';

    protected static ?string $activeNavigationIcon = 'heroicon-o-document-text';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Select untuk memilih layanan
                Forms\Components\Select::make('layanan_id')
                    ->label('Nama Layanan')
                    ->relationship('layanan', 'nama_layanan')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $layanan = Layanan::find($state);

                        if ($layanan) {
                            $set('nama_layanan', $layanan->nama_layanan);
                            $set('kode', $layanan->kode);

                            // Generate slug dan pastikan tidak ada duplikat
                            $slug = Str::slug($layanan->nama_layanan);
                            $originalSlug = $slug;
                            $i = 1;

                            // Cek apakah slug sudah ada, jika ada tambahkan angka
                            while (Antrian::where('slug', $slug)->exists()) {
                                $slug = $originalSlug . '-' . $i;
                                $i++;
                            }

                            $set('slug', $slug);
                        }
                    }),


                Forms\Components\TextInput::make('nama_layanan')
                    ->label('Nama Layanan')
                    ->disabled()
                    ->required()
                    ->dehydrated(fn($state) => filled($state)),

                Forms\Components\TextInput::make('kode')
                    ->label('Kode')
                    ->disabled()
                    ->required()
                    ->dehydrated(fn($state) => filled($state)),

                // Hidden Slug
                Forms\Components\Hidden::make('slug')
                    ->required(),

                // Textarea untuk deskripsi layanan
                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi Layanan')
                    ->required(),

                // Textarea untuk persyaratan
                Forms\Components\Textarea::make('persyaratan')
                    ->label('Persyaratan')
                    ->required(),

                // Input untuk kuota
                Forms\Components\TextInput::make('kuota')
                    ->label('Kuota')
                    ->numeric()
                    ->required(),

                // Hidden field untuk user_id
                Forms\Components\Hidden::make('user_id')
                    ->default(fn() => auth()->id())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')->label('No. ')->rowIndex(),
                Tables\Columns\TextColumn::make('layanan.nama_layanan')->searchable(), // Menampilkan nama layanan
                Tables\Columns\TextColumn::make('kode')->searchable(),
                Tables\Columns\TextColumn::make('deskripsi')->limit(50),
                Tables\Columns\TextColumn::make('persyaratan')->limit(50)
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('kuota')->limit(50),
                Tables\Columns\TextColumn::make('slug')->limit(50),
                Tables\Columns\TextColumn::make('created_at')->date('j F Y')->label('Dibuat'),
            ])
            ->filters([
                // Anda bisa menambahkan filter di sini jika diperlukan
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

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        // Ambil data layanan berdasarkan layanan_id
        $layanan = Layanan::find($data['layanan_id']);

        if ($layanan) {
            // Set nama layanan dan kode berdasarkan layanan yang dipilih
            $data['nama_layanan'] = $layanan->nama_layanan;
            $data['kode'] = $layanan->kode;

            // Generate slug dari nama layanan
            $slug = Str::slug($layanan->nama_layanan);
            $originalSlug = $slug;
            $i = 1;

            // Cek apakah slug sudah ada, jika ada tambahkan angka
            while (Antrian::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $i;
                $i++;
            }

            // Set slug yang unik
            $data['slug'] = $slug;
        }

        // Set user_id berdasarkan user yang sedang login
        $data['user_id'] = auth()->id();

        return $data;
    }


    public static function getRelations(): array
    {
        return [
            // Hubungkan jika ada relasi lain
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAntrians::route('/'),
            'create' => Pages\CreateAntrian::route('/create'),
            'edit' => Pages\EditAntrian::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

        public static function getPluralModelLabel(): string
    {
        return __('Antrian Aktif');
    }

}


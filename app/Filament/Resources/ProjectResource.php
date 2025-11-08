<?php

namespace App\Filament\Resources;

use BackedEnum;
use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Facades\Storage;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static string|\BackedEnum|null $navigationIcon = 'lucide-rocket';

    protected static ?string $navigationLabel = 'Projects';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('title')
                ->required()
                ->maxLength(255),

            TextInput::make('subtitle')
                ->maxLength(255),

            TextInput::make('tools')
                ->helperText('Comma separated tools')
                ->maxLength(255),

            TextInput::make('link')
                ->url(),

            Textarea::make('description')
                ->rows(5),

            FileUpload::make('images')
                ->image()
                ->multiple()
                ->disk('public_project')
                ->enableReordering(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('images')
                    ->label('Image')
                    ->square()
                    ->disk('public_project')
                    ->getStateUsing(function ($record) {
                        if (!is_array($record->images) || count($record->images) === 0) {
                            return null;
                        }

                        $path = $record->images[0];

                        // Already a full URL
                        if (filter_var($path, FILTER_VALIDATE_URL)) {
                            return $path;
                        }

                        // If exists in public_project disk, return its URL
                        if (Storage::disk('public_project')->exists($path)) {
                            $base = request()?->getSchemeAndHttpHost() ?: env('APP_URL');
                            return rtrim($base, '/') . '/projects/' . ltrim($path, '/');
                        }

                        // Fallback to asset() (for files placed under public/)
                        return asset($path);
                    }),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('subtitle')
                    ->limit(30),

                TextColumn::make('tools')
                    ->limit(30),

                TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                // ... add filters if needed
            ])
            ->headerActions([
                // Show the create form as a modal (use the Actions package namespace)
                \Filament\Actions\CreateAction::make()->modal(),
            ])
            ->actions([
                // edit + delete on each row (edit as modal, disable autofocus)
                \Filament\Actions\EditAction::make()->modal()->modalAutofocus(false),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
        ];
    }
}

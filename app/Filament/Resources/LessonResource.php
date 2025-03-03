<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LessonResource\Pages;
use App\Filament\Resources\LessonResource\RelationManagers;
use App\Models\Lesson;
use App\Models\Vocabulary;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\TextInput::make('slug')
                    ->required(),
                Forms\Components\TextInput::make('short_description')
                    ->required(),
                Forms\Components\Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('objective')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('coding_lang'),
                Forms\Components\TextInput::make('sort')
                    ->required()
                    ->numeric(),
                Section::make('Vocabulary')->schema([
                    Repeater::make('vocabularies')
                    ->hiddenLabel()
                    ->addActionLabel('Add term')
                    ->relationship('lessonVocabulary')
                    ->live()
                    ->schema([
                        Split::make([
                            Select::make('vocabulary_id')
                                ->label('Term')
                                // If I remove this option the selected value is not added to the
                                // options list, son it shows the id instead of the term.
                                ->relationship('vocabulary', 'term')
                                ->preload()
                                ->searchable()
                                ->distinct()
                                ->required()
                                ->options(function (Get $get) {

                                    // Get the other vocabularies selected in the repeater
                                    $repeaterValues = $get('../../vocabularies');
                                    $idVocabularies = array_column($repeaterValues, 'vocabulary_id');

                                    $list = Vocabulary::query();

                                    $notNullItems = array_filter($idVocabularies, function ($value) {
                                        return isset($value);
                                    });

                                    if (count($notNullItems) > 0) {

                                        $list->whereNotIn('id', $notNullItems);
                                    }

                                    return $list->pluck('term', 'id')->toArray();
                                })
                                ->createOptionForm([
                                    TextInput::make('term')
                                        ->required(),
                                    Textarea::make('definition')
                                        ->required(),
                                ])
                                ->afterStateHydrated(function (callable $set, $state) {
                                    $vocabulary = Vocabulary::find($state);
                                    $set('vocabulary_definition', $vocabulary->definition ?? '');
                                })
                                ->afterStateUpdated(function (callable $set, $state) {
                                    $vocabulary = Vocabulary::find($state);
                                    $set('vocabulary_definition', $vocabulary->definition);
                                }),
                            Textarea::make('vocabulary_definition')
                                ->label('Definition')
                                ->readOnly()
                                ->dehydrated(false),
                        ]),
                    ])
                    ->defaultItems(1)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('short_description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('coding_lang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sort')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLessons::route('/'),
            'create' => Pages\CreateLesson::route('/create'),
            'edit' => Pages\EditLesson::route('/{record}/edit'),
        ];
    }
}

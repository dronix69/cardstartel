<?php

namespace App\Filament\Resources;

use App\Filament\Exports\InstructorExporter;
use App\Filament\Resources\InstructorResource\Pages;
use App\Filament\Resources\InstructorResource\RelationManagers;
use App\Models\Instructor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Filters\Filter;

class InstructorResource extends Resource
{
    protected static ?string $model = Instructor::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationGroup = 'School';

    protected static ?string $navigationLabel = 'Práticas';

    protected static ?int $navigationSort = 4;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('instructor')
                    ->required()
                    ->options([
                        'Rodrigo Taffo' => 'Rodrigo Taffo',
                        'Daniel Ferrada' => 'Daniel Ferrada',
                    ]),
                Forms\Components\TextInput::make('alumno')
                    ->required()
                    ->maxLength(255)
                    ->autocomplete(false),
                Forms\Components\ColorPicker::make('color')
                    ->required(),
                Forms\Components\DateTimePicker::make('start_at')
                    ->label('Fecha Hora Inicio')
                    ->date()
                    ->seconds(false)
                    ->required(),
                Forms\Components\DateTimePicker::make('end_at')
                    ->label('Fecha Hora Termino')
                    ->date()
                    ->seconds(false)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('instructor')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('alumno')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ColorColumn::make('color')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_at')
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('end_at')
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
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
                Filter::make('start_at')
                    ->form([
                        DatePicker::make('fecha_inicio'),
                        DatePicker::make('fecha_termino'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['fecha_inicio'],
                                fn (Builder $query, $date): Builder => $query->whereDate('start_at', '>=', $date),
                            )
                            ->when(
                                $data['fecha_termino'],
                                fn (Builder $query, $date): Builder => $query->whereDate('start_at', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                    // Boton para exportar en excel
                ExportBulkAction::make()
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
            'index' => Pages\ListInstructors::route('/'),
            'create' => Pages\CreateInstructor::route('/create'),
            'edit' => Pages\EditInstructor::route('/{record}/edit'),
        ];
    }
}

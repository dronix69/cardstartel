<?php

namespace App\Filament\Resources;

use App\Filament\Exports\MatriculaExporter;
use App\Filament\Resources\MatriculaResource\Pages;
use App\Models\Matricula;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\ExportAction;

use Filament\Tables\Filters\Filter;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Actions\Action;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;



class MatriculaResource extends Resource
{
    protected static ?string $model = Matricula::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'School';

    protected static ?int $navigationSort = 0;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Datos')
                            ->schema([
                                Forms\Components\TextInput::make('codigo')
                                ->disabled()
                                ->dehydrated(false)
                                ->columnSpan('full')
                                ->label('Código de Matricula')
                                ->helperText('Este código se generará automáticamente al guardar.'),
                                Forms\Components\TextInput::make('nombre')
                                    ->required()
                                    ->maxValue(50)
                                    ->autocapitalize('words')
                                    ->autocomplete(false),
                                Forms\Components\TextInput::make('apellido')
                                    ->required()
                                    ->maxValue(50)
                                    ->autocapitalize('words')
                                    ->autocomplete(false),
                                Forms\Components\TextInput::make('rut')
                                    ->unique(
                                        table: 'matriculas', 
                                        ignoreRecord: true
                                    )
                                    ->required()
                                    ->prefix('RUT')
                                    ->maxValue(12)
                                    ->autocomplete(false),
                                Forms\Components\TextInput::make('correo')
                                    ->prefixIcon('heroicon-m-envelope-open')
                                    ->required()
                                    ->email()
                                    ->unique(ignoreRecord: true),
                                Forms\Components\TextInput::make('telefono')
                                    ->prefix('+56')
                                    ->label('Telefono')
                                    ->tel()
                                    ->required()
                                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                                    ->maxValue(20)
                                    ->placeholder('977777777'),
                                Forms\Components\TextInput::make('edad')
                                    ->required()
                                    ->maxValue(3),
                                Forms\Components\TextInput::make('direccion')
                                    ->required()
                                    ->maxValue(255)
                                    ->autocapitalize('words')
                                    ->autocomplete(false),
                                Forms\Components\TextInput::make('comuna')
                                    ->required()
                                    ->maxValue(50)
                                    ->autocapitalize('words')
                                    ->autocomplete(false),
                                Forms\Components\Select::make('nivel')
                                    ->label('Nivel de Escolaridad')
                                    ->required()
                                    ->options([
                                        'Basica Incompleta' => 'Basica Incompleta',
                                        'Basica Completa' => 'Basica Completa',
                                        'Media Incompleta' => 'Media Incompleta',
                                        'Media Completa' => 'Media Completa',
                                        'Tecnico' => 'Tecnico',
                                        'Universitario' => 'Universitario',
                                    ]),
                                Forms\Components\Select::make('licencia_actual')
                                    ->required()
                                    ->options([
                                        'B' => 'B',
                                        'A2' => 'A2',
                                        'A3' => 'A3',
                                        'A4' => 'A4',
                                        'A5' => 'A5',
                                        'A2-A4' => 'A2-A4',
                                        'A3-A5' => 'A3-A5',
                                    ]),    
                                Forms\Components\Select::make('curso_id')
                                    ->relationship('curso', 'codigo')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->columnSpan('full'),
                            ])->columns('2')
                        ]),

                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('Fechas')
                                    ->schema([
                                        Forms\Components\DatePicker::make('fecha_matricula')
                                            ->date()
                                            ->default(Carbon::now()->toDateString()),
                                        Forms\Components\DatePicker::make('fecha_nacimiento')
                                            ->date()
                                            ->required(),
                                        Forms\Components\FileUpload::make('image_url')
                                            ->label('Sube una Imagen')
                                            ->disk('public')
                                            ->directory('image-filament')
                                            ->image()
                                            ->preserveFilenames()
                                            ->imageEditor()
                                            ->columnSpan('full')
                                            
                                    ])->columns('2')
                            ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Imagen')
                    ->square(),
                Tables\Columns\TextColumn::make('codigo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('apellido')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('rut')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('correo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefono')
                    ->searchable(),
                Tables\Columns\TextColumn::make('edad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_matricula')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_nacimiento')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('direccion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('comuna')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nivel')
                    ->searchable(),
                Tables\Columns\TextColumn::make('licencia_actual')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'B' => 'primary',
                        'A2' => 'warning',
                        'A3' => 'success',
                        'A4' => 'danger',
                        'A5' => 'info',
                    }),    
                Tables\Columns\TextColumn::make('curso.codigo')
                    ->label('Curso')
                    ->sortable()
                    ->toggleable(),
                
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
                Filter::make('fecha_matricula')
                ->form([
                    DatePicker::make('fecha_inicio'),
                    DatePicker::make('fecha_termino'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['fecha_inicio'],
                            fn (Builder $query, $date): Builder => $query->whereDate('fecha_matricula', '>=', $date),
                        )
                        ->when(
                            $data['fecha_termino'],
                            fn (Builder $query, $date): Builder => $query->whereDate('fecha_matricula', '<=', $date),
                        );
                })
            ])


            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),

                // Boton seleccionar un contrato y poder imprimir un pdf del alumno
                Action::make('imprimir_contrato')
                ->label('Imprimir Contrato')
                ->icon('heroicon-o-printer')
                ->form([
                    Select::make('tipo_contrato')
                        ->label('Seleciona el Contrato')
                        ->options([
                            'matricula' => 'SIT',
                            'prof' => 'PROF',
                        ])
                        ->required(),
                ])
                ->action(function (Matricula $record, array $data) {
                    $tipoContrato = $data['tipo_contrato'];
                    $view = $tipoContrato === 'matricula' ? 'matricula' : 'prof';
                    
                    $pdf = PDF::loadView("contratos.{$view}", ['matricula' => $record]);
                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->output();
                    }, "{$tipoContrato}_contrato.pdf");
                }),
            ])

            //->headerActions([
            //    ExportAction::make()->exporter(MatriculaExporter::class)
            //])
            
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),


                     // Boton para exportar en excel
                ExportBulkAction::make()   
                ]),
            ]);
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Información del Alumno')
                ->schema([
                    TextEntry::make('codigo')->label('Codigo'),
                    TextEntry::make('nombre')->label('Nombre'),
                    TextEntry::make('apellido')->label('Apellido'),
                    TextEntry::make('rut')
                        ->label('Rut')
                        ->numeric(),
                    TextEntry::make('correo')->label('Email'),
                    TextEntry::make('telefono')->label('Telefono'),
                    TextEntry::make('edad')->label('Edad'),
                    TextEntry::make('fecha_matricula')
                        ->label('Fecha Matricula')
                        ->date(),
                    TextEntry::make('fecha_nacimiento')
                        ->label('Fecha Nacimiento')
                        ->date(),
                    TextEntry::make('direccion')->label('Dirección'),
                    TextEntry::make('comuna')->label('Comuna'),
                    TextEntry::make('nivel')->label('Nivel de Escolaridad'),
                    TextEntry::make('licencia_actual')
                        ->label('Licencia Actual')
                        ->badge(),
                    TextEntry::make('curso.codigo')
                        ->label('Curso')
                        ->badge(),
                ])->columns(2)
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
            'index' => Pages\ListMatriculas::route('/'),
            'create' => Pages\CreateMatricula::route('/create'),
            'edit' => Pages\EditMatricula::route('/{record}/edit'),
        ];
    }
}

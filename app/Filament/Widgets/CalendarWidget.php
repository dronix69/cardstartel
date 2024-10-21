<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use App\Filament\Resources\InstructorResource;
use App\Models\Instructor;
use Doctrine\DBAL\Schema\Column;

use Filament\Forms;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Form;
use Saade\FilamentFullCalendar\Actions\CreateAction;
use Saade\FilamentFullCalendar\Actions\DeleteAction;
use Saade\FilamentFullCalendar\Actions\EditAction;

use function PHPUnit\Framework\callback;

class CalendarWidget extends FullCalendarWidget
{
    protected static ?int $sort = 5;
    public Model | string | null $model = Instructor::class;

    public function fetchEvents(array $fetchInfo): array
    {
        return Instructor::query()
            ->where('start_at', '>=', $fetchInfo['start'])
            ->where('end_at', '<=', $fetchInfo['end'])
            ->get()
            ->map(
                fn(Instructor $event) => [
                    'id' => $event->id,
                    'title' => $event->instructor,
                    'alumno' => $event->alumno,
                    'color' => $event->color,
                    'start' => $event->start_at,
                    'end' => $event->end_at,

                ]
            )
            ->all();
    }
    public function getFormSchema(): array
    {
        return [
            Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Select::make('instructor')
                        ->required()
                        ->options([
                            'rodrigo taffo' => 'Rodrigo Taffo',
                            'daniel ferrada' => 'Daniel Ferrada',
                        ]),
                    Forms\Components\TextInput::make('alumno')
                        ->required(),
                    Forms\Components\ColorPicker::make('color')
                        ->required(),
                ])->columns('3'),
            Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\DateTimePicker::make('start_at')
                        ->required()
                        ->seconds(false),
                    Forms\Components\DateTimePicker::make('end_at')
                        ->required()
                        ->seconds(false),
                ]),
        ];
    }

    protected function modalActions(): array
    {
        return [

            CreateAction::make()
                ->mountUsing(
                    callback: function (Form $form, array $arguments) {
                        $form->fill([
                            'start_at' => $arguments['start'] ?? null,
                            'end_at' => $arguments['end'] ?? null
                        ]);
                    }
                ),
            EditAction::make()
                ->mountUsing(
                    callback: function (Instructor $record, Form $form, array $arguments) {
                        $form->fill([
                            'instructor' => $record->instructor,
                            'alumno' => $record->alumno,
                            'color' => $record->color,
                            'start_at' => $arguments['event']['start'] ?? $record->start_at,
                            'end_at' => $arguments['event']['end'] ?? $record->end_at
                        ]);
                    }
                ),
            DeleteAction::make(),
        ];
    }
}

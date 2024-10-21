<?php

namespace App\Filament\Widgets;

use App\Models\Venta;
use Carbon\Carbon;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Request;

class VentasHoy extends BaseWidget
{
    protected static ?string $pollingInterval = '15s';
    

    public static function canView(): bool
    {
        $currentUrl = Request::url();
        return str_contains($currentUrl, '/admin/ventas');
    }

    

    protected function getStats(): array
    {
        return [
            Stat::make(label:'N° Total Ventas', value: Venta::count())
                ->description('Numero total de Ventas')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('warning'), 

            Stat::make('Total Ventas Hoy', $this->getTotalVentasHoy())
                ->description('Total de ventas realizadas hoy')
                ->descriptionIcon('heroicon-m-currency-dollar', IconPosition::Before)
                ->color('warning'),
                
            Stat::make('Total Ventas del Mes', $this->getTotalVentasMes())
                ->description('Total de ventas realizadas en el Mes')
                ->descriptionIcon('heroicon-m-currency-dollar', IconPosition::Before)
                ->color('warning'),
        ];
    }

    private function getTotalVentasHoy(): string
    {
        $totalVentas = Venta::whereDate('created_at', Carbon::today())
                            ->sum('total');
        
        return '$ ' .number_format($totalVentas, 0, ',', '.');
    }

    private function getTotalVentasMes(): string
    {
        $totalVentas = Venta::whereYear('created_at', Carbon::now()->year)
                            ->whereMonth('created_at', Carbon::now()->month)
                            ->sum('total');
        
        return '$ ' .number_format($totalVentas, 0, ',', '.');
    }
}

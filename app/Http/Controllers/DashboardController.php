<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCollection;

class DashboardController extends Controller
{
    public function getStats(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        $userId = auth()->id();
        
        // Estadísticas generales
        $generalStats = UserCollection::where('user_id', $userId)
            ->selectRaw('COUNT(*) as total_sets')
            ->selectRaw('SUM(price_acquired) as total_value')
            ->selectRaw('AVG(price_acquired) as average_price')
            ->first();
            
        // Distribución por estado
        $statusDistribution = UserCollection::where('user_id', $userId)
            ->select('status')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('status')
            ->get();
            
        // Adquisiciones por mes
        $acquisitionsByMonth = UserCollection::where('user_id', $userId)
            ->selectRaw('MONTH(date_acquired) as month')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('month')
            ->get();
            
        // Adquisiciones por año
        $acquisitionsByYear = UserCollection::where('user_id', $userId)
            ->selectRaw('YEAR(date_acquired) as year')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('year')
            ->get();
            
        // Set más caro
        $mostExpensive = UserCollection::where('user_id', $userId)
            ->where('price_acquired', '>', 0)
            ->orderBy('price_acquired', 'desc')
            ->with('brickheadz') // Asumiendo que tienes una relación con el modelo BrickHeadz
            ->first();
            
        // Set más barato
        $cheapest = UserCollection::where('user_id', $userId)
            ->where('price_acquired', '>', 0)
            ->orderBy('price_acquired', 'asc')
            ->with('brickheadz')
            ->first();
            
        return response()->json([
            'general_stats' => $generalStats,
            'status_distribution' => $statusDistribution,
            'acquisitions_by_month' => $acquisitionsByMonth,
            'acquisitions_by_year' => $acquisitionsByYear,
            'most_expensive' => $mostExpensive,
            'cheapest' => $cheapest
        ]);
    }
}
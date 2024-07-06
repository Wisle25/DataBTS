<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use Carbon\Carbon;
use App\Models\BTS;
use App\Models\Monitoring;
use Illuminate\Http\Request;
use App\Exports\ExportMonitoring;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class MonitoringController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->peran == 'Administrator' || Auth::user()->peran == 'Surveyor' || Auth::user()->peran == 'PIC') {
                $max_data = 8;

                if ($request->search) {
                    $monitorings = Monitoring::whereHas('bts', function ($query) use ($request) {
                        $query->where('nama', 'like', '%' . $request->search . '%');
                    })
                        ->orderBy('tgl_generate', 'desc')
                        ->paginate($max_data);
                } else {
                    $monitorings = Monitoring::with('bts', 'kondisi_bts')
                        ->orderBy('tgl_generate', 'desc')
                        ->paginate($max_data);
                }

                $notMonitoredBts = $this->checkMonitoringGaps();
                $notMonitoredBtsCurrentMonth = $this->checkMonitoringGapsCurrentMonth();

                $scatterData = Monitoring::select('tgl_generate', 'id_kondisi_bts')
                    ->with('kondisi_bts')
                    ->get()
                    ->groupBy(function ($date) {
                        return Carbon::parse($date->tgl_generate)->format('Y-m'); // Group by year and month
                    })
                    ->map(function ($monthYearGroup) {
                        return $monthYearGroup->groupBy('id_kondisi_bts')->map->count();
                    });

                // Handle month and year filter
                $selectedMonth = $request->input('month', now()->month);
                $selectedYear = $request->input('year', now()->year);

                $pieData = Monitoring::select('id_kondisi_bts', DB::raw('count(*) as count'))
                    ->whereYear('tgl_generate', $selectedYear)
                    ->whereMonth('tgl_generate', $selectedMonth)
                    ->groupBy('id_kondisi_bts')
                    ->get()
                    ->mapWithKeys(function ($item) {
                        return [$item->id_kondisi_bts => $item->count];
                    });

                $normalBTSList = Monitoring::with('bts')
                    ->where('id_kondisi_bts', 1)
                    ->whereYear('tgl_generate', $selectedYear)
                    ->whereMonth('tgl_generate', $selectedMonth)
                    ->get()
                    ->pluck('bts.nama')
                    ->toArray();

                $faultBTSList = Monitoring::with('bts')
                    ->where('id_kondisi_bts', 2)
                    ->whereYear('tgl_generate', $selectedYear)
                    ->whereMonth('tgl_generate', $selectedMonth)
                    ->get()
                    ->pluck('bts.nama')
                    ->toArray();

                $maintenanceBTSList = Monitoring::with('bts')
                    ->where('id_kondisi_bts', 3)
                    ->whereYear('tgl_generate', $selectedYear)
                    ->whereMonth('tgl_generate', $selectedMonth)
                    ->get()
                    ->pluck('bts.nama')
                    ->toArray();

                $offlineBTSList = Monitoring::with('bts')
                    ->where('id_kondisi_bts', 4)
                    ->whereYear('tgl_generate', $selectedYear)
                    ->whereMonth('tgl_generate', $selectedMonth)
                    ->get()
                    ->pluck('bts.nama')
                    ->toArray();

                $btsData = [
                    'normal' => $normalBTSList,  // Array berisi informasi detail BTS yang normal
                    'fault' => $faultBTSList,    // Array berisi informasi detail BTS yang fault
                    'maintenance' => $maintenanceBTSList,  // Array berisi informasi detail BTS yang maintenance
                    'offline' => $offlineBTSList  // Array berisi informasi detail BTS yang offline
                ];
                // dd($btsData);

                // Get available months and years from data
                $availableMonths = Monitoring::selectRaw('DISTINCT MONTH(tgl_generate) as month')->orderBy('month')->pluck('month');
                $availableYears = Monitoring::selectRaw('DISTINCT YEAR(tgl_generate) as year')->orderBy('year')->pluck('year');

                return view('pages.monitoring.index', compact(
                    'monitorings',
                    'scatterData',
                    'notMonitoredBts',
                    'notMonitoredBtsCurrentMonth',
                    'pieData',
                    'selectedMonth',
                    'selectedYear',
                    'availableMonths',
                    'availableYears',
                    'btsData'
                ));
            } else {
                return redirect('/unauthorized')->with('error', 'Anda tidak memiliki hak akses untuk halaman ini.');
            }
        } else {
            return redirect('/login');
        }
    }

    public function checkMonitoringGaps()
    {
        // Define all 12 months
        $requiredMonths = range(1, 12);
        $currentYear = now()->year;

        // Get the latest monitoring data for the current year
        $latestMonitorings = Monitoring::whereYear('tgl_generate', $currentYear)
            ->orderBy('tgl_generate', 'desc')
            ->get()
            ->groupBy('id_bts');

        // Filter out BTS that have not been monitored in the required months
        $notMonitoredBts = $latestMonitorings->filter(function ($monitorings, $btsId) use ($requiredMonths) {
            $monitoredMonths = $monitorings->pluck('tgl_generate')->map(function ($tgl) {
                return Carbon::parse($tgl)->month;
            })->unique();

            // Check if all 12 months are present in the monitored months
            foreach ($requiredMonths as $month) {
                if (!$monitoredMonths->contains($month)) {
                    return true;
                }
            }
            return false;
        })->keys();

        // Get the BTS data for the BTS IDs that were not monitored in all required months
        return Bts::whereIn('id', $notMonitoredBts)->get(['id', 'nama']);
    }

    public function checkMonitoringGapsCurrentMonth()
    {
        $currentYearMonth = now()->format('Y-m');

        // Get the latest monitoring data for the current year and month
        $latestMonitorings = Monitoring::whereYear('tgl_generate', now()->year)
            ->whereMonth('tgl_generate', now()->month)
            ->orderBy('tgl_generate', 'desc')
            ->get()
            ->groupBy('id_bts');

        // Filter out BTS that have not been monitored in the current month
        $notMonitoredBts = Bts::whereNotIn('id', $latestMonitorings->keys())->get(['id', 'nama']);

        return $notMonitoredBts;
    }

    public function export_excel()
    {
        return Excel::download(new ExportMonitoring, "Monitoring.xlsx");
    }

    public function create()
    {
        return view('pages.monitoring.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer',
            'id_bts' => 'required|integer',
            'tgl_generate' => 'required|date',
            'tgl_kunjungan' => 'required|date',
            'id_kondisi_bts' => 'required|exists:kondisi_bts,id'
        ]);

        Monitoring::create([
            'tahun' => $request->tahun,
            'id_bts' => $request->id_bts,
            'tgl_generate' => $request->tgl_generate,
            'tgl_kunjungan' => $request->tgl_kunjungan,
            'id_kondisi_bts' => $request->id_kondisi_bts,
            'id_user' => Auth::user()->id,
            'created_by' => Auth::user()->username,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('monitoring.index')->with('success', 'Monitoring created successfully.');
    }

    public function edit(Monitoring $monitoring)
    {
        return view('pages.monitoring.edit', compact('monitoring'));
    }

    public function update(Request $request, Monitoring $monitoring)
    {
        $request->validate([
            'tahun' => 'required|date_format:Y',
            'id_bts' => 'required|exists:bts,id',
            'tgl_generate' => 'required|date',
            'tgl_kunjungan' => 'required|date',
            'id_kondisi_bts' => 'required|exists:kondisi_bts,id',
        ]);

        $monitoring->update([
            'tahun' => $request->tahun,
            'id_bts' => $request->id_bts,
            'tgl_generate' => $request->tgl_generate,
            'tgl_kunjungan' => $request->tgl_kunjungan,
            'id_kondisi_bts' => $request->id_kondisi_bts,
            'edited_by' => Auth::user()->username,
            'updated_at' => now()
        ]);

        return redirect()->route('monitoring.index')->with('success', 'Monitoring updated successfully.');
    }

    public function destroy(Monitoring $monitoring)
    {
        $monitoring->delete();
        return redirect()->route('monitoring.index')->with('success', 'Monitoring deleted successfully.');
    }

    public function exportPdf()
    {
        $monitorings = Monitoring::orderBy('tahun', 'asc')->get();
        $mpdf = new Mpdf();
        $html = view('pages.monitoring.exportPdf', compact('monitorings'))->render();
        $mpdf->WriteHTML($html);
        $pdfOutput = $mpdf->Output('Monitoring.pdf', 'S'); // S: return as a string

        return response($pdfOutput)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Monitoring.pdf"')
            ->header('Cache-Control', 'private, max-age=0, must-revalidate')
            ->header('Pragma', 'public');
    }
}

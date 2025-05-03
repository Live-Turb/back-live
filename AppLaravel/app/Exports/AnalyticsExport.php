<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\ViewStatistic;

class AnalyticsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $query;
    
    public function __construct($query)
    {
        $this->query = $query;
    }

    public function collection()
    {
        return $this->query->get();
    }

    public function headings(): array
    {
        return [
            'Data e Hora',
            'Dispositivo',
            'Navegador',
            'Sistema Operacional',
            'Origem',
            'Campanha',
            'Fonte',
            'Meio',
            'Visualização Única',
            'IP',
            'País',
            'Cidade'
        ];
    }

    public function map($row): array
    {
        return [
            $row->created_at->format('d/m/Y H:i:s'),
            $this->formatDeviceType($row->device_type),
            $row->browser,
            $row->os,
            $row->referrer_domain ?? 'Direto',
            $row->utm_campaign ?? 'N/A',
            $row->utm_source ?? 'N/A',
            $row->utm_medium ?? 'N/A',
            $row->is_unique ? 'Sim' : 'Não',
            $row->ip,
            $row->country ?? 'N/A',
            $row->city ?? 'N/A'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A1:L1' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E2EFDA']
                ]
            ]
        ];
    }

    private function formatDeviceType($type)
    {
        $types = [
            'mobile' => 'Celular',
            'tablet' => 'Tablet',
            'desktop' => 'Desktop',
            'robot' => 'Bot'
        ];

        return $types[$type] ?? $type;
    }
}

<?php

namespace App\Exports;

use App\Models\Egress;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Morilog\Jalali\Jalalian;

class EgressExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    public Collection $array;

    public function __construct(Collection $array)
    {
        $this->array = $array;
    }

    public function collection(): Collection
    {
        Log::alert($this->array->get('fruit_id'));
        $egressCollection = Egress::query()
            ->select('egress.id', 'egress.plate', 'fruit.name as fruit_name', 'egress.weight', 'egress.entry_date',
                'provinces.name as province_name', 'cities.name as city_name', 'stalls.name as stall_name',
                'halls.name as hall_name', 'egress.fruit_id', 'egress.province_id', 'egress.city_id', 'egress.stall_id',
                'egress.hall_id', 'egress.created_at')
            ->join('fruit', 'egress.fruit_id', '=', 'fruit.id')
            ->join('provinces', 'egress.province_id', '=', 'provinces.id')
            ->join('cities', 'egress.city_id', '=', 'cities.id')
            ->join('halls', 'egress.hall_id', '=', 'halls.id')
            ->join('stalls', 'egress.stall_id', '=', 'stalls.id')
            ->when($this->array->get('province_id'), function ($query, $param) {
                $query->where('egress.province_id', $param);
            })->when($this->array->get('city_id'), function ($query, $param) {
                $query->where('egress.city_id', $param);
            })->when($this->array->get('stall_id'), function ($query, $param) {
                $query->where('egress.stall_id', $param);
            })->when($this->array->get('hall_id'), function ($query, $param) {
                $query->where('egress.hall_id', $param);
            })->when($this->array->get('fruit_id'), function ($query, $param) {
                $query->where('egress.fruit_id', $param);
            })
            ->when($this->array->get('created_at_to'), function ($query, $created_at_from) {
                $query->whereDate('entry_date', '<=', "$created_at_from");
            })
            ->when($this->array->get('created_at_from'), function ($query, $created_at_to) {
                $query->whereDate('entry_date', '>=', "$created_at_to");
            })
            ->orderByDesc('entry_date')->get();

        $egressCollection->map(function ($array) {
            unset($array['fruit_id']);
            unset($array['province_id']);
            unset($array['city_id']);
            unset($array['stall_id']);
            unset($array['hall_id']);
            unset($array['created_at']);
            $array['entry_date'] = Jalalian::fromDateTime($array['entry_date'])->format('Y/m/d');
            return $array;
        });
        return $egressCollection;
    }

    public function headings(): array
    {
        return [
            'شناسه',
            'پلاک',
            'میوه',
            'وزن(کیلوگرم)',
            'تاریخ ثبت',
            'استان',
            'شهر',
            'غرفه',
            'تالار',
        ];
    }
}

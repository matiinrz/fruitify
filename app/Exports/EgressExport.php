<?php

namespace App\Exports;

use App\Models\Egress;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EgressExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    public Collection $array;

    public function __construct(Collection $array)
    {
        $this->array = $array;
    }

    public function collection(): Collection
    {
        $egressCollection = Egress::query()
            ->select('egress.id', 'egress.plate', 'fruit.name', 'egress.weight', 'egress.entry_date',
                'provinces.name', 'cities.name', 'stalls.name', 'halls.name',
                'egress.fruit_id', 'egress.province_id', 'egress.city_id', 'egress.stall_id', 'egress.hall_id', 'egress.created_at')
            ->join('fruit', 'egress.fruit_id', '=', 'fruit.id')
            ->join('provinces', 'egress.province_id', '=', 'provinces.id')
            ->join('cities', 'egress.city_id', '=', 'cities.id')
            ->join('halls', 'egress.hall_id', '=', 'halls.id')
            ->join('stalls', 'egress.stall_id', '=', 'stalls.id')
            ->when($this->array->get('province_id'), function ($query, $param) {
                $query->where('province_id', $param);
            })->when($this->array->get('city_id'), function ($query, $param) {
                $query->where('city_id', $param);
            })->when($this->array->get('stall_id'), function ($query, $param) {
                $query->where('stall_id', $param);
            })->when($this->array->get('hall_id'), function ($query, $param) {
                $query->where('hall_id', $param);
            })->when($this->array->get('fruit_id'), function ($query, $param) {
                $query->where('fruit_id', $param);
            })
            ->when($this->array->get('created_at_from'), function ($query, $created_at_from) {
                $query->where('created_at', '<=', "$created_at_from 00:00:00");
            })
            ->when($this->array->get('created_at_to'), function ($query, $created_at_to) {
                $query->where('created_at', '>=', "$created_at_to 23:59:59");
            })
            ->orderByDesc('created_at')->get();

        return collect(array_diff($egressCollection->toArray(), ['fruit_id', 'province_id', 'city_id', 'stall_id', 'hall_id', 'created_at']));
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

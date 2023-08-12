<?php

namespace App\Exports;

use App\Models\Egress;
use App\Models\Entry;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
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
        return Egress::query()
            ->select('egress.id', 'plate', 'fruit_id', 'fruit.name', 'weight',
                'entry_date', 'egress.province_id', 'provinces.name', 'egress.city_id', 'cities.name', 'egress.stall_id',
                'stalls.name', 'egress.hall_id', 'halls.name', 'egress.created_at')
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
    }

    public function headings(): array
    {
        return [
            'شناسه',
            'پلاک',
            'fruit_id',
            'weight',
            'entry_date',
            'user_id',
            'province_id',
            'city_id',
            'stall_id',
            'hall_id',
            'created_at',
        ];
    }
}

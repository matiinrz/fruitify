<?php

namespace App\Exports;

use App\Models\Entry;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EntryExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    public Collection $array;

    public function __construct(Collection $array)
    {
        $this->array = $array;
    }

    public function collection(): Collection
    {
        return Entry::query()
            ->select('entry.id', 'entry.plate', 'entry.fruit_id', 'fruit.name', 'entry.weight',
                'entry.entry_date', 'entry.province_id', 'provinces.name', 'entry.city_id', 'cities.name',
                'entry.stall_id', 'stalls.name', 'entry.hall_id', 'halls.name', 'entry.created_at')

            ->join('fruit', 'entry.fruit_id', '=', 'fruit.id')
            ->join('provinces', 'entry.province_id', '=', 'provinces.id')
            ->join('cities', 'entry.city_id', '=', 'cities.id')
            ->join('halls', 'entry.hall_id', '=', 'halls.id')
            ->join('stalls', 'entry.stall_id', '=', 'stalls.id')
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
            'id',
            'plate',
            'plate_image',
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

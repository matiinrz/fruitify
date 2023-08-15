<?php

namespace App\Exports;

use App\Models\Entry;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Morilog\Jalali\Jalalian;

class EntryExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    public Collection $array;

    public function __construct(Collection $array)
    {
        $this->array = $array;
    }

    public function collection(): Collection
    {
        $entryCollection = Entry::query()
            ->select('entry.id', 'entry.plate', 'fruit.name as fruit_name', 'entry.weight', 'entry.entry_date',
                'provinces.name as province_name', 'cities.name as city_name', 'stalls.name as stall_name',
                'halls.name as hall_name', 'entry.fruit_id', 'entry.province_id', 'entry.city_id', 'entry.stall_id',
                'entry.hall_id', 'entry.created_at')
            ->join('fruit', 'entry.fruit_id', '=', 'fruit.id')
            ->join('provinces', 'entry.province_id', '=', 'provinces.id')
            ->join('cities', 'entry.city_id', '=', 'cities.id')
            ->join('halls', 'entry.hall_id', '=', 'halls.id')
            ->join('stalls', 'entry.stall_id', '=', 'stalls.id')
            ->when($this->array->get('entry.province_id'), function ($query, $param) {
                $query->where('entry.province_id', $param);
            })->when($this->array->get('entry.city_id'), function ($query, $param) {
                $query->where('entry.city_id', $param);
            })->when($this->array->get('entry.stall_id'), function ($query, $param) {
                $query->where('entry.stall_id', $param);
            })->when($this->array->get('entry.hall_id'), function ($query, $param) {
                $query->where('entry.hall_id', $param);
            })->when($this->array->get('entry.fruit_id'), function ($query, $param) {
                $query->where('entry.fruit_id', $param);
            })
            ->when($this->array->get('created_at_to'), function ($query, $created_at_from) {
                $query->whereDate('entry_date', '<=', "$created_at_from");
            })
            ->when($this->array->get('created_at_from'), function ($query, $created_at_to) {
                $query->whereDate('entry_date', '>=', "$created_at_to");
            })
            ->orderByDesc('entry_date')->get();

        $entryCollection->map(function ($array) {
            unset($array['fruit_id']);
            unset($array['province_id']);
            unset($array['city_id']);
            unset($array['stall_id']);
            unset($array['hall_id']);
            unset($array['created_at']);
            $array['entry_date'] = Jalalian::fromDateTime($array['entry_date'])->format('Y/m/d');
            return $array;
        });
        return $entryCollection;
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

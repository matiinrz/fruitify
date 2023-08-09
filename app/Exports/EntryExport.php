<?php

namespace App\Exports;

use App\Models\Entry;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromCollection;

class EntryExport implements FromCollection
{
    public Collection $array;

    public function __construct(Collection $array)
    {
        $this->array = $array;
    }

    public function collection(): Collection
    {
        return Entry::query()
            ->with('fruit', 'hall', 'city', 'province', 'stall')
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
}

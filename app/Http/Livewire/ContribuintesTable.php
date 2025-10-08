<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\IpraForm;
class ContribuintesTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'asc';
    public $perPage = 10;

    protected $updatesQueryString = ['search', 'sortField', 'sortDirection', 'page'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $contribuintes = IpraForm::query()
            ->when($this->search, function ($query) {
                $query->where('ps_nome', 'like', '%' . $this->search . '%')
                      ->orWhere('ps_apelido', 'like', '%' . $this->search . '%')
                      ->orWhere('pj_representante', 'like', '%' . $this->search . '%')
                      ->orWhere('pj_nome_empresa', 'like', '%' . $this->search . '%')
                      ->orWhere('nuit', 'like', '%' . $this->search . '%')
                      ->orWhere('telefone', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.contribuintes-table', [
            'contribuintes' => $contribuintes,
        ]);
    }
}

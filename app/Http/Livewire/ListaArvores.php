<?php

namespace App\Http\Livewire;

use App\Models\Arvore;
use Livewire\Component;
use Livewire\WithPagination;

class ListaArvores extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        //$arvores = Arvore::paginate(50);
        $arvores = Arvore::query()->select('arvores.id', 'especie_id', 'latitude', 'longitude', 'porte', 'codigo_unico')
            ->with('especie')
            ->join('especies', 'especies.id', '=', 'arvores.especie_id')
            ->orderByRaw('especies.nome_popular COLLATE "pt_BR"')
            ->orderBy('codigo_unico', 'asc')
            ->where('especies.nome_popular', 'ilike', '%' . $this->search . '%')
            ->orWhere('especies.nome_cientifico', 'ilike', '%' . $this->search . '%')
            ->orWhere('codigo_unico', 'ilike', '%' . $this->search . '%')
            ->paginate(50);
        return view('livewire.lista-arvores', compact('arvores'))->layout('layouts.livewire');
    }
}

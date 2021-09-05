<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

abstract class SearchableComponent extends Component
{
    use WithPagination;

    /** @var string $search */
    public string $search = '';

    protected int $paginate = 12;

    private $query;

    public function __construct($id = null)
    {
        parent::__construct($id);

        $this->prepareModelQuery();
    }

    /**
     * Prepare query.
     */
    private function prepareModelQuery()
    {
        $model = app($this->model());

        $this->query = $model->newQuery();
    }

    abstract function model();

    /**
     * Reset model query.
     */
    protected function resetQuery()
    {
        $this->prepareModelQuery();
    }

    protected function getQuery()
    {
        return $this->query;
    }

    /**
     * @param Builder $query
     */
    protected function setQuery(Builder $query)
    {
        $this->query = $query;
    }

    /**
     * @param bool $search
     * @return LengthAwarePaginator
     */
    protected function paginate(bool $search = true): LengthAwarePaginator
    {
        if ($search) {
            $this->filterResults();
        }

        $all = $this->query->paginate($this->paginate);
        $currentPage = $all->currentPage();
        $lastPage = $all->lastPage();

        if ($currentPage > $lastPage) {
            $this->page = $lastPage;
        }

        return $this->query->paginate($this->paginate);
    }

    protected function filterResults()
    {
        $searchableFields = $this->searchableFields();
        $search = $this->search;


        $this->query->when(! empty($search), function (Builder $q) use ($search, $searchableFields) {
            $searchString = '%'.$search.'%';
            foreach ($searchableFields as $field) {
                if (Str::contains($field, '.')) {
                    $field = explode('.', $field);
                    $q->orWhereHas($field[0], function (Builder $query) use ($field, $searchString) {
                        $query->whereRaw("lower($field[1]) like ?", $searchString);
                    });
                } else {
                    $q->orWhereRaw("lower($field) like ?", $searchString);
                }
            }
        });


        return $this->query;
    }

    abstract function searchableFields();
}

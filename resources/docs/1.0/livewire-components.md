# Livewire Components

---

- [Searchable](#searchable)

<a name="searchable"></a>
## Searchable

Fully configurable livewire searching component.
In searchable fields you can specify the field name that you want to search and replace the Model with your records Modal.

```php
<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use App\Http\Livewire\SearchableComponent;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Tags extends SearchableComponent
{
    public function render()
    {
        $tags = $this->searchTags();


        return view('livewire.tags', [undefined])->with("search");
    }
    
     /**
     * @return LengthAwarePaginator
     */
    public function searchTags()
    {
        $this->setQuery($this->getQuery());


        return $this->paginate();
    }
    
    public function model()
    {
        return Tag::class;
    }
    
    public function searchableFields()
    {
        return [];
    }
}
```

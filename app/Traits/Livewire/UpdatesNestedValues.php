<?php
/**
 * Adding this trait to a Livewire component will automatically trigger methods when nested values get updated.
 * For example, by default, if you use wire:model="foo.bar" on a Livewire component, this will only trigger the updatingFoo() and updatedFoo() methods on the component if they exist.
 * With this trait, it will also trigger the updatingFooBar() and updatedFooBar() methods.
 *
 * Gist https://gist.github.com/imliam/3709ceafb0bd60ea8026b5c936f591ac
 */

namespace App\Traits\Livewire;

use Illuminate\Support\Str;

trait UpdatesNestedValues
{
    public function updated($field, $value)
    {
        $this->updateNestedValue('updated', $field, $value);
    }

    public function updating($field, $value)
    {
        $this->updateNestedValue('updating', $field, $value);
    }

    protected function updateNestedValue(string $event, string $field, $value)
    {
        if (!Str::contains($field, '.')) {
            return;
        }

        $eventMethodName = $event . Str::of($field)->replace('.', '_')->studly();

        if (method_exists($this, $eventMethodName)) {
            return $this->{$eventMethodName}($value);
        }
    }
}

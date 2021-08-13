<?php

namespace App\Traits\Livewire;

trait ForwardsAttributes
{
    public string $attributes;

    public function mount(...$attrs)
    {
        $this->mapAttributes(...$attrs);
    }

    public function mapAttributes(...$attrs)
    {
        $attributes = '';
        collect(...$attrs)->each(function ($value, $attr) use (&$attributes) {
            $attributes .= " {$attr}=\"{$value}\"";
        });
        $this->attributes = $attributes;
    }
}

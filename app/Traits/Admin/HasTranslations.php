<?php

namespace App\Traits\Admin;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Spatie\Translatable\Events\TranslationHasBeenSet;
use Spatie\Translatable\HasTranslations as BaseHasTranslations;

trait HasTranslations
{
    use BaseHasTranslations {
        BaseHasTranslations::setTranslation as faultySetTranslation;
    }

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $attributes = parent::toArray();
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, App::getLocale());
        }
        return $attributes;
    }

    /**
     * @throws \Spatie\Translatable\Exceptions\AttributeIsNotTranslatable
     */
    public function setTranslation(string $key, string $locale, $value): self
    {
        $this->guardAgainstNonTranslatableAttribute($key);

        $translations = $this->getTranslations($key);

        $oldValue = $translations[$locale] ?? '';

        if ($this->hasSetMutator($key)) {
            $method = 'set'.Str::studly($key).'Attribute';

            $this->{$method}($value, $locale);

            $value = $this->attributes[$key];
        }

        $translations[$locale] = $value;

        // fixes https://github.com/spatie/laravel-translatable/discussions/290
        $translations = array_filter($translations, fn($value) => $value !== null);

        // fixes https://github.com/spatie/laravel-translatable/discussions/273
        $this->attributes[$key] = json_encode($translations, JSON_UNESCAPED_UNICODE);

        event(new TranslationHasBeenSet($this, $key, $locale, $oldValue, $value));

        return $this;
    }
}

<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Field;
use Illuminate\Contracts\Support\Arrayable;
use Closure;

class SelectAdress extends Field
{
    protected string $view = 'forms.components.select-adress';
    protected array|Arrayable|string|Closure|null $options = null;

    public function options(array|Arrayable|string|Closure|null $options): static
    {
        $this->options = ["test" => "aze"];

        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    // /**
    //  * @param  array<string | array<string>>  $options
    //  * @return array<array<string, mixed>>
    //  */
    // protected function transformOptionsForJs(array $options): array
    // {
    //     return collect($options)
    //         ->map(function ($label, $value): array {
    //             $response = [];
    //             $data_attributes = Arr::get($label, "data-attributes");

    //             $response = ['label' => strval(Arr::get($label, "address")), 'value' => strval(Arr::get($label, "address")), "data-attributes" => $data_attributes];

    //             return ($response);
    //         })
    //         ->values()
    //         ->all();
    // }
}

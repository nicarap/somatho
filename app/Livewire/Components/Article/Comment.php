<?php

namespace App\Livewire\Components\Article;

use App\Models\Article;
use Livewire\Component;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;

class Comment extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    public Article $article;

    public function mount(Article $article): void
    {
        $this->article = $article;
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('commenter')
                    ->email()
                    ->required()
                    ->label(__("filament.attributes.email")),
                Forms\Components\RichEditor::make('content')
                    ->toolbarButtons([
                        'blockquote',
                        'bold',
                        'italic',
                        'underline',
                    ])
                    ->required()
                    ->default("<h1>aze</h1>")
                    ->label(__("filament.attributes.content")),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        dd($this->form->getState());
    }

    public function render()
    {
        return view('livewire.components.article.comment');
    }
}

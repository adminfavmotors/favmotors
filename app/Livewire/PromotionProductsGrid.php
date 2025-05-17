<?php

namespace App\Livewire;

use Livewire\Component;

class PromotionProductsGrid extends Component
{
    // Слаг акции
    public string $slug;

    // Массив товаров-заглушек
    public array $products = [];

    /**
     * Инициализация компонента Livewire:
     * принимает $slug из шаблона и задаёт пару тестовых товаров
     */
    public function mount(string $slug): void
    {
        $this->slug = $slug;

        // Заглушки для демонстрации сетки
        $this->products = [
            (object) ['name' => 'Пример товара 1'],
            (object) ['name' => 'Пример товара 2'],
        ];
    }

    /**
     * Рендеринг шаблона:
     * передаём в него слаг и массив товаров
     */
    public function render()
    {
        return view(
            'livewire.promotion-products-grid',
            [
                'slug'     => $this->slug,
                'products' => $this->products,
            ]
        );
    }
}

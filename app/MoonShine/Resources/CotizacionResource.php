<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cotizacion;
use Illuminate\Http\Request;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Number;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Cotizacion>
 */
class CotizacionResource extends ModelResource
{
    protected string $model = Cotizacion::class;

    protected string $title = 'Cotizacions';

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $detailInModal = false;

    public function redirectAfterSave(): string
    {
        $referer = request()->header('referer');
        return $referer ?: '/';
    }

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Number::make('id_cliente'),
                Text::make('nombre_cliente'),
                Number::make('id_servicio'),
                Text::make('servicio'),
                Text::make('descripcion'),
                Number::make('precio_total')->step(0.01) // Ensure decimal step
            ]),
        ];
    }

    /**
     * @param Cotizacion $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}

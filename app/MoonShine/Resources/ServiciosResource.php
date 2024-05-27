<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Servicios;
use Illuminate\Http\Request;
use MoonShine\Enums\ClickAction;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Number;
use MoonShine\Fields\Image;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Attributes\SearchUsingFullText;

/**
 * @extends ModelResource<Servicios>
 */
class ServiciosResource extends ModelResource
{
    protected string $model = Servicios::class;

    protected string $title = 'Servicios';

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $detailInModal = false;

    protected ?ClickAction $clickAction = ClickAction::EDIT;

    public function redirectAfterSave(): string
    {
        $referer = request()->header('referer');
        return $referer ?: '/';
    }

    #[SearchUsingFullText(['title', 'text'])]
    public function search(): array
    {
        return ['id'];
    }

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Number::make('id_servicio'),
                Text::make('servicio'),
                Text::make('descripcion'),
                Image::make('img', 'img')
                            ->showOnExport()
                            ->allowedExtensions(['jpg', 'png', 'jpeg', 'gif'])

            ]),
        ];
    }

    /**
     * @param Servicios $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}

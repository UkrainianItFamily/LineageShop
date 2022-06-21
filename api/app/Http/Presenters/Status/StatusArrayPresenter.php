<?php

declare(strict_types=1);

namespace App\Http\Presenters\Status;

use Illuminate\Support\Collection;
use App\Actions\Status\StatusParameter;
use App\Http\Presenters\CollectionAsArrayPresenterInterface;

final class StatusArrayPresenter implements CollectionAsArrayPresenterInterface
{
    public function present(StatusParameter $statusParameter): array
    {
        return [
            'name' => $statusParameter->getName(),
            'value' => $statusParameter->getValue(),
        ];
    }

    public function presentCollection(Collection $statusParameters): array
    {
        return $statusParameters->map(fn (StatusParameter $parameter) => $this->present($parameter))->all();
    }
}

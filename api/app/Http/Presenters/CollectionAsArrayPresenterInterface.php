<?php

namespace App\Http\Presenters;

use Illuminate\Support\Collection;

interface CollectionAsArrayPresenterInterface
{
    public function presentCollection(Collection $collection) :array;
}

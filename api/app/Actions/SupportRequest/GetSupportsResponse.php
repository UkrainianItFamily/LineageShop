<?php

declare(strict_types=1);

namespace App\Actions\SupportRequest;

use App\Actions\Response;
use Illuminate\Support\Collection;

final class GetSupportsResponse implements Response
{
    private $supportsCollection;

    public function __construct(Collection $supportsCollection)
    {
        $this->supportsCollection = $supportsCollection;
    }

    public function getResponse(): Collection
    {
        return $this->supportsCollection;
    }
}

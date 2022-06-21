<?php

declare(strict_types=1);

namespace App\Actions\SupportRequest;

use App\Actions\Response;
use Illuminate\Support\Collection;

final class GetSupportRequestByCriteriaResponse implements Response
{
    private $supportRequests;

    public function __construct(Collection $supportRequests)
    {
        $this->supportRequests = $supportRequests;
    }

    public function getResponse(): Collection
    {
        return $this->supportRequests;
    }
}

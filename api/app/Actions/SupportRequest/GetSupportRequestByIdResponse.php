<?php

declare(strict_types=1);

namespace App\Actions\SupportRequest;

use App\Actions\Response;
use App\Models\SupportRequest;

final class GetSupportRequestByIdResponse implements Response
{
    private $supportRequest;

    public function __construct(SupportRequest $supportRequest)
    {
        $this->supportRequest = $supportRequest;
    }

    public function getResponse(): SupportRequest
    {
        return $this->supportRequest;
    }
}

<?php

declare(strict_types=1);

namespace App\Actions\SupportRequestMessage;

use App\Actions\Response;
use App\Models\SupportRequest;

final class GetSupportRequestResponse implements Response
{
    private SupportRequest $supportRequest;

    public function __construct(SupportRequest $supportRequest)
    {
        $this->supportRequest = $supportRequest;
    }

    public function getResponse(): SupportRequest
    {
        return $this->supportRequest;
    }
}

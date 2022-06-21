<?php

declare(strict_types=1);

namespace App\Actions\SupportRequestMessage;

use App\Actions\Response;
use App\Models\SupportRequestMessage;

final class GetSupportRequestMessageResponse implements Response
{
    private $supportRequestMessage;

    public function __construct(SupportRequestMessage $supportRequestMessage)
    {
        $this->supportRequestMessage = $supportRequestMessage;
    }

    public function getResponse(): SupportRequestMessage
    {
        return $this->supportRequestMessage;
    }
}

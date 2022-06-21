<?php

declare(strict_types=1);

namespace App\Actions\SupportRequestMessage;

use App\Actions\Response;
use Illuminate\Support\Collection;

final class GetAllSupportMessagesResponse implements Response
{
    private $supportMessagesCollection;

    public function __construct(Collection $supportMessagesCollection)
    {
        $this->supportMessagesCollection = $supportMessagesCollection;
    }

    public function getResponse(): Collection
    {
        return $this->supportMessagesCollection;
    }
}

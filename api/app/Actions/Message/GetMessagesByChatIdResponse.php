<?php

declare(strict_types=1);

namespace App\Actions\Message;

use App\Actions\Response;
use Illuminate\Support\Collection;

final class GetMessagesByChatIdResponse implements Response
{
    private Collection $messages;

    public function __construct(Collection $messages)
    {
        $this->messages = $messages;
    }

    public function getResponse(): Collection
    {
        return $this->messages;
    }
}

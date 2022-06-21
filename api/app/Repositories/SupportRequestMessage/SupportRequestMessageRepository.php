<?php

declare(strict_types=1);

namespace App\Repositories\SupportRequestMessage;

use App\Models\SupportRequestMessage;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class SupportRequestMessageRepository extends BaseRepository implements SupportRequestMessageRepositoryInterface
{
    public function save(SupportRequestMessage $supportRequestMessage): SupportRequestMessage
    {
        $supportRequestMessage->save();

        return $supportRequestMessage;
    }

    public function getAllBySupportRequestId($id): Collection
    {
       return SupportRequestMessage::with('user')->where('support_request_id','=',$id)->get();
    }
}

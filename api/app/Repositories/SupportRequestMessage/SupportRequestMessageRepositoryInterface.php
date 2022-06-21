<?php

declare(strict_types=1);

namespace App\Repositories\SupportRequestMessage;

use App\Models\SupportRequest;
use App\Models\SupportRequestMessage;
use Illuminate\Support\Collection;


interface SupportRequestMessageRepositoryInterface
{
    public function save(SupportRequestMessage $supportRequestMessage): SupportRequestMessage;
    public function getAllBySupportRequestId($id): Collection;
}

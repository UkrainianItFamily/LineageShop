<?php

declare(strict_types=1);

namespace App\Repositories\SupportRequest;

use App\Constant\SupportRequestConstant;
use App\Models\SupportRequest;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class SupportRequestRepository extends BaseRepository implements SupportRequestRepositoryInterface
{
    public function save(SupportRequest $supportRequest): SupportRequest
    {
        $supportRequest->save();

        return $supportRequest;
    }

    public function getAll(): Collection
    {
       return SupportRequest::all();
    }

    public function getSupportRequestById(int $id): SupportRequest
    {
      $supportRequest = SupportRequest::find($id);

      return $supportRequest;
    }

    public function findByCriteria(array $criteria): Collection
    {
        $query = SupportRequest::query();

        foreach ($criteria as $criterion) {
            $query = $criterion->apply($query);
        }

        return $query
            ->select('support_requests.*')
            ->orderBy(
                SupportRequestConstant::DEFAULT_ORDER_TYPE,
                SupportRequestConstant::DEFAULT_ORDER_DIRECTION
            )
            ->get();
    }

    public function updateSupportStatus(int $supportId, int $statusId): bool
    {
        return SupportRequest::find($supportId)->update(['status' => $statusId]);
    }
}

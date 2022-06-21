<?php

declare(strict_types=1);

namespace App\Actions\SupportRequest;

use App\Repositories\SupportRequest\SupportRequestRepositoryInterface;

final class GetSupportsAction
{
    private SupportRequestRepositoryInterface $supportRepository;

    public function __construct(SupportRequestRepositoryInterface $supportRepository)
    {
        $this->supportRepository = $supportRepository;
    }

    public function execute(): GetSupportsResponse
    {
        $supportsCollection = $this->supportRepository->getAll();

        return new GetSupportsResponse($supportsCollection);
    }
}

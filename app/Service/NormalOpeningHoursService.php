<?php

namespace App\Service;

use App\Contract\Repositories\NormalOpeningHoursContract as NormalOpeningHoursRepository;
use App\Contract\Service\NormalOpeningHoursContract;
use App\Merchant;
use App\NormalOpeningHour;
use Illuminate\Support\Collection;
use Psr\Log\LoggerInterface;

class NormalOpeningHoursService implements NormalOpeningHoursContract
{
    /**
     * @var NormalOpeningHoursRepository
     */
    private NormalOpeningHoursRepository $normalOpeningHoursRepository;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    public function __construct(
        NormalOpeningHoursRepository $normalOpeningHoursRepository,
        LoggerInterface $logger
    ) {
        $this->normalOpeningHoursRepository = $normalOpeningHoursRepository;
        $this->logger = $logger;
    }

    public function getHoursByTypeAndMerchant(string $type, Merchant $merchant): Collection
    {
        switch ($type) {
            case NormalOpeningHour::BUSINESS_HOURS_TYPE:
                return $this->normalOpeningHoursRepository->getOpeningHoursForMerchant($merchant->id);
            case NormalOpeningHour::TABLE_SERVICE_HOURS_TYPE:
                return $this->normalOpeningHoursRepository->getTableServiceHoursForMerchant($merchant);
            default:
                return collect();
        }
    }
}

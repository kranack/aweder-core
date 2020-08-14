<?php

namespace App\Service;

use App\Contract\Repositories\NormalOpeningHoursContract as NormalOpeningHoursRepository;
use App\Contract\Service\NormalOpeningHoursContract;
use App\Merchant;
use App\NormalOpeningHour;
use Illuminate\Database\Eloquent\Collection as DatabaseCollection;
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

    public function getHoursByTypeAndMerchant(
        Merchant $merchant,
        $type
    ): Collection {
        switch ($type) {
            case NormalOpeningHour::BUSINESS_HOURS_TYPE:
                return $this->normalOpeningHoursRepository->getOpeningHoursForMerchant($merchant->id);
            case NormalOpeningHour::TABLE_SERVICE_HOURS_TYPE:
                return $this->normalOpeningHoursRepository->getTableServiceHoursForMerchant($merchant);
            default:
                return $this->normalOpeningHoursRepository->getOpeningHoursForMerchant($merchant->id);
        }
    }

    public function updateHoursByTypeAndMerchant(array $hours, string $type, Merchant $merchant): bool
    {
        if (!in_array($type, NormalOpeningHour::$acceptableTypes, true)) {
            return false;
        }

        switch ($type) {
            case NormalOpeningHour::BUSINESS_HOURS_TYPE:
                return $this->normalOpeningHoursRepository->updateOpeningHoursByMerchant(
                    DatabaseCollection::make($hours),
                    $merchant
                );
            case NormalOpeningHour::TABLE_SERVICE_HOURS_TYPE:
                return $this->normalOpeningHoursRepository->updateTableServiceHoursByMerchant(
                    DatabaseCollection::make($hours),
                    $merchant
                );
            default:
                return false;
        }
    }
}

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
                return $this->normalOpeningHoursRepository->getBusinessHoursForMerchant($merchant->id);
            case NormalOpeningHour::TABLE_SERVICE_HOURS_TYPE:
                return $this->normalOpeningHoursRepository->getTableServiceHoursForMerchant($merchant->id);
            default:
                return $this->normalOpeningHoursRepository->getBusinessHoursForMerchant($merchant->id);
        }
    }

    public function updateHoursByTypeAndMerchant(Merchant $merchant, array $hours, string $type): bool
    {
        if (!in_array($type, NormalOpeningHour::$acceptableTypes, true)) {
            return false;
        }

        switch ($type) {
            case NormalOpeningHour::BUSINESS_HOURS_TYPE:
                return $this->normalOpeningHoursRepository->updateBusinessOpeningHoursByMerchant(
                    $merchant,
                    DatabaseCollection::make($hours)
                );
                break;
            case NormalOpeningHour::TABLE_SERVICE_HOURS_TYPE:
                return $this->normalOpeningHoursRepository->updateTableServiceHoursByMerchant(
                    $merchant,
                    DatabaseCollection::make($hours)
                );
                break;
        }

        return false;
    }
}

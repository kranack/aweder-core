<?php

namespace App\Repository;

use App\Contract\Repositories\NormalOpeningHoursContract;
use App\Merchant;
use App\NormalOpeningHour;
use Illuminate\Database\Eloquent\Collection;
use Psr\Log\LoggerInterface;

class NormalOpeningHoursRepository implements NormalOpeningHoursContract
{
    /**
     * @var NormalOpeningHour
     */
    protected NormalOpeningHour $model;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    public function __construct(NormalOpeningHour $model, LoggerInterface $logger)
    {
        $this->model = $model;

        $this->logger = $logger;
    }

    public function createDefaultOpeningHoursForMerchant(int $merchantId): Collection
    {
        $defaultHours = [
            'monday' => [
                'opening' => [
                    'hour' => '09',
                    'minute' => '00',
                ],
                'closing' => [
                    'hour' => '17',
                    'minute' => '00',
                ],
            ],
            'tuesday' => [
                'opening' => [
                    'hour' => '09',
                    'minute' => '00',
                ],
                'closing' => [
                    'hour' => '17',
                    'minute' => '00',
                ],
            ],
            'wednesday' => [
                'opening' => [
                    'hour' => '09',
                    'minute' => '00',
                ],
                'closing' => [
                    'hour' => '17',
                    'minute' => '00',
                ],
            ],
            'thursday' => [
                'opening' => [
                    'hour' => '09',
                    'minute' => '00',
                ],
                'closing' => [
                    'hour' => '17',
                    'minute' => '00',
                ],
            ],
            'friday' => [
                'opening' => [
                    'hour' => '09',
                    'minute' => '00',
                ],
                'closing' => [
                    'hour' => '17',
                    'minute' => '00',
                ],
            ],
            'saturday' => [
                'opening' => [
                    'hour' => '09',
                    'minute' => '00',
                ],
                'closing' => [
                    'hour' => '17',
                    'minute' => '00',
                ],
            ],
            'sunday' => [
                'opening' => [
                    'hour' => '09',
                    'minute' => '00',
                ],
                'closing' => [
                    'hour' => '17',
                    'minute' => '00',
                ],
            ],
        ];

        if ($this->createNormalOpeningHours($defaultHours, $merchantId)) {
            return $this->getBusinessHoursForMerchant($merchantId);
        }
        return new Collection();
    }

    public function clearCurrentOpeningHoursForMerchant(int $merchantId): void
    {
        $this->getModel()->where('merchant_id', $merchantId)->delete();
    }

    public function createNormalOpeningHours(array $days, int $merchantId): ?NormalOpeningHour
    {
        $merchant_hours = null;

        foreach ($days as $day_of_week => $day) {
            $openingHours =  $closingHours = null;
            if (isset($day['opening'])) {
                $openingHours = $day['opening']['hour'] . ':' . $day['opening']['minute'];
            }

            if (isset($day['closing'])) {
                $closingHours = $day['closing']['hour'] . ':' . $day['closing']['minute'];
            }

            $merchant_hours = $this->getModel()->create([
                'day_of_week' => $this->convertDayNameToInteger($day_of_week),
                'merchant_id' => $merchantId,
                'open_time' => $openingHours,
                'close_time' => $closingHours
            ]);
        }

        return $merchant_hours;
    }

    public function getBusinessHoursForMerchant(int $merchantId): Collection
    {
        return $this->getModel()
            ->where('merchant_id', $merchantId)
            ->where('is_delivery_hours', 1)
            ->get();
    }

    public function convertDayNameToInteger($name): ?int
    {
        switch ($name) {
            case 'monday':
                return 1;
            case 'tuesday':
                return 2;
            case 'wednesday':
                return 3;
            case 'thursday':
                return 4;
            case 'friday':
                return 5;
            case 'saturday':
                return 6;
            case 'sunday':
                return 7;
        }
        return null;
    }

    public function formatOpeningHoursForForm(Collection $openingHours): array
    {
        $formattedHours = [];

        $openingHours->each(function ($openingHour) use (&$formattedHours) {
            $formattedHours[$this->convertDayNumberToDayName($openingHour->day_of_week)] = [
                'opening' => [
                    'hour' => $openingHour->open_time->format('H'),
                    'minute' => $openingHour->open_time->format('i'),
                ],
                'closing' => [
                    'hour' => $openingHour->close_time->format('H'),
                    'minute' => $openingHour->close_time->format('i'),
                ],
            ];
        });

        return $formattedHours;
    }

    protected function convertDayNumberToDayName(int $dayInt): string
    {
        switch ($dayInt) {
            case 1:
            default:
                $day = 'monday';
                break;
            case 2:
                $day = 'tuesday';
                break;
            case 3:
                $day = 'wednesday';
                break;
            case 4:
                $day = 'thursday';
                break;
            case 5:
                $day = 'friday';
                break;
            case 6:
                $day = 'saturday';
                break;
            case 7:
                $day = 'sunday';
                break;
        }

        return $day;
    }

    protected function getModel(): NormalOpeningHour
    {
        return $this->model;
    }

    public function getTableServiceHoursForMerchant(Merchant $merchant): Collection
    {
        return $this->getModel()
            ->where('merchant_id', '=', $merchant->id)
            ->where('is_delivery_hours', '=', 0)
            ->get();
    }

    public function updateBusinessOpeningHoursByMerchant(Merchant $merchant, Collection $hours): bool
    {
        return $this->updateOpeningHoursByMerchantAndDeliveryHours($merchant, $hours, 1);
    }

    public function updateTableServiceHoursByMerchant(Merchant $merchant, Collection $hours): bool
    {
        return $this->updateOpeningHoursByMerchantAndDeliveryHours($merchant, $hours, 0);
    }

    /**
     * @param Merchant $merchant
     * @param Collection $hours
     * @param bool $deliveryHoursField
     * @return bool
     */
    protected function updateOpeningHoursByMerchantAndDeliveryHours(
        Merchant $merchant,
        Collection $hours,
        bool $deliveryHoursField
    ): bool {
        $hours = $hours->map(function ($hour) use ($merchant, $deliveryHoursField) {
            $hour['merchant_id'] = $merchant->id;
            $hour['is_delivery_hours'] = $deliveryHoursField;
            return $hour;
        });

        foreach ($hours as $hour) {
            $openingHour = NormalOpeningHour::firstOrCreate($hour);
            $openingHour->save();
        }

        return true;
    }
}

<?php

namespace App\Providers\Service;

use App\Contract\Repositories\NormalOpeningHoursContract as NormalOpeningHoursRepository;
use App\Contract\Service\NormalOpeningHoursContract;
use App\Service\NormalOpeningHoursService;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

class NormalOpeningHoursServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->bind(NormalOpeningHoursContract::class, function (Application $app) {
            $normalOpeningHoursRepository = $app->make(NormalOpeningHoursRepository::class);
            $logger = $app->make(LoggerInterface::class);

            return new NormalOpeningHoursService(
                $normalOpeningHoursRepository,
                $logger
            );
        });
    }
}

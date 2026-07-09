<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RedirectIfAuthenticated::redirectUsing(function () {
            return route('docs');
        });

        $this->configureAvatarsDisk();
        $this->configureDefaults();
    }

    /**
     * Laravel Cloud injects S3 credentials into its managed disks (public/cloud)
     * rather than as plain AWS_* env vars. Our custom "avatars" disk must inherit
     * those credentials, otherwise the AWS SDK falls back to the disabled EC2
     * instance-profile and uploads fail. We borrow a working managed S3 disk's
     * configuration and only override the root prefix and public URL.
     */
    protected function configureAvatarsDisk(): void
    {
        $source = null;

        foreach (['cloud', 'public', 's3'] as $name) {
            $disk = config("filesystems.disks.{$name}");

            if (is_array($disk) && ($disk['driver'] ?? null) === 's3' && ! empty($disk['key'])) {
                $source = $disk;
                break;
            }
        }

        if ($source === null) {
            return;
        }

        $avatars = array_merge($source, [
            'root' => 'avatars',
            'url' => rtrim((string) env('AWS_URL', ''), '/'),
        ]);

        unset($avatars['visibility']);

        config(['filesystems.disks.avatars' => $avatars]);
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}

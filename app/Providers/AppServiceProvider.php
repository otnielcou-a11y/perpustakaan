<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;
use App\Models\AppSetting;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Paksa scheme https supaya asset(), url(), dan route() tidak
        // menghasilkan URL http:// yang memicu "Mixed Content".
        if (config('app.force_https') && ! $this->app->runningInConsole()) {
            URL::forceScheme('https');
        }

        // URL /storage/ mengikuti host + scheme request yang sedang diakses.
        // Nilai config (berasal dari APP_URL) sering tertinggal memakai http://
        // sehingga browser menandai gambar sebagai "Mixed Content".
        if (! $this->app->runningInConsole() && request()->isSecure()) {
            config([
                'filesystems.disks.public.url' => rtrim(request()->root(), '/') . '/storage',
            ]);
        }

        // Pasang View Composer agar SELURUH halaman blade otomatis dapat $globalLogo
        View::composer('*', function ($view) {
            $logoUrl = null;
            $logoSize = '44';
            $logoFit = 'contain';

            try {
                if (Schema::hasTable('app_settings')) {
                    $settingLogo = AppSetting::where('key', 'site_logo')->value('value');
                    if ($settingLogo) {
                        $logoUrl = asset('storage/' . $settingLogo);
                    }
                    $logoSize = AppSetting::where('key', 'logo_size')->value('value') ?? '44';
                    $logoFit = AppSetting::where('key', 'logo_fit')->value('value') ?? 'contain';
                }
            } catch (\Exception $e) {
                // fallback aman jika database belum siap
            }

            $view->with('globalLogo', $logoUrl)
                 ->with('globalLogoSize', $logoSize)
                 ->with('globalLogoFit', $logoFit);
        });
    }
}

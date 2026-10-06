<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;
use App\Models\AppSetting;
use App\Support\PublicMedia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Cache pengaturan branding untuk request yang sedang berjalan.
     *
     * @var array<string, string|null>|null
     */
    private ?array $brandingCache = null;

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

        // Pasang View Composer agar SELURUH halaman blade otomatis dapat
        // $globalLogo, $globalLogoSize, dan $globalLogoFit.
        //
        // Composer '*' dipanggil untuk setiap view yang dirender, termasuk
        // setiap @include. Karena itu hasil pembacaan app_settings disimpan di
        // cache supaya query hanya jalan sekali per request.
        View::composer('*', function ($view) {
            foreach ($this->brandingSettings() as $key => $value) {
                $view->with($key, $value);
            }
        });
    }

    /**
     * Pengaturan branding (logo, ukuran, gaya) untuk view composer.
     *
     * @return array<string, string|null>
     */
    private function brandingSettings(): array
    {
        if ($this->brandingCache !== null) {
            return $this->brandingCache;
        }

        $this->brandingCache = [
            'globalLogo' => null,
            'globalLogoSize' => '44',
            'globalLogoFit' => 'contain',
        ];

        try {
            if (Schema::hasTable('app_settings')) {
                $settings = AppSetting::whereIn('key', ['site_logo', 'logo_size', 'logo_fit'])
                    ->pluck('value', 'key');

                // null bila berkas logo hilang, sehingga blade otomatis memakai
                // ikon bawaan alih-alih gambar rusak.
                $this->brandingCache['globalLogo'] = PublicMedia::url($settings->get('site_logo'));
                $this->brandingCache['globalLogoSize'] = $settings->get('logo_size') ?: '44';
                $this->brandingCache['globalLogoFit'] = $settings->get('logo_fit') ?: 'contain';
            }
        } catch (\Throwable $e) {
            // fallback aman jika database belum siap
        }

        return $this->brandingCache;
    }
}

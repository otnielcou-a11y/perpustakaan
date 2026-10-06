<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class PublicStorageTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
    }

    public function test_it_serves_a_file_from_an_allowed_folder(): void
    {
        Storage::disk('public')->put('avatars/abc.png', 'fake-image-bytes');

        $response = $this->get('/storage/avatars/abc.png');

        $response->assertOk();
        $this->assertSame('fake-image-bytes', $response->getFile()->getContent());
    }

    public function test_it_serves_nested_paths(): void
    {
        Storage::disk('public')->put('img/cover/perpus.jpeg', 'fake-cover');

        $this->get('/storage/img/cover/perpus.jpeg')->assertOk();
    }

    public function test_it_returns_404_for_missing_file(): void
    {
        $this->get('/storage/avatars/tidak-ada.png')->assertNotFound();
    }

    /**
     * Rute ini dijalankan sebagai cadangan tanpa symlink, jadi tidak boleh bisa
     * dipakai membaca berkas di luar disk publik.
     */
    public function test_it_blocks_path_traversal_attempts(): void
    {
        Storage::disk('public')->put('avatars/abc.png', 'fake-image-bytes');

        $traversals = [
            '/storage/avatars/../../.env',
            '/storage/avatars/%2e%2e%2f%2e%2e%2f.env',
            '/storage/avatars/..%2F..%2F.env',
            '/storage/../app/.env',
            '/storage/avatars/..',
            '/storage/avatars/%2e%2e',
        ];

        foreach ($traversals as $url) {
            $this->get($url)->assertNotFound();
        }
    }

    public function test_it_blocks_folders_outside_the_allowlist(): void
    {
        Storage::disk('public')->put('app/private.txt', 'rahasia');

        $this->get('/storage/app/private.txt')->assertNotFound();
    }

    public function test_it_does_not_serve_directories(): void
    {
        Storage::disk('public')->put('avatars/abc.png', 'fake-image-bytes');

        $this->get('/storage/avatars')->assertNotFound();
    }
}
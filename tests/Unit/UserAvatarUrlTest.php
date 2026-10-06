<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class UserAvatarUrlTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
    }

    public function test_avatar_url_is_null_when_column_is_empty(): void
    {
        $this->assertNull((new User(['avatar' => null]))->avatar_url);
    }

    public function test_avatar_url_points_to_public_disk_when_file_exists(): void
    {
        Storage::disk('public')->put('avatars/abc.png', 'binary');

        $url = (new User(['avatar' => 'avatars/abc.png']))->avatar_url;

        $this->assertNotNull($url);
        $this->assertStringEndsWith('/storage/avatars/abc.png', $url);
    }

    public function test_avatar_url_is_null_when_file_was_deleted_from_disk(): void
    {
        // Avatar menunjuk berkas yang hilang harus disembunyikan, bukan
        // dirender sebagai gambar rusak.
        $this->assertNull((new User(['avatar' => 'avatars/hilang.png']))->avatar_url);
    }

    public function test_avatar_url_passes_through_external_url(): void
    {
        $url = (new User(['avatar' => 'https://cdn.example.com/me.png']))->avatar_url;

        $this->assertSame('https://cdn.example.com/me.png', $url);
    }

    public function test_avatar_url_normalizes_prefixed_storage_path(): void
    {
        Storage::disk('public')->put('avatars/abc.png', 'binary');

        $url = (new User(['avatar' => '/storage/avatars/abc.png']))->avatar_url;

        $this->assertNotNull($url);
        $this->assertStringEndsWith('/storage/avatars/abc.png', $url);
    }

    public function test_avatar_url_rejects_path_traversal(): void
    {
        $this->assertNull((new User(['avatar' => '../../.env']))->avatar_url);
    }
}
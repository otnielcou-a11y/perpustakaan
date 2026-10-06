<?php

namespace Tests\Unit;

use App\Support\PublicMedia;
use Tests\TestCase;

class PublicMediaTest extends TestCase
{
    public function test_normalize_accepts_relative_public_disk_path(): void
    {
        $this->assertSame('avatars/abc.png', PublicMedia::normalize('avatars/abc.png'));
    }

    public function test_normalize_strips_leading_slash_and_storage_prefix(): void
    {
        $this->assertSame('avatars/abc.png', PublicMedia::normalize('/avatars/abc.png'));
        $this->assertSame('avatars/abc.png', PublicMedia::normalize('storage/avatars/abc.png'));
        $this->assertSame('avatars/abc.png', PublicMedia::normalize('\avatars\abc.png'));
    }

    public function test_normalize_rejects_traversal_and_empty_values(): void
    {
        $this->assertNull(PublicMedia::normalize(null));
        $this->assertNull(PublicMedia::normalize(''));
        $this->assertNull(PublicMedia::normalize('   '));
        $this->assertNull(PublicMedia::normalize('avatars/../../.env'));
        $this->assertNull(PublicMedia::normalize('avatars/./abc.png'));
        $this->assertNull(PublicMedia::normalize('avatars//abc.png'));
        $this->assertNull(PublicMedia::normalize("avatars/abc\0.png"));
        $this->assertNull(PublicMedia::normalize('storage/'));
    }

    public function test_is_external_detects_absolute_and_protocol_relative_urls(): void
    {
        $this->assertTrue(PublicMedia::isExternal('https://cdn.example.com/a.png'));
        $this->assertTrue(PublicMedia::isExternal('http://cdn.example.com/a.png'));
        $this->assertTrue(PublicMedia::isExternal('//cdn.example.com/a.png'));
        $this->assertFalse(PublicMedia::isExternal('avatars/abc.png'));
        $this->assertFalse(PublicMedia::isExternal(null));
    }

    public function test_folder_allowlist_blocks_other_directories(): void
    {
        $this->assertTrue(PublicMedia::isAllowedFolder('avatars/a.png'));
        $this->assertTrue(PublicMedia::isAllowedFolder('covers/a.png'));
        $this->assertTrue(PublicMedia::isAllowedFolder('branding/a.png'));
        $this->assertTrue(PublicMedia::isAllowedFolder('img/cover/a.png'));

        $this->assertFalse(PublicMedia::isAllowedFolder('app/private.txt'));
        $this->assertFalse(PublicMedia::isAllowedFolder('framework/cache/data/a'));
        $this->assertFalse(PublicMedia::isAllowedFolder('a.png'));
    }

    public function test_url_returns_external_url_untouched(): void
    {
        $this->assertSame(
            'https://cdn.example.com/a.png',
            PublicMedia::url('https://cdn.example.com/a.png')
        );
    }

    public function test_url_is_null_when_file_is_missing(): void
    {
        $this->assertNull(PublicMedia::url('avatars/tidak-ada.png'));
        $this->assertNull(PublicMedia::url(null));
    }

    public function test_url_is_null_for_disallowed_folder(): void
    {
        $this->assertNull(PublicMedia::url('app/private.txt'));
    }
}
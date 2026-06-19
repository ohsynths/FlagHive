<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Writeup;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'ohsynthz',
            'email' => 'ohsynthz@example.com',
            'is_admin' => true,
        ]);

        $categories = collect([
            ['name' => 'Web', 'slug' => 'web'],
            ['name' => 'Pwn', 'slug' => 'pwn'],
            ['name' => 'Reverse', 'slug' => 'reverse'],
            ['name' => 'Crypto', 'slug' => 'crypto'],
            ['name' => 'Forensics', 'slug' => 'forensics'],
            ['name' => 'Misc', 'slug' => 'misc'],
            ['name' => 'OSINT', 'slug' => 'osint'],
        ])->map(fn ($c) => Category::create($c));

        Writeup::create([
            'user_id' => $user->id,
            'category_id' => $categories->firstWhere('slug', 'web')->id,
            'ctf' => 'HackTheBox Cyber Apocalypse 2025',
            'title' => 'Kryptos Support',
            'slug' => 'kryptos-support',
            'description' => 'A web challenge involving SSTI in a support ticket system.',
            'content' => "# Kryptos Support\n\n## Recon\n\nExploring the support ticket system...\n\n```python\nprint('solve')\n```\n\n## Flag\n\n`HTB{fake_flag}`",
        ]);

        Writeup::create([
            'user_id' => $user->id,
            'category_id' => $categories->firstWhere('slug', 'crypto')->id,
            'ctf' => 'PicoCTF 2025',
            'title' => 'RSA Oracle',
            'slug' => 'rsa-oracle',
            'description' => 'Exploiting a padding oracle in a custom RSA implementation.',
            'content' => "# RSA Oracle\n\n## Analysis\n\nThe oracle leaks the parity of the decrypted ciphertext...\n\n## Solution\n\n```python\nfrom pwn import *\n```",
        ]);

        Writeup::create([
            'user_id' => $user->id,
            'category_id' => $categories->firstWhere('slug', 'pwn')->id,
            'ctf' => 'DEF CON CTF Quals 2025',
            'title' => 'Format String Follies',
            'slug' => 'format-string-follies',
            'description' => 'A format string vulnerability in a binary running on a remote server.',
            'content' => "# Format String Follies\n\n## Vulnerability\n\nThe binary uses `printf` with user input directly...\n\n## Exploit\n\n```c\n%p.%p.%p\n```",
        ]);
    }
}

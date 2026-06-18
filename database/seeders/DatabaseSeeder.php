<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ctf;
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

        $ctfs = collect([
            ['name' => 'HackTheBox Cyber Apocalypse 2025', 'slug' => 'htb-cyber-apocalypse-2025', 'year' => 2025],
            ['name' => 'DEF CON CTF Quals 2025', 'slug' => 'defcon-ctf-quals-2025', 'year' => 2025],
            ['name' => 'PicoCTF 2025', 'slug' => 'picoctf-2025', 'year' => 2025],
        ])->map(fn ($c) => Ctf::create($c));

        Writeup::create([
            'user_id' => $user->id,
            'category_id' => $categories->firstWhere('slug', 'web')->id,
            'ctf_id' => $ctfs->firstWhere('slug', 'htb-cyber-apocalypse-2025')->id,
            'title' => 'Kryptos Support',
            'slug' => 'kryptos-support',
            'description' => 'A web challenge involving SSTI in a support ticket system.',
            'content' => '# Kryptos Support\n\n## Recon\n...',
        ]);

        Writeup::create([
            'user_id' => $user->id,
            'category_id' => $categories->firstWhere('slug', 'crypto')->id,
            'ctf_id' => $ctfs->firstWhere('slug', 'picoctf-2025')->id,
            'title' => 'RSA Oracle',
            'slug' => 'rsa-oracle',
            'description' => 'Exploiting a padding oracle in a custom RSA implementation.',
            'content' => '# RSA Oracle\n\n## Analysis\n...',
        ]);

        Writeup::create([
            'user_id' => $user->id,
            'category_id' => $categories->firstWhere('slug', 'pwn')->id,
            'ctf_id' => $ctfs->firstWhere('slug', 'defcon-ctf-quals-2025')->id,
            'title' => 'Format String Follies',
            'slug' => 'format-string-follies',
            'description' => 'A format string vulnerability in a binary running on a remote server.',
            'content' => '# Format String Follies\n\n## Vulnerability\n...',
        ]);
    }
}

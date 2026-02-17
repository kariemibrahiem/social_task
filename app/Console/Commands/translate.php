<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Stichoza\GoogleTranslate\GoogleTranslate;

class Translate extends Command
{
    protected $signature = 'translate:scan';
    protected $description = 'Scan project files for trns("...") and add missing translations to ar/file.php';

    public function handle()
    {
        $this->info("🔍 Scanning project for trns() keys...");

        $directories = [
            base_path('app'),
            base_path('resources/views'),
            base_path('routes'),
        ];

        $allKeys = [];

        foreach ($directories as $dir) {
            $files = File::allFiles($dir);

            foreach ($files as $file) {
                $content = File::get($file->getRealPath());

                preg_match_all('/trns\(\s*[\'"]([^\'"]+)[\'"]\s*\)/', $content, $matches);

                if (!empty($matches[1])) {
                    foreach ($matches[1] as $key) {
                        $allKeys[$key] = $key;
                    }
                }
            }
        }

        if (empty($allKeys)) {
            $this->warn("⚠️ No trns() keys found!");
            return;
        }

        $langFile = resource_path('lang/ar/file.php');

        if (!File::exists($langFile)) {
            File::put($langFile, "<?php\n\nreturn [\n];");
        }

        $translations = include($langFile);

        $tr = new GoogleTranslate('ar');
        $tr->setSource('en');

        $newKeys = 0;
        foreach ($allKeys as $key) {
            if (!array_key_exists($key, $translations)) {
                try {
                    $translated = $tr->translate($key);
                    $translations[$key] = $translated;
                    $this->info("➕ Added: {$key} => {$translated}");
                } catch (\Exception $e) {
                    $translations[$key] = $key; 
                    $this->error("⚠️ Failed to translate: {$key}");
                }
                $newKeys++;
            }
        }

        $content = "<?php\n\nreturn [\n";
        foreach ($translations as $k => $v) {
            $content .= "    '" . addslashes($k) . "' => '" . addslashes($v) . "',\n";
        }
        $content .= "];\n";

        File::put($langFile, $content);

        $this->info("✅ Added {$newKeys} new keys. Total keys: " . count($translations));
        $this->info("📂 Updated: lang/ar/file.php");
    }
}

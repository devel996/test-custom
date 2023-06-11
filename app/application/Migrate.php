<?php

declare(strict_types=1);

namespace app\application;


class Migrate
{
    public function run(): void
    {
        $modulesDirectory = __DIR__ . '/../modules';
        $moduleFolders = scandir($modulesDirectory);

        foreach ($moduleFolders as $moduleFolder) {
            if ($moduleFolder === '.' || $moduleFolder === '..') {
                continue;
            }

            $moduleMigrationsFolder = "{$modulesDirectory}/{$moduleFolder}/migrations";
            $migrationFiles = scandir($moduleMigrationsFolder);

            foreach ($migrationFiles as $file) {
                if ($file === '.' || $file === '..') {
                    continue;
                }

                $fullFile = $moduleMigrationsFolder . '/' . $file;

                if (file_exists($fullFile)) {
                    $class = require $fullFile;

                    $class->migrate();
                }

                sleep(3);
            }
        }
    }
}
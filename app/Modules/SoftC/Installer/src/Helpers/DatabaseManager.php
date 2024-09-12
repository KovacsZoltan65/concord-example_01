<?php

namespace SoftC\Installer\Helpers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use SoftC\Installer\Database\Seeders\DatabaseSeeder as SoftCDatabaseSeeder;

class DatabaseManager
{
    public function isInstalled(): bool {
        if( !file_exists(base_path('.env')) ) {
            return false;
        }

        try {
            DB::connection()->getPdo();

            $isConnected = (bool) DB::connection()->getDatabaseName();
            if( !$isConnected ) {
                return false;
            }

            $hasPersonTable = Schema::hasTable('persons');
            if ( ! $hasPersonTable ) {
                return false;
            }

            $personCount = DB::table('persons')->count();
            if (! $personCount) {
                return false;
            }

            return true;
        } catch( Exception $e ) {
            return false;
        }
    }

    public function migration(): JsonResponse
    {
        try {
            Artisan::call('migrate:fresh');

            return response()->json([
                'success' => true,
                'message' => 'A táblák áttelepítése sikeresen megtörtént.',
            ]);
        } catch( Exception $e ) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function seeder($data)
    {
        try {
            app(SoftCDatabaseSeeder::class)->run([
                'default_locale'     => $data['parameter']['default_locales'],
                'default_currency'   => $data['parameter']['default_currency'],
            ]);

            $this->storageLink();
        } catch( Exception $e ) {
            return $e->getMessage();
        }
    }

    private function storageLink()
    {
        Artisan::call('storage:link');
    }

    public function generateKey()
    {
        try {
            Artisan::call('key:generate');
        } catch (Exception $e) {
        }
    }
}
<?php

namespace SoftC\Installer\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use SoftC\Installer\Helpers\DatabaseManager;
use SoftC\Installer\Helpers\EnvironmentManager;
use SoftC\Installer\Helpers\ServerRequirements;

class InstallerController extends Controller
{
    const MIN_PHP_VERSION = '8.1.0';

    const USER_ID = 1;

    public function __construct(
        protected ServerRequirements $serverRequirements,
        protected EnvironmentManager $environmentManager,
        protected DatabaseManager $databaseManager
    ) {}

    public function index()
    {
        $phpVersion = $this->serverRequirements->checkPHPversion(self::MIN_PHP_VERSION);

        $requirements = $this->serverRequirements->validate();

        if (request()->has('locale')) {
            return redirect()->route('installer.index');
        }

        return view('installer::installer.index', compact('requirements', 'phpVersion'));
    }

    public function envFileSetup(Request $request): JsonResponse
    {
        $message = $this->environmentManager->generateEnv($request);

        return new JsonResponse(['data' => $message]);
    }

    public function runMigration(): mixed
    {
        return $this->databaseManager->migration();
    }

    public function runSeeder()
    {
        $allParameters = request()->allParameters;

        $parameter = [
            'parameter' => [
                'default_locales'    => $allParameters['app_locale'] ?? null,
                'default_currency'   => $allParameters['app_currency'] ?? null,
            ],
        ];

        $response = $this->environmentManager->setEnvConfiguration(request()->allParameters);

        if ($response) {
            $seeder = $this->databaseManager->seeder($parameter);

            return $seeder;
        }
    }

    public function adminConfigSetup(): bool
    {
        $password = password_hash(request()->input('password'), PASSWORD_BCRYPT, ['cost' => 10]);

        try {
            DB::table('users')->updateOrInsert(
                [
                    'id' => self::USER_ID,
                ], [
                    'name'     => request()->input('admin'),
                    'email'    => request()->input('email'),
                    'password' => $password,
                    'role_id'  => 1,
                    'status'   => 1,
                ]
            );

            $this->smtpConfigSetup();

            return true;
        } catch (\Throwable $th) {
            report($th);

            return false;
        }
    }

    private function smtpConfigSetup()
    {
        $filePath = storage_path('installed');

        File::put($filePath, 'Your Krayin App is Successfully Installed');

        Event::dispatch('krayin.installed');

        return $filePath;
    }
}
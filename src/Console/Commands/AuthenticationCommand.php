<?php

namespace Luckys\BasicAithentication\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\AppNamespaceDetectorTrait;

class AuthenticationCommand extends Command
{
    use AppNamespaceDetectorTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'luckys:auth {scaffold_for? : make scaffold for admin or frontend or both options admin, frontend, both} {--views : Only scaffold the authentication views}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold basic login and registration views and routes';

    /**
     * The views that need to be exported.
     *
     * @var array
     */
    protected $views = [
        'auth/login.stub' => 'auth/login.blade.php',
        'auth/register.stub' => 'auth/register.blade.php',
        'auth/passwords/email.stub' => 'auth/passwords/email.blade.php',
        'auth/passwords/reset.stub' => 'auth/passwords/reset.blade.php',
        'auth/emails/password.stub' => 'auth/emails/password.blade.php',
        'layouts/app.stub' => 'layouts/app.blade.php',
        'home.stub' => 'home.blade.php',
        'welcome.stub' => 'welcome.blade.php',
    ];

    /**
     * The admin views that need to be exported.
     *
     * @var array
     */
    protected $adminViews = [
        'admin/auth/login.stub' => 'admin/auth/login.blade.php',
        'admin/auth/register.stub' => 'admin/auth/register.blade.php',
        'admin/auth/passwords/email.stub' => 'admin/auth/passwords/email.blade.php',
        'admin/auth/passwords/reset.stub' => 'admin/auth/passwords/reset.blade.php',
        'admin/auth/emails/password.stub' => 'admin/auth/emails/password.blade.php',
        'layouts/admin.stub' => 'layouts/admin.blade.php',
        'admin/home.stub' => 'admin/home.blade.php',
        'admin/welcome.stub' => 'admin/welcome.blade.php',
    ];

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $type = $this->argument('scaffold_for');
        
        $this->frontendScaffolding($type);
        $this->adminScaffolding($type);

        /*if (! $this->option('views')) {
            $this->info('Installed HomeController.');

            file_put_contents(
                app_path('Http/Controllers/HomeController.php'),
                $this->compileControllerStub()
            );

            $this->info('Updated Routes File.');

            file_put_contents(
                app_path('Http/routes.php'),
                file_get_contents(__DIR__.'/stubs/make/routes.stub'),
                FILE_APPEND
            );
        }*/

        $this->comment('Authentication scaffolding generated successfully!');
    }

    /**
     * create files for frontend authentication
     * 
     * @param  $type: string of type frontend or both.
     * @return true.
     */
    protected function frontendScaffolding($type = null)
    {
        if($type == 'both' || $type == 'frontend' || $type == null) {

            $this->createDirectories();
            $this->exportViews();

            // migrate controllers.
            if(!$this->option('views')) {

                $this->info('Installed HomeController.');

                file_put_contents(
                    app_path('Http/Controllers/HomeController.php'),
                    $this->compileHomeControllerStub()
                );
            }
        }

        return true;
    }

    /**
     * create files for admin authentication
     * 
     * @param  $type: string of type admin or both.
     * @return true.
     */
    protected function adminScaffolding($type = null)
    {
        if($type == 'admin' || $type == 'both' || $type == null) {
            
            $this->createAdminDirectories();
            $this->exportAdminViews();

            // migrate controllers.
            if(!$this->option('views')) {

                $this->info('Installed AuthAdminController and PasswordAdminController.');

                file_put_contents(
                    app_path('Http/Controllers/Auth/AuthAdminController.php'),
                    $this->compileAuthAdminControllerStub()
                );

                file_put_contents(
                    app_path('Http/Controllers/Auth/PasswordAdminController.php'),
                    $this->compilePasswordAdminControllerStub()
                );
            }
        }

        return true;
    }

    /**
     * Create the directories for the files.
     *
     * @return void
     */
    protected function createDirectories()
    {
        if (! is_dir(base_path('resources/views/layouts'))) {
            mkdir(base_path('resources/views/layouts'), 0755, true);
        }

        if (! is_dir(base_path('resources/views/auth/passwords'))) {
            mkdir(base_path('resources/views/auth/passwords'), 0755, true);
        }

        if (! is_dir(base_path('resources/views/auth/emails'))) {
            mkdir(base_path('resources/views/auth/emails'), 0755, true);
        }
    }

    /**
     * Export the authentication views.
     *
     * @return void
     */
    protected function exportViews()
    {
        foreach ($this->views as $key => $value) {
            $path = base_path('resources/views/'.$value);

            $this->line('<info>Created View:</info> '.$path);

            copy(__DIR__.'/stubs/make/views/'.$key, $path);
        }
    }

    /**
     * Compiles the HomeController stub.
     *
     * @return string
     */
    protected function compileHomeControllerStub()
    {
        return str_replace(
            '{{namespace}}',
            $this->getAppNamespace(),
            file_get_contents(__DIR__.'/stubs/make/controllers/HomeController.stub')
        );
    }

    /**
     * Compiles the AuthAdminController stub.
     *
     * @return string
     */
    protected function compileAuthAdminControllerStub()
    {
        return str_replace(
            '{{namespace}}',
            $this->getAppNamespace(),
            file_get_contents(__DIR__.'/stubs/make/controllers/AuthAdminController.stub')
        );
    }

    /**
     * Compiles the PasswordAdminController stub.
     *
     * @return string
     */
    protected function compilePasswordAdminControllerStub()
    {
        return str_replace(
            '{{namespace}}',
            $this->getAppNamespace(),
            file_get_contents(__DIR__.'/stubs/make/controllers/PasswordAdminController.stub')
        );
    }

    /**
     * Create the admin directories for the files.
     *
     * @return void
     */
    protected function createAdminDirectories()
    {
        
        if (! is_dir(base_path('resources/views/admin/auth/passwords'))) {
            mkdir(base_path('resources/views/admin/auth/passwords'), 0755, true);
        }

        if (! is_dir(base_path('resources/views/admin/auth/emails'))) {
            mkdir(base_path('resources/views/admin/auth/emails'), 0755, true);
        }

        if (! is_dir(base_path('resources/views/layouts'))) {
            mkdir(base_path('resources/views/layouts'), 0755, true);
        }
    }

    /**
     * Export the admin authentication views.
     *
     * @return void
     */
    protected function exportAdminViews()
    {
        foreach ($this->adminViews as $key => $value) {
            $path = base_path('resources/views/'.$value);

            $this->line('<info>Created View:</info> '.$path);

            copy(__DIR__.'/stubs/make/views/'.$key, $path);
        }
    }
}

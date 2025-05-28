<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Example: Employee::class => EmployeePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Admin memiliki semua hak akses tanpa pengecekan tambahan
        Gate::before(function (User $user, string $ability) {
            return $user->hasRole('admin') ? true : null;
        });

        // USER permissions
        $this->definePermission('user');

        // EMPLOYEE permissions
        $this->definePermission('employee');

        // SKILL permissions
        $this->definePermission('skill');

        // PROFIL PERUSAHAAN permissions
        $this->definePermission('profil_perusahaan');

        // LAYANAN permissions
        $this->definePermission('layanan');
    }

    /**
     * Definisikan permission CRUD untuk resource.
     */
    private function definePermission(string $resource): void
    {
        $actions = ['read', 'create', 'edit', 'delete'];

        foreach ($actions as $action) {
            Gate::define("{$action}-{$resource}", function (User $user) use ($action, $resource) {
                return $user->can("{$action}-{$resource}");
            });
        }
    }
}

<?php

namespace GoFunCrm\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'GoFunCrm\Model' => 'GoFunCrm\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

	    Gate::resource('users', 'GoFunCrm\Policies\UserPolicy');
	    Gate::define('users.reset_password', 'GoFunCrm\Policies\UserPolicy@reset_password');
	    Gate::define('users.view_users', 'GoFunCrm\Policies\UserPolicy@view_users');

	    Gate::define('tasks.visitations_not_assigned', 'GoFunCrm\Policies\TaskPolicy@visitations_not_assigned');
	    Gate::define('tasks.visitations_assigned', 'GoFunCrm\Policies\TaskPolicy@visitations_assigned');
	    Gate::define('tasks.assigned_tasks', 'GoFunCrm\Policies\TaskPolicy@assigned_tasks');

	    Gate::resource('roles', 'GoFunCrm\Policies\RolePolicy');
	    Gate::resource('business_groups', 'GoFunCrm\Policies\BusinessGroupPolicy');
	    Gate::resource('business_owners', 'GoFunCrm\Policies\BusinessOwnerPolicy');
	    Gate::resource('franchises', 'GoFunCrm\Policies\FranchiseGroupPolicy');
	    Gate::resource('sites', 'GoFunCrm\Policies\SitePolicy');
	    Gate::resource('events', 'GoFunCrm\Policies\EventPolicy');
	    Gate::resource('invoices', 'GoFunCrm\Policies\InvoicePolicy');
	    Gate::resource('stock_sold', 'GoFunCrm\Policies\StockPolicy');
	    Gate::resource('set_date_flag', 'GoFunCrm\Policies\SetDateFlagPolicy');

    }
}

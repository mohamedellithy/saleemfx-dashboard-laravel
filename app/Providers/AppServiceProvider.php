<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use App\VipOrder;
use App\ServicesOrder;
use App\BalanceWithdraw;
use App\WalletRechargeOrder;
use App\FileOrder;
use App\DirectrixOrder;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        Schema::defaultStringLength(125);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        //


        Gate::define('manage-item', function ($user) {
           return $user->isAdmin();
        });


        Gate::define('manage-item-as-user', function ($user) {
           return $user->isUser();
        });
        
        Gate::define('manage-item-as-affiliater', function ($user) {
           return $user->isAffiliater();
        });
        
        Gate::define('manage-item-as-employee', function ($user) {
           return $user->isEmployee();
        });
        
        

        Gate::define('service_ordered',function ($user) {
            return true;
        });

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $count_vip_order        = VipOrder::where('status',0)->count();
            $count_services_order   = ServicesOrder::where('status',0)->count();
            $count_withdraw_order   = BalanceWithdraw::where(['status'=>0,'withdrawable_type'=>'App\User'])->count();
            $count_recharge_order   = WalletRechargeOrder::where('status',0)->count();
            $order_download_experts = FileOrder::where('status',0)->count();
            $order_download_directrix = DirectrixOrder::where('status',0)->count();
            $event->menu->add([
                'text'    => ' طلبات VIP',
                'icon'    => 'fas fa-user-shield',
                'label'       => $count_vip_order > 0 ? $count_vip_order : '',
                'label_color' => $count_vip_order > 0 ? 'danger' : '',
                'can'     => "manage-item",
                'submenu' => [
                    [
                        'text' => 'عرض طلبات VIP',
                        'icon_color' => 'red',
                        'url'  => 'vip-services'
                    ]
                ]
            ],
            [
                'text'    => 'طلبات الخدمات',
                'icon'    => 'fas fa-box',
                'label'       => $count_services_order > 0 ? $count_services_order : '',
                'label_color' => $count_services_order > 0 ? 'danger' : '',
                'can'     => "manage-item",
                'submenu' => [
                    [
                        'text' => 'عرض طلبات الخدمات',
                        'icon_color' => 'red',
                        'url'  => 'services-orders',
                    ]
                ]
            ],
            [
                'text'    => 'طلبات السحب الارصدة ',
                'icon'    => 'fas fa-coins',
                'label'       => $count_withdraw_order > 0 ? $count_withdraw_order : '',
                'label_color' => $count_withdraw_order > 0 ? 'danger' : '',
                'can'     => "manage-item",
                'submenu' => [
                    [
                        'text' => 'الطلبات المعلقة',
                        'icon_color' => 'green',
                        'label'       => $count_withdraw_order > 0 ? $count_withdraw_order : '',
                        'label_color' => $count_withdraw_order > 0 ? 'danger' : '',
                        'url'  => 'withdraw-orders/pending',
                    ],
                    [
                        'text' => 'الطلبات الاخري',
                        'icon_color' => 'green',
                        'url'  => 'withdraw-orders/others',
                    ]
                ]
            ],
            [
                'text'    => 'طلبات شحن المحافظ',
                'icon'    => 'fas fa-wallet',
                'label'       => $count_recharge_order > 0 ? $count_recharge_order : '',
                'label_color' => $count_recharge_order > 0 ? 'danger' : '',
                'can'     => "manage-item",
                'submenu' => [
                    [
                        'text' => 'عرض الطلبات',
                        'icon_color' => 'red',
                        'url'  => 'wallet-recharge-orders',
                    ]
                ]
            ],[
                'text'    => 'طلبات تحميل الاكسبرتات',
                'icon'    => 'fas fa-wallet',
                'label'       => $order_download_experts > 0 ? $order_download_experts : '',
                'label_color' => $order_download_experts > 0 ? 'danger' : '',
                'can'     => "manage-item",
                'submenu' => [
                    [
                        'text' => 'عرض الطلبات',
                        'icon_color' => 'red',
                        'url'  => 'experts-files-orders',
                    ]
                ]
            ],
            [
                'text'    => 'طلبات مؤشرات سليم',
                'icon'    => 'fas fa-wallet',
                'label'       => $order_download_directrix > 0 ? $order_download_directrix : '',
                'label_color' => $order_download_directrix > 0 ? 'danger' : '',
                'can'     => "manage-item",
                'submenu' => [
                    [
                        'text' => 'عرض الطلبات',
                        'icon_color' => 'red',
                        'url'  => 'directrix-files-orders',
                    ]
                ]
            ]);

        });
    }
}

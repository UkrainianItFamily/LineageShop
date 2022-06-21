<?php

namespace App\Providers;

use App\Repositories\SupportRequestMessage\SupportRequestMessageRepository;
use App\Repositories\SupportRequestMessage\SupportRequestMessageRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Chat\ChatRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Message\MessageRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Chat\ChatRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\EmailToken\EmailTokenRepository;
use App\Repositories\UserRating\UserRatingRepository;
use App\Repositories\UserWallet\UserWalletRepository;
use App\Repositories\Message\MessageRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\SupportRequest\SupportRequestRepository;
use App\Repositories\EmailToken\EmailTokenRepositoryInterface;
use App\Repositories\UserWallet\UserWalletRepositoryInterface;
use App\Repositories\UserRating\UserRatingRepositoryInterface;
use App\Repositories\FinanceOperation\FinanceOperationRepository;
use App\Repositories\SupportRequest\SupportRequestRepositoryInterface;
use App\Repositories\FinanceOperation\FinanceOperationRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        CategoryRepositoryInterface::class => CategoryRepository::class,
        ProductRepositoryInterface::class => ProductRepository::class,
        UserRepositoryInterface::class => UserRepository::class,
        MessageRepositoryInterface::class => MessageRepository::class,
        ChatRepositoryInterface::class => ChatRepository::class,
        FinanceOperationRepositoryInterface::class => FinanceOperationRepository::class,
        UserWalletRepositoryInterface::class => UserWalletRepository::class,
        UserRatingRepositoryInterface::class => UserRatingRepository::class,
        SupportRequestRepositoryInterface::class => SupportRequestRepository::class,
        EmailTokenRepositoryInterface::class => EmailTokenRepository::class,
        OrderRepositoryInterface::class => OrderRepository::class,
        SupportRequestMessageRepositoryInterface::class => SupportRequestMessageRepository::class
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}

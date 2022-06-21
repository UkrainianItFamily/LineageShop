<?php

use App\Http\Controllers\Api\SocialiteAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\UserWalletController;
use App\Http\Controllers\Api\UserRatingController;
use App\Http\Controllers\Api\WalletTypeController;
use App\Http\Controllers\Api\SupportRequestController;
use App\Http\Controllers\Api\FinanceOperationsController;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('verified-email', [AuthController::class, 'emailVerification']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('forgot-password', [AuthController::class, 'sendLinkForgotPassword']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
    });
});

Route::prefix('/administration')->group(function () {
    Route::middleware(['AuthorizationChecker', 'IsAdministratorChecker'])->group(function () {
        Route::get('/users', [UserController::class, 'getAllUsers']);
        Route::post('/support-requests', [SupportRequestController::class, 'getSupportRequestsByCriteria']);
        Route::patch('/admin-reset-user-password', [UserController::class, 'adminResetUserPassword']);
        Route::patch('/change-user-data', [UserController::class, 'changeUserData']);
    });
});

Route::prefix('/categories')->group(
    function () {
        Route::get('/', [CategoryController::class, 'getCategories']);

        Route::middleware('AuthorizationChecker')->group(function () {
            Route::get('/by-user-id/{userId?}', [CategoryController::class, 'getCategoriesWithProductsForUser']);
        });

        Route::get('/{id}', [CategoryController::class, 'getCategoryById']);
    }
);

Route::prefix('/products')->group(
    function () {
        Route::get('', [ProductController::class, 'getProductsByCategoryId']);
        Route::patch('/{productId}', [ProductController::class, 'toggleActive']);

        Route::middleware('AuthorizationChecker')->group(function () {
            Route::get('/get-products-for-user', [ProductController::class, 'getProductsForUser']);
            Route::post('', [ProductController::class, 'create']);
            Route::put('/{productId}', [ProductController::class, 'update']);
            Route::delete('/{productId}', [ProductController::class, 'delete']);
        });

        Route::get('/{productId}', [ProductController::class, 'edit']);
    }
);

Route::prefix('/messages')->group(
    function () {
        Route::middleware('AuthorizationChecker')->group(function () {
            Route::get('/get-messages-by-chat-id/{chatId}', [MessageController::class, 'getMessagesByChatId']);
            Route::post('', [MessageController::class, 'addMessage']);
        });
    }
);

Route::prefix('/chats')->group(
    function () {
        Route::middleware('AuthorizationChecker')->group(function () {
            Route::get('/get-chats-by-current-user', [ChatController::class, 'getChatsByCurrentUser']);
            Route::get('/get-chat-by-user-id/{userId}', [ChatController::class, 'getChatByUserId']);
            Route::post('', [ChatController::class, 'create']);
            Route::get('/{chatId}', [ChatController::class, 'getChatById']);
        });
    }
);

Route::prefix('/finance-operations')->group(
    function () {
        Route::middleware('AuthorizationChecker')->group(function () {
            Route::get('', [FinanceOperationsController::class, 'getFinanceOperationsForCurrentUser']);
            Route::post('', [FinanceOperationsController::class, 'create']);
            Route::get('/{financeOperationsId}', [FinanceOperationsController::class, 'getFinanceOperationById']);
            Route::put('/{financeOperationsId}', [FinanceOperationsController::class, 'changeFinanceOperationStatusToCancel']);
            Route::patch('/change-finance-operation-status', [FinanceOperationsController::class, 'changeFinanceOperationStatus']);
        });
    }
);

Route::prefix('/administration')->group(function () {
    Route::middleware(['AuthorizationChecker', 'IsAdministratorChecker'])->group(function () {
        Route::get('/finance-operations/get-all', [FinanceOperationsController::class, 'getAllFinanceOperations']);
    });
});

Route::group(
    [
        'prefix' => '/wallet-types',
    ],
    function () {
        Route::get('', [WalletTypeController::class, 'getWalletTypes']);
    }
);

Route::group(
    [
        'prefix' => 'properties',
    ],
    function () {
        Route::get('', [PropertyController::class, 'getPropertyByCategoryId']);
        Route::get('properties', [PropertyController::class, 'getPropertyByCategoryId']);
    }
);

Route::prefix('/user-wallets')->group(
    function () {
        Route::middleware('AuthorizationChecker')->group(function () {
            Route::get('', [UserWalletController::class, 'getUserWalletsForCurrentUser']);
            Route::get('/by-wallet-type-id/{walletTypeId}', [UserWalletController::class, 'getUserWalletsByWalletTypeId']);
            Route::post('/', [UserWalletController::class, 'save']);
            Route::put('/', [UserWalletController::class, 'update']);
            Route::delete('/{userWalletId}', [UserWalletController::class, 'delete']);
        });
    }
);

Route::prefix('/orders')->group(
    function () {
        Route::middleware('AuthorizationChecker')->group(function () {
            Route::get('purchases', [OrderController::class, 'getPurchasesForCurrentUser']);
            Route::get('sales', [OrderController::class, 'getSalesForCurrentUser']);
            Route::post('', [OrderController::class, 'create']);
            Route::get('/{orderId}', [OrderController::class, 'getOrderById']);
            Route::patch('/confirm-order', [OrderController::class, 'confirmOrderById']);
        });
    }
);

Route::group(
    [
        'prefix' => '/users',
    ],
    function () {
        Route::get('/change-verify', [UserController::class, 'updateEmailByUserId']);
        Route::get('/{userId}', [UserController::class, 'getUserById']);
    }
);

Route::group(
    [
        'prefix' => 'administration',
    ],
    function () {
        Route::middleware('AuthorizationChecker')->group(function () {
            Route::get('/users', [UserController::class, 'getAllUsers']);
            Route::patch('/users/admin-reset-user-password', [UserController::class, 'adminResetUserPassword']);
            Route::patch('/change-user-data', [UserController::class, 'changeUserData']);
            Route::get('/orders', [OrderController::class, 'getAllOrders']);
            Route::patch('/orders/change-order-status', [OrderController::class, 'changeOrderStatus']);
            Route::post('/bind-email', [UserController::class, 'bindEmail']);
            Route::patch('/change-password', [UserController::class, 'changePassword']);
            Route::patch('/toggle-current-user-email-notification', [UserController::class, 'toggleCurrentUserEmailNotification']);
        });
    }
);

Route::prefix('/user-ratings')->group(
    function () {
        Route::middleware('AuthorizationChecker')->group(function () {
            Route::get('/{userId?}', [UserRatingController::class, 'getUserRatingByUserId']);
        });
    }
);

Route::group(
    [
        'prefix' => 'support-request',
    ],
    function () {
        Route::post('', [SupportRequestController::class, 'sendSupportRequest']);
    }
);
Route::middleware('AuthorizationChecker')->group(function () {
    Route::post('/support-requests', [SupportRequestController::class, 'getSupportRequestsByCriteriaForUser']);
    Route::get('/support-request/{id}', [SupportRequestController::class, 'getSupportRequest']);
    Route::get('/support-request-messages/{id}', [SupportRequestController::class, 'getAllSupportRequestMessages']);
    Route::post('/send-support-request-message', [SupportRequestController::class, 'sendSupportRequestMessage']);
    Route::patch('/support-request/status-update', [SupportRequestController::class, 'updateSupportStatusRequest']);
});
Route::get('/status/{serviceName?}', [StatusController::class, 'status']);

Route::prefix('/')->group( function(){
    Route::get('/{providerName}/auth', [SocialiteAuthController::class, 'authUserFromSocialite']);
    Route::get('/{providerName}/callback', [SocialiteAuthController::class, 'addUserFromSocialite']);
});

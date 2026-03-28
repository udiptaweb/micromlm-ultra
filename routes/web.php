<?php

use App\Http\Controllers\Admin\MlmDocsController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\CryptoPaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Seo\SeoController;
use Illuminate\Support\Facades\Auth;


Route::view('/', 'landing')->name('welcome');
Route::view('/portfolio', 'welcome');
Route::middleware(['auth', 'mlm.verified'])->group(function () {
    Route::view('dashboard', 'dashboard')
        ->name('dashboard');

    Route::get('genealogy', \App\Livewire\Genealogy::class)
        ->name('genealogy');

    Route::get('commissions', \App\Livewire\Commissions::class)
        ->name('commissions');

    Route::view('profile', 'profile')
        ->name('profile');
    Route::view('wallet', 'wallets')
        ->name('wallets');
    Route::get('request-withdraw', \App\Livewire\Member\Wallet\RequestWithdraw::class)
        ->name('wallets.request-withdraw');
    Route::get('products', \App\Livewire\Member\ProductCatalog::class)
        ->name('product.catalog');
    Route::get('products/{id}', \App\Livewire\Member\ProductShow::class)
        ->name('member.products.show');
    Route::get('product-checkout/{productId}', \App\Livewire\Member\Checkout::class)
        ->name('member.product.checkout');
    Route::get('payment/crypto/webhook', [CryptoPaymentController::class, 'webhook'])->name('payment.crypto.webhook');
    Route::get('my-purchases', \App\Livewire\Member\MyPurchases::class)
        ->name('member.purchases');
    //E-PIN
    Route::get('e-pin-request', \App\Livewire\Member\EPin\EPinRequest::class)
        ->name('member.epin.request');
    Route::get('/my-epins', App\Livewire\Member\MyEPins::class)->name('member.epins');

    Route::get('/wallet/payout-info', \App\Livewire\Member\Wallet\ManagePayoutInfo::class)
        ->middleware('auth')->name('member.payout-info');
    Route::get('profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/settings/theme', function () {
        request()->validate(['theme' => 'required|in:obsidian,arctic,ember,forest,sapphire,luxe']);
        session(['mlm_theme' => request('theme')]);
        return back();
    })->name('theme.set');

    Route::get(
        '/member/{userId}/profile',
        \App\Livewire\Member\MemberProfile::class
    )
        ->name('member.profile');

    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});

Route::middleware(['auth', 'can:admin-access'])->group(function () {
    Route::get('/admin/users', \App\Livewire\Admin\Users\UsersList::class)
        ->name('admin.users.index');
    Route::get('/admin/users/create', \App\Livewire\Admin\Users\CreateUser::class)
        ->name('admin.users.create');
    Route::get('/admin/users/{userId}/edit', \App\Livewire\Admin\Users\EditUser::class)
        ->name('admin.users.edit');
    Route::get('/admin/user-commissions', \App\Livewire\Admin\Commission\UserCommissions::class)->name('admin.user-commissions');

    Route::get('/admin/withdraw-requests', \App\Livewire\Member\Wallet\WithdrawRequests::class)->name('admin.withdraw-requests');

    Route::get('/admin/products/create', \App\Livewire\Admin\Products\CreateProduct::class)
        ->name('admin.products.create');
    Route::get('/admin/products', \App\Livewire\Admin\Products\IndexProducts::class)
        ->name('admin.products.index');
    Route::get('/admin/products/{product}/edit', \App\Livewire\Admin\Products\EditProduct::class)
        ->name('admin.products.edit');
    //e-pin
    Route::get('/admin/manage-epin-requests', \App\Livewire\Admin\ManageEPinRequests::class)
        ->name('admin.e-pins.requests');
    Route::get('/admin/e-pins', \App\Livewire\Admin\EPinInventory::class)->name('admin.e-pins');
    Route::get('/admin/theme-settings', [ThemeController::class, 'themeSelect'])->name('admin.theme-settings');
    Route::get('/admin/mlm-settings', \App\Livewire\Admin\MlmSettings::class)
        ->name('admin.mlm-settings');
    Route::get('/admin/mlm-docs', [MlmDocsController::class, 'index'])
        ->name('admin.mlm-docs');
    Route::get('/admin/placements', \App\Livewire\Admin\ManagePlacements::class)
        ->name('admin.placements');
});


//seo
Route::get('/sitemap.xml', [SeoController::class, 'index']);

Route::get('/pricing', [SeoController::class, 'pricing'])->name('website.pricing');
Route::get('/features', [SeoController::class, 'features'])->name('website.features');
Route::get('/contact', [SeoController::class, 'contact'])->name('website.contact');

Route::get('/binary-plan', [SeoController::class, 'binaryPlan'])->name('website.binary-plan');
Route::get('/unilevel-plan', [SeoController::class, 'unilevelPlan'])->name('website.unilevel-plan');
Route::get('/matrix-plan', [SeoController::class, 'matrixPlan'])->name('website.matrix-plan');

Route::get('/blog/legality-of-mlm-in-india', [SeoController::class, 'legalityOfMlmInIndia'])
    ->name('website.blog.legality-of-mlm-in-india');

Route::get('/blog/how-to-select-best-mlm-software', [SeoController::class, 'howToSelectBestMlmSoftware'])
    ->name('website.blog.how-to-select-best-mlm-software');

Route::get('/mlm-software-in-guwahati', [SeoController::class, 'mlmSoftwareGuwahati'])
    ->name('website.mlm-guwahati');

Route::get('/mlm-software-in-kolkata', [SeoController::class, 'mlmSoftwareKolkata'])
    ->name('website.mlm-kolkata');

Route::get('/mlm-software-in-assam', [SeoController::class, 'mlmSoftwareAssam'])
    ->name('website.mlm-assam');

Route::get('/mlm-software-in-india', [SeoController::class, 'mlmSoftwareIndia'])
    ->name('website.mlm-india');

Route::get('/mlm-software', [SeoController::class, 'mlmSoftware'])
    ->name('website.mlm-software');

Route::get('/custom-mlm-software', [SeoController::class, 'customMlmSoftware'])
    ->name('website.custom-mlm-software');

Route::get('/buy-mlm-software', [SeoController::class, 'buyMlmSoftware'])
    ->name('website.buy-mlm-software');

Route::get('/network-marketing-software', [SeoController::class, 'networkMarketingSoftware'])
    ->name('website.network-marketing-software');

Route::get('/mlm-software-development', [SeoController::class, 'mlmSoftwareDevelopment'])
    ->name('website.mlm-software-development');


require __DIR__ . '/auth.php';

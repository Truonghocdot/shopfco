# ShopFCO - Core Documentation

## 📦 Models

Tất cả các Models đã được tạo với đầy đủ relationships, helper methods và constants:

### User Model

- **Relationships**: wallet, transactions, couponUsages
- **Methods**: `isAdmin()`, `isActive()`, `canAccessPanel()`
- **Fields**: name, email, phone, password, role, status

### Wallet Model

- **Relationships**: user
- **Methods**: `addBalance()`, `subtractBalance()`, `hasEnoughBalance()`
- **Fields**: user_id, balance

### Transaction Model

- **Constants**: TYPE*\*, SERVICE*_, STATUS\__
- **Relationships**: user, couponUsages
- **Methods**: `isPending()`, `isSuccess()`, `isFailed()`, `markAsSuccess()`, `markAsFailed()`

### Product Model

- **Constants**: TYPE*ACCOUNT, TYPE_EXTRA, STATUS*\*
- **Relationships**: category
- **Methods**: `isSold()`, `markAsSold()`, `getDiscountPercent()`, `getFinalPrice()`

### Category Model

- **Relationships**: products
- **Fields**: title, slug, description, image, meta_title, meta_description

### News Model

- **Constants**: STATUS_DRAFT, STATUS_PUBLISHED
- **Methods**: `isPublished()`, `incrementViewCount()`, `publish()`, `unpublish()`
- **Scopes**: `published()`, `latest()`

### Service Model

- **Constants**: STATUS_INACTIVE, STATUS_ACTIVE
- **Methods**: `isActive()`, `incrementUsedCount()`, `activate()`, `deactivate()`
- **Scopes**: `active()`, `popular()`

### Coupon Model

- **Constants**: DISCOUNT*PERCENTAGE, DISCOUNT_FIXED, STATUS*\*
- **Relationships**: usages
- **Methods**:
    - `isActive()`, `isExpired()`, `hasReachedLimit()`
    - `canBeUsedBy(User $user, float $orderAmount)` - Validate coupon
    - `calculateDiscount(float $orderAmount)` - Calculate discount amount
    - `incrementUsage()` - Increment usage count
- **Scopes**: `active()`

### CouponUsage Model

- **Relationships**: coupon, user, transaction
- **Fields**: coupon_id, user_id, transaction_id, discount_amount, used_at

### Setting Model

- **Static Methods**:
    - `Setting::get($key, $default)` - Get setting value
    - `Setting::set($key, $value)` - Set setting value
    - `Setting::has($key)` - Check if setting exists
    - `Setting::forget($key)` - Delete setting
    - `Setting::getAllSettings()` - Get all settings as array
    - `Setting::clearCache()` - Clear settings cache

## 🛠️ Utilities

### Helper Class (`App\Utilts\Helper`)

**Currency & Numbers:**

- `formatCurrency(float $amount, bool $showSymbol = true)` - Format VND currency
- `formatNumber(int $number)` - Format with K, M, B suffixes

**String Manipulation:**

- `generateCode(int $length = 8, string $prefix = '')` - Generate unique code
- `generateSlug(string $text)` - Generate URL-friendly slug (Vietnamese support)
- `removeVietnameseTones(string $str)` - Remove Vietnamese accents
- `truncate(string $text, int $length = 100)` - Truncate text

**Data Masking:**

- `maskPhone(string $phone)` - Mask phone number (0123\*\*\*789)
- `maskEmail(string $email)` - Mask email (ab\*\*\*@domain.com)

**Validation:**

- `isValidPhone(string $phone)` - Validate Vietnamese phone number
- `isJson(string $string)` - Check if string is valid JSON

**Date/Time:**

- `formatDateTime($datetime, string $format = 'd/m/Y H:i')` - Format datetime
- `timeAgo($datetime)` - Get relative time in Vietnamese (2 giờ trước)

**Utilities:**

- `randomString(int $length = 10)` - Generate random string
- `formatFileSize(int $bytes)` - Human readable file size
- `getClientIp()` - Get client IP address
- `getUserAgent()` - Get user agent string

### Caching Class (`App\Utilts\Caching`)

**Basic Cache Operations:**

- `get(string $key, $default = null)` - Get cached value
- `put(string $key, $value, ?int $ttl = null)` - Store value
- `forever(string $key, $value)` - Store forever
- `remember(string $key, callable $callback, ?int $ttl = null)` - Get or store
- `has(string $key)` - Check if exists
- `forget(string $key)` - Delete value
- `flush()` - Clear all cache

**Specialized Cache:**

- `cacheUser(int $userId, $data, int $ttl = 3600)` - Cache user data
- `getCachedUser(int $userId)` - Get cached user
- `forgetUser(int $userId)` - Clear user cache
- `cacheSetting(string $key, $value)` - Cache setting
- `cacheProducts(array $products)` - Cache products list
- `cacheCategories(array $categories)` - Cache categories

**Lock Mechanism:**

- `lock(string $key, int $seconds = 10)` - Acquire lock
- `unlock(string $key)` - Release lock
- `withLock(string $key, callable $callback)` - Execute with lock

### Logger Class (`App\Utilts\Logger`)

**Basic Logging:**

- `info(string $message, array $context = [])` - Log info
- `error(string $message, array $context = [])` - Log error
- `warning(string $message, array $context = [])` - Log warning
- `debug(string $message, array $context = [])` - Log debug
- `exception(Throwable $exception, array $context = [])` - Log exception

**Specialized Logging:**

- `userActivity(int $userId, string $action, array $data = [])` - Log user activity
- `transaction(int $transactionId, string $status, array $data = [])` - Log transaction
- `payment(string $provider, string $action, array $data = [])` - Log payment
- `auth(string $event, int $userId = null, array $data = [])` - Log auth events
- `security(string $event, array $data = [])` - Log security events
- `couponUsage(string $couponCode, int $userId, float $discountAmount)` - Log coupon usage
- `productPurchase(int $productId, int $userId, float $amount)` - Log purchase
- `walletTransaction(...)` - Log wallet transactions

**Advanced:**

- `channel(string $channel, string $level, string $message, array $context = [])` - Log to custom channel
- `critical()`, `alert()`, `emergency()` - Critical level logging

## 🌐 Global Helper Functions

File `app/helpers.php` cung cấp các hàm global tiện lợi:

```php
// Currency & Numbers
format_currency(100000); // "100.000đ"
format_number(1500000); // "1.5M"

// String
generate_code(8, 'ORDER'); // "ORDER-ABC12345"
generate_slug('Sản phẩm mới'); // "san-pham-moi"

// Masking
mask_phone('0123456789'); // "012***789"
mask_email('user@example.com'); // "us***@example.com"

// Validation
is_valid_phone('0123456789'); // true

// Time
time_ago($datetime); // "2 giờ trước"

// Cache
cache_get('key');
cache_put('key', 'value', 3600);
cache_remember('key', fn() => expensive_operation());

// Logging
log_activity($userId, 'login');
log_transaction($transactionId, 'success');
log_exception($exception);
```

## 📝 Usage Examples

### Using Coupon System

```php
use App\Models\Coupon;
use App\Models\User;

$coupon = Coupon::where('code', 'SUMMER2024')->first();
$user = User::find(1);
$orderAmount = 500000;

// Validate coupon
$validation = $coupon->canBeUsedBy($user, $orderAmount);
if ($validation['valid']) {
    // Calculate discount
    $discount = $coupon->calculateDiscount($orderAmount);
    $finalAmount = $orderAmount - $discount;

    // Record usage
    $coupon->incrementUsage();
    CouponUsage::create([
        'coupon_id' => $coupon->id,
        'user_id' => $user->id,
        'discount_amount' => $discount,
    ]);
}
```

### Using Wallet System

```php
use App\Models\Wallet;

$wallet = Wallet::where('user_id', $userId)->first();

// Add balance
$wallet->addBalance(100000);

// Check and subtract
if ($wallet->hasEnoughBalance(50000)) {
    $wallet->subtractBalance(50000);
}
```

### Using Settings

```php
use App\Models\Setting;

// Get setting
$siteName = Setting::get('site_name', 'ShopFCO');

// Set setting
Setting::set('site_name', 'My Shop');

// Get all settings
$allSettings = Setting::getAllSettings();
```

### Using Cache

```php
use App\Utilts\Caching;

// Cache products for 30 minutes
$products = Caching::remember('products_list', function() {
    return Product::with('category')->get();
}, 1800);

// Lock mechanism for race conditions
Caching::withLock('process_payment', function() {
    // Process payment safely
}, 10);
```

### Using Logger

```php
use App\Utilts\Logger;

// Log user activity
Logger::userActivity($userId, 'purchase_product', [
    'product_id' => $productId,
    'amount' => $amount
]);

// Log exception
try {
    // Some code
} catch (\Exception $e) {
    Logger::exception($e, ['context' => 'payment_processing']);
}
```

## 🔐 Constants

### UserRole (Enum)

```php
use App\Constants\UserRole;

UserRole::CLIENT->value; // 0
UserRole::ADMIN->value; // 1
```

### Transaction Types

```php
Transaction::TYPE_SCRATCH_CARD; // 0
Transaction::TYPE_BANK; // 1
Transaction::SERVICE_TOPUP; // 0
Transaction::SERVICE_BUY_ACCOUNT; // 1
Transaction::STATUS_PENDING; // 0
Transaction::STATUS_SUCCESS; // 1
Transaction::STATUS_FAILED; // 2
```

### Product Types

```php
Product::TYPE_ACCOUNT; // 1
Product::TYPE_EXTRA; // 2
Product::STATUS_UNSOLD; // 0
Product::STATUS_SOLD; // 1
```

### Coupon Types

```php
Coupon::DISCOUNT_PERCENTAGE; // 1
Coupon::DISCOUNT_FIXED; // 2
Coupon::STATUS_INACTIVE; // 0
Coupon::STATUS_ACTIVE; // 1
```

## 🎯 Best Practices

1. **Always use Helper methods** cho formatting để đảm bảo consistency
2. **Use Caching** cho các queries phức tạp hoặc dữ liệu ít thay đổi
3. **Log important events** như transactions, authentication, errors
4. **Use Model constants** thay vì magic numbers
5. **Validate data** trước khi lưu vào database
6. **Use relationships** thay vì manual joins
7. **Cache settings** để tránh query database nhiều lần

## 📚 Next Steps

- Implement API Controllers
- Create Filament Resources for admin panel
- Add validation rules
- Create Form Requests
- Implement payment gateways
- Add email notifications
- Create frontend views

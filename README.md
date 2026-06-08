# 🍱 FoodSaver — Management Web Application for Food Leftovers

**KULLIYYAH OF INFORMATION TECHNOLOGY AND COMMUNICATION**
**INTERNATIONAL ISLAMIC UNIVERSITY MALAYSIA (IIUM)**

| | |
|---|---|
| **Course** | WEB APPLICATION DEVELOPMENT (BIIT 2305) |
| **Semester** | II, 2025/2026 |
| **Section** | 5 |
| **Instructor** | DR. NAJHAN BIN MUHAMAD IBRAHIM |
| **Live Website** | https://food-management-production.up.railway.app/ |

---

## Group Members

| Name | Matric Number |
|---|---|
| AZIZUL HAKIM BIN AWANG ABDUL RAHIM | 2419087 |
| MUHAMMAD FARIHIN BIN JOHAR | 2410499 |
| NADHIRATUL INSYIRAH BINTI ESMADI | 2411198 |
| NAUFA BINTI MOHD YAZID | 2413304 |

---

## Table of Contents

1. [Executive Summary](#10-executive-summary)
2. [Problem Statement](#20-problem-statement)
3. [System Design](#30-system-design)
4. [Technical Implementation](#40-technical-implementation)
5. [User Interface Design](#50-user-interface-design)
6. [System Testing](#60-system-testing)
7. [Challenges and Solutions](#70-challenges-and-solutions)
8. [Conclusion](#80-conclusion)
9. [References](#references)

---

## 1.0 Executive Summary

### 1.1 Project Overview

FoodSaver is a centralized web application developed using the Laravel Model-View-Controller (MVC) framework. The main purpose of the system is to help reduce food waste in Malaysia by connecting food providers with consumers through a real-time digital platform. Food businesses such as restaurants, hotels, home bakers, and catering services can use the platform to share surplus food with people who are looking for affordable or free food options.

The system was built using **Laravel 10.x (PHP 8.1+)**, **MySQL** for database management, the **Blade templating engine** for dynamic web pages, and **Bootstrap 5** to ensure a responsive and user-friendly interface.

Instead of relying on informal methods such as social media posts or word-of-mouth communication, FoodSaver provides a more organized and reliable platform for food redistribution. The system benefits both vendors and buyers while supporting Islamic values by encouraging responsible consumption, reducing waste (Israf), and promoting community welfare.

### 1.2 Objectives Achieved

The project successfully achieved its main objectives:

-  Developed a complete food surplus management system using the Laravel MVC framework, allowing vendors to create, view, update, and delete food listings through a full CRUD implementation.
-  Implemented a secure authentication system with three user roles: Vendors, Buyers, and Admin. Each role has its own dashboard and access permissions.
-  Enabled buyers to view available surplus food listings in real time, replacing informal communication channels.
-  Streamlined the food redistribution process by allowing vendors to post surplus food while buyers can browse, reserve, and cancel reservations.
-  Successfully deployed the system on Railway and completed the final documentation.

---

## 2.0 Problem Statement

### 2.1 Problem Background

Food waste in Malaysia has become a serious issue that requires immediate attention from both the public and private sectors. Based on data from the **Solid Waste Management and Public Cleansing Corporation (SWCorp)**, around **17,000 tonnes** of food waste are generated every day nationwide. What is more concerning is that about **4,005 tonnes** of this food are still edible, which could potentially feed around **2.9 million people** with three meals a day.

There is currently no proper centralized system that effectively connects food providers with people who need affordable or free food. As a result, both sides face difficulties. Businesses struggle to redistribute excess food, while consumers miss out on opportunities to access it.

### 2.2 Problem Statement

Food surplus management in Malaysia is still largely unstructured and inefficient. This situation leads to several key issues:

- **Food wastage is still widespread** — Without a proper redistribution system, large amounts of edible food are thrown away every day, contributing to environmental damage, economic loss, and social inequality.
- **Poor information access** — Consumers have no centralized or real-time source to check available surplus food nearby.
- **Low operational efficiency** — Many food businesses do not have proper digital tools to manage, track, or distribute their surplus food effectively.

### 2.3 Project Objectives

1. To develop a functional food surplus management system using the Laravel MVC framework, including full CRUD features.
2. To implement a secure authentication system separating users into Vendor, Buyer, and Admin roles.
3. To enable buyers to view available surplus food listings in real time from nearby businesses.
4. To streamline and automate the food redistribution process through a structured reservation system.
5. To prepare a complete final report documenting the system design, implementation, and functionality.

### 2.4 Project Scope

**Included features:**
- User Registration and Authentication (Vendor, Buyer, Admin)
- Food Listing Management with full CRUD operations
- Buyer Browsing, Filtering, and Reservation
- Role-Based Access Control (RBAC)
- Admin Panel for platform management

**Not included (future improvements):**
- Payment gateway integration
- Mobile application development
- Delivery logistics management

---

## 3.0 System Design

### 3.1 Entity Relationship Diagram (ERD)

```
+----------------+     +------------------+     +----------------+
|     users      |     |  food_listings   |     |  reservations  |
+----------------+     +------------------+     +----------------+
| id (PK)        |1  N | id (PK)          |1  N | id (PK)        |
| name           |-----| vendor_id (FK)   |-----| listing_id(FK) |
| email          |     | title            |     | buyer_id (FK)  |
| password       |     | description      |     | status         |
| role           |     | quantity         |     | reserved_at    |
| phone          |     | price            |     | created_at     |
| address        |     | category         |     | updated_at     |
| created_at     |     | expiry_time      |     +----------------+
| updated_at     |     | pickup_location  |
+----------------+     | image            |
                        | status           |
                   +----------------+      | created_at       |
                   |   categories   |      | updated_at       |
                   +----------------+      +------------------+
                   | id (PK)        |
                   | name           |
                   | created_at     |
                   | updated_at     |
                   +----------------+
```

The FoodSaver database consists of four main tables. The **users** table is the core of the platform, storing account credentials and role assignments. The **food_listings** table manages surplus food inventory and maintains a one-to-many relationship with users through `vendor_id`. The **reservations** table links buyers to listings via `buyer_id` and `listing_id` foreign keys. The **categories** table provides standardized classification for food items.

**Key relationships:**
- A User (vendor) can have many Food Listings (one-to-many)
- A Food Listing can have many Reservations (one-to-many)
- A User (buyer) can make many Reservations (one-to-many)
- A Food Listing belongs to one Category (many-to-one)

### 3.2 System Sequence Diagram

**Vendor — Post a Food Listing**

```
Vendor        Browser         Laravel Router    Controller       Database
  |               |                 |                |               |
  |-- Login ----->|                 |                |               |
  |               |-- POST /login ->|                |               |
  |               |                 |-- AuthCtrl --> |               |
  |               |                 |                |-- Query ----->|
  |               |                 |                |<-- User Data -|
  |<-- Dashboard -|                 |                |               |
  |               |                 |                |               |
  |-- Add Listing>|                 |                |               |
  |               |-- POST /listings>               |               |
  |               |                 |-- ListingCtrl->|               |
  |               |                 |                |-- Insert ---->|
  |               |                 |                |<-- Success ---|
  |<-- Confirm ---|                 |                |               |
```

**Buyer — Browse and Reserve Food**

```
Buyer         Browser         Laravel Router    Controller       Database
  |               |                 |                |               |
  |-- Browse ---->|                 |                |               |
  |               |-- GET /listings>|                |               |
  |               |                 |-- ListingCtrl->|               |
  |               |                 |                |-- Query ----->|
  |               |                 |                |<-- Listings --|
  |<-- View List -|                 |                |               |
  |               |                 |                |               |
  |-- Reserve --->|                 |                |               |
  |               |-- POST /reserve>|                |               |
  |               |                 |-- ReservCtrl ->|               |
  |               |                 |                |-- Insert ---->|
  |               |                 |                |<-- Success ---|
  |<-- Confirm ---|                 |                |               |
```

### 3.3 System Architecture Overview

FoodSaver follows the standard Laravel MVC architecture:

```
Browser → Routes (web.php) → Middleware (Auth/Role) → Controller
    ↓
Model (Eloquent) ↔ MySQL Database
    ↓
Blade View (.blade.php) → HTML Response → Browser
```

---

## 4.0 Technical Implementation

### 4.1 Models & Database Migrations

FoodSaver uses four Eloquent models: **User**, **FoodListing**, **Reservation**, and **Category**.

The **User** model extends `Authenticatable` and supports three roles via helper methods:
```php
public function isVendor(): bool { return $this->role === 'vendor'; }
public function isBuyer(): bool  { return $this->role === 'buyer'; }
public function isAdmin(): bool  { return $this->role === 'admin'; }
```

**Eloquent Relationships:**

| Model | Relationship | Target |
|---|---|---|
| User (vendor) | hasMany | FoodListing (via vendor_id) |
| User (buyer) | hasMany | Reservation (via buyer_id) |
| FoodListing | belongsTo | User (vendor) |
| FoodListing | belongsTo | Category |
| FoodListing | hasMany | Reservation |
| Reservation | belongsTo | FoodListing (via listing_id) |
| Reservation | belongsTo | User (buyer via buyer_id) |

**Migration — food_listings table:**

```php
Schema::create('food_listings', function (Blueprint $table) {
    $table->id();
    $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade');
    $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
    $table->string('title');
    $table->text('description')->nullable();
    $table->unsignedInteger('quantity');
    $table->decimal('price', 8, 2)->default(0);
    $table->string('pickup_location');
    $table->timestamp('expiry_time')->nullable();
    $table->string('image')->nullable();
    $table->enum('status', ['available','reserved','claimed','expired'])->default('available');
    $table->timestamps();
});
```

### 4.2 Routes Configuration

Routes are organized into four groups in `routes/web.php`:

```php
// Public
Route::get('/', fn () => view('welcome'))->name('home');

// Vendor — resource route with role middleware
Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    Route::resource('listings', VendorController::class)->names([...]);
});

// Buyer — manual routes with role middleware
Route::middleware(['auth', 'role:buyer'])->prefix('buyer')->name('buyer.')->group(function () {
    Route::get('/listings', [BuyerController::class, 'index'])->name('listings.index');
    Route::post('/reserve/{listing}', [ReservationController::class, 'store'])->name('reserve');
    Route::patch('/reservations/{id}/cancel', [ReservationController::class, 'cancel']);
});

// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('users.destroy');
});
```

### 4.3 Controllers & CRUD Logic

The `VendorController` handles all CRUD operations. Key example — the `store()` method:

```php
public function store(Request $request)
{
    $data = $request->validate([
        'title'           => 'required|string|max:255',
        'description'     => 'nullable|string',
        'quantity'        => 'required|integer|min:1',
        'price'           => 'required|numeric|min:0',
        'category_id'     => 'nullable|exists:categories,id',
        'pickup_location' => 'required|string|max:500',
        'expiry_time'     => 'nullable|date|after:now',
        'image'           => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('listings', 'public');
    }

    $data['vendor_id'] = Auth::id();
    FoodListing::create($data);

    return redirect()->route('vendor.listings.index')->with('success', 'Listing created.');
}
```

- **Read:** `index()` paginates vendor's own listings (10/page) with eager-loaded categories. `show()` includes reservation and buyer details.
- **Update:** Validates new data, replaces old image via `Storage::disk('public')->delete()`, scoped to vendor's own listings.
- **Delete:** Removes listing and image; cascade rules auto-delete linked reservations.

### 4.4 User Authentication & Security

FoodSaver uses a **custom session-based authentication** system without third-party packages.

- `RegisterController` validates 6 fields: name, email (unique), password (min 8, confirmed), role (vendor/buyer), phone, address.
- `LoginController` uses `Auth::attempt()` and regenerates session ID to prevent session fixation.
- **Role-Based Access Control** is enforced by a custom `RoleMiddleware`:

```php
public function handle(Request $request, Closure $next, string $role): Response
{
    if (!$request->user() || $request->user()->role !== $role) {
        abort(403, 'Unauthorized.');
    }
    return $next($request);
}
```

### 4.5 Views & Blade Template Engine

All views extend a single master layout at `resources/views/layouts/app.blade.php`.

The navbar adapts dynamically based on user role:

```blade
@auth
    @if(auth()->user()->isVendor())
        <a href="{{ route('vendor.listings.index') }}">My Listings</a>
        <a href="{{ route('vendor.listings.create') }}">Add Listing</a>
    @elseif(auth()->user()->isBuyer())
        <a href="{{ route('buyer.listings.index') }}">Browse Food</a>
        <a href="{{ route('buyer.reservations') }}">My Reservations</a>
    @endif
@endauth
```

The buyer feed uses `@forelse` to handle empty states, and `@if` to conditionally show the Reserve button only for available listings.

---

## 5.0 User Interface Design

### 5.1 Use of Media

- **Dynamic Food Images** — Uploaded via Laravel Storage and served from `public/listings/`
- **Categorization Badges** — Color-coded Bootstrap `.badge` components pulled from the categories table
- **Status Indicators** — Color-coded pills (🟢 available, 🟡 reserved, ⚫ expired)
- **Bootstrap Icons** — `bi-geo-alt` for location, `bi-clock` for expiry, `bi-person` for profile

![Buyer Feed](screenshots/buyer-feed.png)
*Image 5.1 — Buyer Browse and Reserve Food*

### 5.2 Design, Colour Scheme & Layout

| Token | Value | Usage |
|---|---|---|
| Forest Green | `oklch(28% 0.075 153)` | Navbar, primary buttons |
| Amber | `oklch(48% 0.14 145)` | Navbar accent, reserved badges |
| White / Cream | `#ffffff` | Page and card backgrounds |
| Dark | `oklch(14% 0.009 46)` | Body text |
| Danger Red | `oklch(55% 0.22 27)` | Delete buttons, errors |

**Typography:** DM Serif Display (headings) + Outfit (body copy) via Google Fonts.

**Layout:** Bootstrap 5 mobile-first grid — 3 columns on desktop, 2 on tablet, 1 on mobile.

![Landing Page](screenshots/landing.png)
*Image 5.2.1 — Guest Landing Page*

![Vendor Dashboard](screenshots/vendor-dashboard.png)
*Image 5.2.2 — Vendor Dashboard*

### 5.3 Navigation & Links

The navbar is controlled globally via `layouts/app.blade.php` and changes based on session state:

- **Guest Mode** — Logo, Login, Join Free buttons
- **Vendor Mode** — My Listings, + Post Food, profile dropdown
- **Buyer Mode** — Browse Food, My Reservations, profile dropdown
- **Admin Mode** — Dashboard, Users, Listings, profile dropdown
- **Fallback** — Unauthorized access to `/vendor/*` or `/buyer/*` returns HTTP 403

![Guest Nav](screenshots/nav-guest.png)
*Image 5.3.1 — Guest Navigation*

![Vendor Nav](screenshots/nav-vendor.png)
*Image 5.3.2 — Vendor Navigation*

![Buyer Nav](screenshots/nav-buyer.png)
*Image 5.3.3 — Buyer Navigation*

### 5.4 UI Walkthrough

**Landing Page**

![Landing](screenshots/landing.png)
*Image 5.4.1 — Landing Page*

Hero section with bold "Less Waste. More Meals." headline, stats (17,000 / 4,005 / 2.9M), and CTA buttons to register as Vendor or Buyer.

---

**Registration & Login Page**

![Register](screenshots/register.png)
*Image 5.4.2 — Registration and Login Page*

Clean card layout with role selector (Vendor / Buyer), full validation, and inline error messages.

---

**Vendor Dashboard**

![Vendor Dashboard](screenshots/vendor-dashboard.png)
*Image 5.4.3 — Vendor Dashboard*

Displays all vendor listings in a table with status, quantity, category, and Edit / Delete actions.

---

**Post New Listing**

![Post Listing](screenshots/post-listing.png)
*Image 5.4.4 — Post New Listing*

Form with title, description, quantity, price, category, expiry date-time picker, pickup location, and image upload.

---

**Buyer Feed Page**

![Buyer Feed](screenshots/buyer-feed.png)
*Image 5.4.5 — Buyer Feed Page*

Card grid of available listings with search bar, category filter, expiry countdowns, and Reserve buttons.

---

**Reservation Page**

![Reservation](screenshots/reservation.png)
*Image 5.4.6 — Reservation Page*

Detail view showing item info, vendor, pickup location, expiry, and a prominent Reserve Now button.

---

**Admin Panel**

![Admin](screenshots/admin.png)
*Image 5.4.7 — Admin Panel*

Stats dashboard (total users, listings, reservations) with Manage Users and Manage Listings tables including Remove actions.

---

## 6.0 System Testing

### 6.1 Test Cases Table

| Test No. | Feature Tested | Test Input | Expected Result | Actual Result | Status |
|---|---|---|---|---|---|
| T-01 | User Registration (Vendor) | Valid details, role = Vendor | Account created, redirected to Vendor Dashboard | Account created, redirected to Vendor Dashboard | ✅ PASS |
| T-02 | User Authentication | Correct credentials | Session initialized, redirected to role dashboard | Authenticated and redirected correctly | ✅ PASS |
| T-03 | Create Food Listing | Valid inputs + image upload | Image stored in public/listings, DB row inserted | Item created and visible on vendor list | ✅ PASS |
| T-04 | Form Validation (Expiry) | Past expiry date | Validation error via `after:now` rule | "The expiry time must be a date after now." shown | ✅ PASS |
| T-05 | Update Food Listing | Edit item + new image | Old image deleted, DB row updated | Listing updated, old image replaced | ✅ PASS |
| T-06 | Delete Food Listing | Delete active item | DB entry removed, linked reservations cascade deleted | Listing deleted, database integrity preserved | ✅ PASS |
| T-07 | Browse Food Listings | Buyer accesses feed | Available items queried with eager-loaded categories | Items displayed with no N+1 query lag | ✅ PASS |
| T-08 | Reserve Food Item | Buyer clicks Reserve | Reservation row inserted, listing status → reserved | Reservation recorded, status updated | ✅ PASS |
| T-09 | Duplicate Reservation Prevention | Rapid double-click Reserve | `whereIn('status', ['pending','confirmed'])->exists()` blocks it | Second request blocked, flash error shown | ✅ PASS |
| T-10 | Unauthorised Access | Buyer accesses `/vendor/listings` | RoleMiddleware blocks request | HTTP 403 Unauthorized returned | ✅ PASS |
| T-11 | Mobile Responsiveness | Resize to mobile viewport | Grid stacks vertically, navbar collapses | Elements wrap cleanly, touch points functional | ✅ PASS |

### 6.2 Deployment Verification

**Live URL:** https://food-management-production.up.railway.app/

Deployed on **Railway Cloud** with a cloud-hosted MySQL database. Production environment variables configured:

- `APP_ENV=production` and `APP_DEBUG=false`
- `APP_KEY` generated via `php artisan key:generate`
- `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` mapped to Railway MySQL instance
- `FILESYSTEM_DISK=public` with `php artisan storage:link` executed on the server

---

## 7.0 Challenges and Solutions

### 7.1 Technical Challenges

**1. Role-Based Access Control Implementation**
Restricting buyers from accessing vendor routes required custom middleware. Resolved by implementing `RoleMiddleware` that checks the user's role on every protected request and returns a 403 on mismatch.

**2. Foreign Key Constraint Errors**
Early migrations failed when dropping or modifying linked tables. Resolved by using `Schema::disableForeignKeyConstraints()` and carefully ordering migration files by timestamp.

**3. Deployment Environment Differences**
Moving from local XAMPP to Railway introduced config mismatches (database credentials, storage paths). Resolved by updating `.env` for production, reconfiguring Railway MySQL credentials, and rerunning `php artisan migrate` on the live server.

**4. Duplicate Reservation Bug**
Rapid clicking allowed multiple reservations for the same listing. Resolved by adding an existence check in `ReservationController::store()`:
```php
$alreadyReserved = Reservation::where('listing_id', $listingId)
    ->where('buyer_id', Auth::id())
    ->whereIn('status', ['pending', 'confirmed'])
    ->exists();
```

### 7.2 Team & Time Constraints

**Accelerated Timeline:** The 3-week sprint was managed by prioritizing must-have features (Authentication, CRUD, Browsing) using an Agile approach.

**Diverse Skill Levels:** Team members had varying Laravel experience. We used pair programming and internal code reviews — more experienced members guided others on MVC and migrations, while less technical members focused on UI and documentation.

---

## 8.0 Conclusion

### 8.1 Summary of Achievements

FoodSaver successfully delivered a fully functional, deployed web application addressing food waste in Malaysia. Key achievements:

1.  Complete Laravel MVC app with full CRUD, live on Railway
2.  Secure custom authentication with 3 roles (Vendor, Buyer, Admin) and middleware-based access control
3.  Real-time buyer feed with search, category filter, and reservation system
4.  Automated status synchronization across the full reservation lifecycle
5.  Shariah-conscious design promoting responsible consumption and reducing Israf

### 8.2 Future Improvements

-  **Payment Gateway** — Integrate ToyyibPay or Stripe for discounted paid listings
-  **GPS-Based Filtering** — Google Maps API for proximity-based listing discovery
-  **Real-Time Chat** — Laravel Reverb/Pusher WebSockets for vendor-buyer coordination
-  **Mobile App** — Flutter or React Native with push notifications
-  **Auto-Expiry Command** — Laravel scheduler to auto-update expired listing statuses

---

## References

- Hani, A. (2022, February 15). *Malaysia throws away 17,000 tonnes of food daily.* The Malaysian Reserve. https://themalaysianreserve.com/2022/02/15/malaysia-throws-away-17000-tonnes-of-food-daily/
- Laravel LLC. (2023). *Laravel 10.x Documentation.* https://laravel.com/docs/10.x
- Laravel LLC. (2023). *Eloquent ORM.* https://laravel.com/docs/10.x/eloquent
- Laravel LLC. (2023). *Blade Templates.* https://laravel.com/docs/10.x/blade
- Laravel LLC. (2023). *Authentication.* https://laravel.com/docs/10.x/authentication
- Bootstrap Team. (2023). *Bootstrap 5.* https://getbootstrap.com/docs/5.3/
- Otwell, T. (2023). *Laravel 10 Released.* https://laravel-news.com/laravel-10
- Railway. (2024). *Railway Documentation.* https://railway.app

# MASTER PROMPT — MINI-MART LARAVEL MINI E-COMMERCE SYSTEM

You are an experienced Laravel full-stack developer and UI/UX designer.

I want you to develop a complete beginner-level but professionally designed mini e-commerce web application named:

# MINI-MART

The application should look like a simplified Amazon/Daraz-style e-commerce website, but it must remain small, understandable, maintainable, and suitable for a beginner Laravel project.

The goal is to demonstrate proper Laravel CRUD operations, authentication, role management, database relationships, shopping cart, order management, and a professional responsive frontend.

Do NOT turn this into a huge enterprise application.

---

# 1. TECHNOLOGY STACK

Use ONLY the following technologies unless absolutely necessary:

* Laravel
* PHP
* MySQL
* XAMPP
* Blade Templates
* HTML5
* CSS3
* Tailwind CSS via CDN
* Vanilla JavaScript where necessary
* Laravel built-in/session authentication or a simple custom authentication system

Database:

* MySQL through XAMPP
* Database name: `mini_mart`

Do NOT introduce React, Vue, Node.js backend, Bootstrap, Livewire, Inertia, or other unnecessary frameworks.

The project should run using:

```bash
php artisan serve
```

and MySQL should run through XAMPP.

---

# 2. MAIN OBJECTIVE

Build a complete mini e-commerce website where:

ADMIN can:

* Register
* Login
* Manage categories
* Manage products
* Manage users
* Manage orders
* Change order status
* View dashboard statistics

CUSTOMER can:

* Register
* Login
* Browse products
* Search products
* View product details
* Add products to cart
* Update cart quantity
* Remove products from cart
* Checkout
* Place Cash on Delivery orders
* View order history
* View order status
* Edit own profile

PUBLIC VISITOR can:

* Visit homepage
* Browse products
* Search products
* View product details
* Register
* Login

No payment gateway is required.

Payment method:

# CASH ON DELIVERY ONLY

---

# 3. IMPORTANT DEVELOPMENT RULE

This is a beginner-level Laravel project.

Keep the architecture simple.

Do NOT over-engineer the project.

Use:

* Controllers
* Models
* Migrations
* Blade views
* Routes
* Middleware
* Form validation
* Eloquent relationships
* Sessions where appropriate

Keep controllers and views organized.

Avoid unnecessary abstractions.

Write clean, readable code that a beginner can understand and explain during a presentation or viva.

Use reusable Blade components/partials where appropriate.

Do not duplicate the same navbar, footer, buttons, alerts, etc. across every page.

---

# 4. USER ROLES

There are exactly TWO roles:

```text
admin
customer
```

Every newly registered user MUST automatically receive:

```text
role = customer
```

Nobody should be able to select "admin" during registration.

Example:

```text
Name
Email
Password
Confirm Password
```

After registration:

```text
role = customer
```

An existing admin can promote a customer to admin.

An admin can also demote an admin to customer.

---

# 5. FIRST ADMIN

Because every public registration creates a customer account, there must be a way to create the first administrator.

Provide one of these simple approaches:

Preferred:

Create a Laravel seeder that creates a default admin account.

Example:

```text
Email: admin@minimart.com
Password: admin123
Role: admin
```

Clearly document these credentials in the README.

Also make it possible to manually change a user's role from the database through phpMyAdmin/XAMPP.

Do NOT create a public registration form that allows users to select admin.

---

# 6. AUTHENTICATION

Implement:

## Registration

Fields:

* Name
* Email
* phone
* address
* Password
* Confirm Password

Validation:

* Name required
* Email required and unique
* Password required
* Password confirmation required

Default:

```text
role = customer
```

## Login

Fields:

* Email
* Password

After successful login:

If role = admin:

```text
/admin/dashboard
```

If role = customer:

```text
/customer/dashboard
```

## Logout

Provide logout functionality.

Passwords must be securely hashed.

Unauthenticated users must not access protected pages.

---

# 7. DATABASE DESIGN

Create proper Laravel migrations.

Recommended tables:

## users

Fields:

```text
id
name
email
phone
address
password
role
created_at
updated_at
```

Role values:

```text
admin
customer
```

---

## categories

Fields:

```text
id
name
description
created_at
updated_at
```

---

## products

Fields:

```text
id
category_id
name
description
price
quantity
image_url
created_at
updated_at
```

Important:

Product images MUST be stored as URL text.

Do NOT implement image uploading.

Example:

```text
https://example.com/image.jpg
```

The admin will paste an externally hosted image URL into the product form.

Display that URL as the product image.

Provide a sensible fallback image or placeholder when the URL is invalid/missing.

---

## orders

Fields:

```text
id
user_id
total_amount
status
payment_method
shipping_name
shipping_phone
shipping_address
created_at
updated_at
```

Payment method should always be:

```text
Cash on Delivery
```

Order statuses:

```text
Pending
Approved
Declined
Delivered
```

Default status:

```text
Pending
```

---

## order_items

Fields:

```text
id
order_id
product_id
quantity
price
created_at
updated_at
```

Store the product price at the time of ordering so historical orders remain accurate even if the product price changes later.

---

# 8. DATABASE RELATIONSHIPS

Implement proper Eloquent relationships.

User:

```text
User hasMany Orders
```

Category:

```text
Category hasMany Products
```

Product:

```text
Product belongsTo Category
Product hasMany OrderItems
```

Order:

```text
Order belongsTo User
Order hasMany OrderItems
```

OrderItem:

```text
OrderItem belongsTo Order
OrderItem belongsTo Product
```

Use these relationships throughout the application.

Avoid unnecessary raw SQL when Eloquent can handle the operation cleanly.

---

# 9. ADMIN PANEL

Create a dedicated professional admin area.

Admin layout:

```text
Sidebar
    Dashboard
    Categories
    Products
    Users
    Orders
    Logout

Main Content
```

On desktop:

* Fixed/comfortable sidebar
* Clean dashboard
* Professional cards
* Tables
* Proper spacing

On mobile:

* Responsive sidebar
* Mobile menu button
* Tables should become horizontally scrollable or responsive
* No broken layouts

---

# 10. ADMIN DASHBOARD

Create a professional dashboard.

Display cards such as:

```text
Total Products
Total Categories
Total Customers
Total Orders
Pending Orders
Delivered Orders
```

Example:

```text
┌─────────────────┐
│ Total Products  │
│      128        │
└─────────────────┘
```

Use icons where appropriate.

Below the cards, display:

* Recent Orders
* Recent Products
* Pending Order Requests

The dashboard should look like a real modern admin dashboard.

Do NOT use excessive colors or giant cards.

Use a clean professional visual hierarchy.

---

# 11. CATEGORY CRUD

Admin can:

### Create

Fields:

```text
Category Name
Description
```

### Read

Display categories in a professional table.

Columns:

```text
ID
Name
Description
Created At
Actions
```

### Update

Admin can edit category information.

### Delete

Admin can delete categories.

Before deleting a category that has products, handle the situation safely.

Preferred behavior:

Show a warning such as:

```text
This category contains products and cannot be deleted.
```

Do not silently delete related products.

Use confirmation before destructive actions.

---

# 12. PRODUCT CRUD

Admin can:

### CREATE PRODUCT

Form:

```text
Product Image URL
Product Name
Category
Description
Price
Quantity / Stock
```

Image field example:

```text
https://images.example.com/product.jpg
```

Display a live image preview using JavaScript if practical.

Validation:

```text
name required
category required
description required
price numeric and >= 0
quantity integer and >= 0
image_url valid URL or nullable
```

### READ PRODUCTS

Create a professional product management table.

Columns:

```text
Image
Product Name
Category
Price
Stock
Created
Actions
```

### UPDATE PRODUCT

Admin can edit every product field.

### DELETE PRODUCT

Admin can delete a product.

Use confirmation.

If a product has historical order items, do not break old orders.

Handle deletion safely. Prefer preventing deletion when necessary or using an appropriate soft-delete strategy only if it does not unnecessarily complicate the beginner project.

---

# 13. USER MANAGEMENT

Admin can access:

```text
/admin/users
```

Display:

```text
ID
Name
Email
phone
address
Role
Registered Date
Actions
```

Admin can:

* View all users
* Change customer → admin
* Change admin → customer
* Delete users

IMPORTANT:

An admin MUST NOT be able to delete their own currently logged-in account.

If the logged-in admin attempts to delete themselves:

Show:

```text
You cannot delete your own account.
```

An admin can manage other users.

Use confirmation before deleting a user.

---

# 14. ORDER MANAGEMENT

Admin can view all customer orders.

Page:

```text
/admin/orders
```

Display:

```text
Order ID
Customer
Total
Payment
Status
Date
Action
```

Admin can open order details.

Order details should show:

```text
Customer information
Shipping information
Ordered products
Quantity
Price
Subtotal
Total
Payment method
Order status
Order date
```

Admin can update status:

```text
Pending
Approved
Declined
Delivered
```

Use a dropdown or appropriate UI.

For example:

```text
Pending → Approved → Delivered
```

Declined should represent a rejected order.

Do not implement online payment.

Payment method must display:

```text
Cash on Delivery
```

---

# 15. CUSTOMER WEBSITE

The customer-facing website must look like a real modern mini e-commerce website.

Create a public layout.

Navigation bar should contain appropriate items such as:

```text
MINI-MART
Home
Products
Categories
Search
Cart
Login/Register
```

When logged in:

```text
Home
Products
Categories
Cart
My Orders
My Profile
Logout
```

For admin:

Provide a clear way to access the admin dashboard after login.

---

# 16. LANDING PAGE

Create a beautiful professional homepage.

The homepage should contain:

## NAVBAR

Professional responsive navbar.

Include:

* Mini-Mart logo/text
* Home
* Products
* Categories
* Search
* Cart icon with item count
* Login/Register when guest
* Profile/My Orders when logged in

Desktop and mobile responsive behavior is required.

---

# 17. HERO SECTION

Create an attractive e-commerce hero section.

Example concept:

```text
Shop Smart.
Live Better.

Discover quality products at affordable prices.

[Shop Now]
[Explore Products]
```

Use a professional layout with an appropriate e-commerce image/background.

Do not use copyrighted Amazon/Daraz branding.

Mini-Mart must have its own visual identity.

---

# 18. FEATURED PRODUCTS

Display a section:

```text
Featured Products
```

Show product cards from the database.

Each card should contain:

* Image
* Product name
* Category
* Price
* Stock status
* View Details button
* Add to Cart button

If no products exist, show a professional empty state.

---

# 19. CATEGORY SECTION

Display available categories as attractive cards.

Example:

```text
Electronics
Fashion
Home & Living
Beauty
Grocery
Accessories
```

These should come from the database rather than being hardcoded.

Clicking a category should show products belonging to that category.

---

# 20. WHY CHOOSE MINI-MART

Create a professional static section with 3–4 benefits.

Example:

```text
Fast Delivery
Quality Products
Secure Shopping
Cash on Delivery
```

Use icons.

This section can be hardcoded.

---

# 21. TESTIMONIAL SECTION

Create a static testimonial section.

Use 3–4 fictional testimonials.

Example:

```text
"Great products and very easy ordering experience."

— Rahim
```

Clearly treat these as demonstration/static content.

---

# 22. FOOTER

Create a professional footer containing:

```text
Mini-Mart
About Mini-Mart

Quick Links
Home
Products
Categories
My Orders

Customer Support
Contact
FAQ

Social Icons

Copyright © 2026 Mini-Mart
```

The footer should look polished and responsive.

---

# 23. PRODUCT LISTING PAGE

Create:

```text
/products
```

Features:

* Product grid
* Search
* Category filter
* Price information
* Stock status
* Product details
* Add to Cart

Use pagination if there are many products.

Product cards should have consistent dimensions.

Images should use:

```css
object-fit: cover;
```

or an appropriate equivalent so the layout remains clean.

---

# 24. SEARCH

Implement product search.

User can search by:

```text
Product name
Description
```

Example:

```text
Search: headphone
```

Display matching products.

If nothing is found:

```text
No products found.
Try another search.
```

Search should be handled using Laravel query logic rather than JavaScript-only filtering.

---

# 25. PRODUCT DETAILS PAGE

Create:

```text
/products/{id}
```

Display:

* Large product image
* Product name
* Category
* Description
* Price
* Available stock
* Quantity selector
* Add to Cart

If quantity is 0:

```text
Out of Stock
```

Disable the Add to Cart button.

---

# 26. SHOPPING CART

Use Laravel session-based cart.

Do NOT create a database cart table unless necessary.

Cart page:

```text
Cart
```

Each item should show:

* Image
* Product
* Price
* Quantity
* Subtotal
* Remove button

User can:

* Increase quantity
* Decrease quantity
* Remove product
* Continue shopping
* Proceed to checkout

Calculate:

```text
subtotal = price × quantity
```

Display:

```text
Subtotal
Delivery Charge
Total
```

For simplicity:

```text
Delivery Charge = 0
```

or clearly display:

```text
Free Delivery
```

---

# 27. CHECKOUT

Create a clean checkout page.

Collect:

```text
Full Name
Phone Number
Shipping Address
```

Show:

```text
Order Summary
Products
Quantity
Subtotal
Total
Payment Method
```

Payment method:

```text
Cash on Delivery
```

Button:

```text
Place Order
```

After placing an order:

* Create order
* Create order items
* Reduce product stock
* Clear cart
* Redirect to order confirmation/order history
* Status = Pending

---

# 28. STOCK MANAGEMENT

Product quantity represents stock.

When customer places an order:

```text
product.quantity -= ordered_quantity
```

Do NOT allow the customer to order more than available stock.

Example:

```text
Available: 5
Requested: 8

Error:
Only 5 items are currently available.
```

If stock becomes 0:

```text
Out of Stock
```

Admin can update stock through product edit.

---

# 29. CUSTOMER DASHBOARD

Create:

```text
/customer/dashboard
```

It should look professional.

Display:

```text
Welcome, [User Name]

Total Orders
Pending Orders
Approved Orders
Delivered Orders
```

Also display recent orders.

Provide quick actions:

```text
Browse Products
View Cart
My Orders
Edit Profile
```

---

# 30. CUSTOMER ORDER HISTORY

Create:

```text
/my-orders
```

Display:

```text
Order ID
Date
Total
Payment
Status
View Details
```

Customer can open an order and see:

```text
Order information
Products
Quantities
Prices
Shipping address
Payment method
Current status
```

Status should be visually clear.

Example badges:

```text
Pending
Approved
Declined
Delivered
```

---

# 31. CUSTOMER PROFILE

Customer can edit their own profile.

Fields:

```text
Name
Email
Phone
Address
update password
```

If phone/address are not initially stored in the users table, add appropriate nullable fields through migration.

Customer must NOT be able to change their own role.

Role can only be changed by an admin.

---

# 32. UI/UX REQUIREMENTS — VERY IMPORTANT

The frontend UI is extremely important.

DO NOT create a basic ugly Laravel CRUD interface.

The project should look like a professionally designed mini e-commerce website.

Use:

* Tailwind CSS
* Consistent spacing
* Rounded cards
* Subtle shadows
* Clean typography
* Professional buttons
* Modern forms
* Responsive grids
* Proper hover effects
* Product image presentation
* Status badges
* Empty states
* Loading/interaction feedback where appropriate

Do not overuse:

* Gradients
* Huge text
* Excessive animations
* Bright random colors
* Excessive borders
* Giant buttons
* Unnecessary effects

The design should feel:

```text
Modern
Clean
Professional
Trustworthy
E-commerce focused
```

---

# 33. DESIGN SYSTEM

Create a consistent visual identity for Mini-Mart.

Use a professional primary color and neutral background.

Suggested style:

```text
Primary: Indigo / Blue
Background: Light neutral
Cards: White
Text: Dark slate
Muted text: Gray
Success: Green
Warning: Amber
Danger: Red
```

Do not use too many colors.

Typography should be clean and readable.

Use a modern font such as:

```text
Inter
```

or another suitable web-safe/Google font if necessary.

---

# 34. RESPONSIVE DESIGN

The entire website MUST be responsive.

Test:

```text
Desktop
Laptop
Tablet
Mobile
```

Important pages:

* Homepage
* Product listing
* Product details
* Cart
* Checkout
* Customer dashboard
* Admin dashboard
* Admin tables
* Forms
* Login
* Registration

Never allow horizontal overflow unnecessarily.

Tables can use horizontal scrolling on small screens where appropriate.

---

# 35. FORM DESIGN

All forms should look professional.

Use:

* Labels
* Input fields
* Placeholder text
* Validation messages
* Focus states
* Required indicators where appropriate

Example:

```text
Product Name *
[________________________]

Price *
[________________________]

Quantity *
[________________________]
```

Validation errors should be displayed clearly.

---

# 36. ALERTS / FLASH MESSAGES

After actions show appropriate feedback.

Examples:

```text
Product created successfully.
Product updated successfully.
Product deleted successfully.
Category created successfully.
Order status updated successfully.
Profile updated successfully.
```

Error example:

```text
Something went wrong.
Please try again.
```

Use professional alert/toast-style UI where practical.

---

# 37. SECURITY REQUIREMENTS

Implement basic Laravel security best practices.

Must include:

* CSRF protection
* Password hashing
* Authentication middleware
* Admin middleware
* Authorization checks
* Validation
* Prevent customers accessing admin routes
* Prevent guests accessing protected routes
* Prevent users modifying another user's profile
* Prevent users changing their own role
* Prevent admin deleting their own account

Do not trust role information coming from forms.

---

# 38. ROUTE STRUCTURE

Organize routes logically.

Example:

```text
/
 /products
 /products/{id}
 /categories/{id}
 /cart
 /cart/add
 /cart/update
 /cart/remove
 /checkout

/register
/login
/logout

/customer/dashboard
/customer/profile
/my-orders
/my-orders/{id}

 /admin/dashboard
 /admin/categories
 /admin/products
 /admin/users
 /admin/orders
```

Use route names consistently.

Use middleware appropriately.

---

# 39. CONTROLLERS

Keep controllers logically separated.

Suggested:

```text
AuthController
HomeController
ProductController
CategoryController
CartController
CheckoutController
OrderController
ProfileController
AdminDashboardController
AdminUserController
```

Use resource controllers where appropriate for CRUD.

For example:

```text
Route::resource('products', ProductController::class);
```

when suitable.

---

# 40. BLADE STRUCTURE

Use reusable layouts.

Suggested:

```text
resources/views/

layouts/
    app.blade.php
    admin.blade.php

components/
    navbar.blade.php
    footer.blade.php
    product-card.blade.php
    alert.blade.php

home.blade.php

auth/
    login.blade.php
    register.blade.php

products/
    index.blade.php
    show.blade.php

cart/
    index.blade.php

checkout/
    index.blade.php

customer/
    dashboard.blade.php
    profile.blade.php
    orders.blade.php
    order-details.blade.php

admin/
    dashboard.blade.php

    categories/
    products/
    users/
    orders/
```

Use reusable components whenever reasonable.

---

# 41. ERROR HANDLING

Handle common cases professionally:

* Product not found
* Category not found
* Unauthorized access
* Empty cart
* Empty product list
* Invalid product URL
* Insufficient stock
* Attempt to delete own account
* Attempt to delete category containing products
* Attempt to order unavailable quantity

Use Laravel's normal error handling and appropriate redirects/messages.

---

# 42. SEEDER / SAMPLE DATA

Create useful sample data so the website looks populated immediately.

Create:

### Admin

```text
Name: Mini-Mart Admin
Email: admin@minimart.com
Password: admin123
Role: admin
```

### Categories

Example:

```text
Electronics
Fashion
Home & Living
Beauty
Grocery
Accessories
```

### Products

Create around 10–15 sample products.

Use valid publicly accessible image URLs.

Examples:

```text
Wireless Headphones
Smart Watch
Backpack
Running Shoes
Coffee Mug
Desk Lamp
T-Shirt
Keyboard
Mouse
Water Bottle
```

Use realistic:

* names
* descriptions
* prices
* quantities
* categories
* image URLs

The sample data should make the homepage visually attractive immediately after seeding.

---

# 43. ADMIN UI DETAILS

Admin tables should include:

* Search where useful
* Pagination where useful
* Action buttons
* Edit button
* Delete button
* View button
* Status badges
* Empty states

For destructive actions use a confirmation dialog.

Do not make the admin interface visually identical to the customer interface.

Customer:

```text
E-commerce storefront
```

Admin:

```text
Management dashboard
```

---

# 44. ACCESS CONTROL

Implement clear access control.

### Guest

Can:

* View homepage
* Browse products
* Search
* View product details
* Register
* Login

Cannot:

* Checkout
* Place order
* Access dashboard
* Access admin

### Customer

Can:

* Everything guests can do
* Cart
* Checkout
* Orders
* Profile
* Customer dashboard

Cannot:

* Access admin
* Manage products
* Manage categories
* Manage users
* Manage all orders

### Admin

Can:

* Everything necessary for administration
* Manage categories
* Manage products
* Manage users
* Manage orders
* View dashboard

---

# 45. IMPORTANT ORDER LOGIC

Implement this carefully.

When customer clicks:

```text
Place Order
```

Check stock again before creating the order.

If stock is sufficient:

1. Create order
2. Create order items
3. Reduce stock
4. Clear cart
5. Set status = Pending

If stock is insufficient:

Do NOT create the order.

Show an appropriate error.

---

# 46. ORDER STATUS

Default:

```text
Pending
```

Admin can change:

```text
Pending
Approved
Declined
Delivered
```

Customer can only VIEW the status.

Customer cannot change order status.

---

# 47. IMPORTANT UI DETAILS FOR PRODUCT CARDS

Product cards should look polished.

Each card:

```text
┌─────────────────────────┐
│                         │
│       Product Image     │
│                         │
├─────────────────────────┤
│ Wireless Headphones     │
│ Electronics             │
│                         │
│ ৳ 2,500                 │
│ In Stock                │
│                         │
│ [View] [Add to Cart]    │
└─────────────────────────┘
```

Use BDT/Taka pricing because this is a Bangladesh-oriented demonstration project.

Example:

```text
৳ 1,250
```

---

# 48. HOMEPAGE STRUCTURE

The final homepage should approximately follow:

```text
Navbar
↓
Hero Section
↓
Category Section
↓
Featured Products
↓
Why Choose Mini-Mart
↓
Promotional Section
↓
Testimonials
↓
Newsletter/CTA (optional)
↓
Footer
```

Keep the page visually balanced.

Do not fill the page with unnecessary sections.

---

# 49. DO NOT COPY AMAZON/DARAZ

The requested design inspiration is Amazon/Daraz-style e-commerce functionality.

Do NOT:

* Copy their logo
* Copy their exact branding
* Copy their exact layout
* Use their copyrighted assets

Create an original:

```text
MINI-MART
```

brand identity inspired by modern e-commerce websites.

---

# 50. CODE QUALITY

Follow these rules:

* Use meaningful variable names
* Use proper Laravel naming conventions
* Keep controllers readable
* Use validation
* Avoid duplicate code
* Use reusable Blade components
* Use Eloquent relationships
* Keep routes organized
* Add comments only where useful
* Do not write unnecessary comments everywhere
* Do not put huge amounts of business logic directly inside Blade
* Do not put everything into one controller
* Do not create unnecessary files

---

# 51. DEVELOPMENT PROCESS

Do NOT attempt to randomly generate the entire project without checking dependencies.

Follow this sequence:

## STEP 1

Inspect the existing Laravel project.

If the project is empty, initialize the Laravel application.

## STEP 2

Configure:

```text
.env
database
```

Database:

```text
mini_mart
```

## STEP 3

Create migrations.

## STEP 4

Create models and relationships.

## STEP 5

Create seeders/factories.

## STEP 6

Create authentication.

## STEP 7

Create middleware and role authorization.

## STEP 8

Implement admin category CRUD.

## STEP 9

Implement admin product CRUD.

## STEP 10

Implement user management.

## STEP 11

Implement storefront.

## STEP 12

Implement product search/filter.

## STEP 13

Implement session cart.

## STEP 14

Implement checkout.

## STEP 15

Implement order management.

## STEP 16

Implement customer dashboard/order history/profile.

## STEP 17

Implement professional UI.

## STEP 18

Test all workflows.

## STEP 19

Fix validation/security/responsive issues.

## STEP 20

Create README documentation.

---

# 52. TESTING CHECKLIST

Before declaring the project complete, test:

### Authentication

* Register customer
* Login
* Logout
* Invalid login
* Duplicate email
* Password validation

### Admin

* Admin login
* Dashboard
* Create category
* Edit category
* View category
* Delete category
* Create product
* Edit product
* View product
* Delete product
* View users
* Change role
* Delete user
* Attempt self-delete
* View orders
* Change order status

### Customer

* Register
* Login
* Browse products
* Search
* Category filtering
* View product
* Add to cart
* Update quantity
* Remove from cart
* Checkout
* Place COD order
* View order history
* View order details
* Edit profile

### Security

Test that:

* Guest cannot access admin
* Customer cannot access admin
* Customer cannot change role
* Customer cannot access another user's private data
* Admin cannot delete own account

### Stock

Test:

```text
Stock = 5
Order = 3
Remaining = 2
```

Also test:

```text
Stock = 5
Order = 6
```

Expected:

```text
Order rejected
```

---

# 53. README

Create a professional README.md containing:

```text
Mini-Mart
Simple Laravel Mini E-Commerce System
```

Include:

* Project overview
* Features
* Technologies
* Requirements
* Installation
* Database setup
* Environment configuration
* Migration
* Seeder
* Running the project
* Default admin credentials
* User roles
* Project structure
* Main features
* Screenshots section placeholder
* Future improvements

Installation should be clear enough for a beginner.

---

# 54. FINAL QUALITY REQUIREMENT

Before finishing, review the entire application as if you were a professional developer reviewing a student project.

Look for:

* Broken links
* Broken routes
* Missing validation
* Incorrect relationships
* Unauthorized access
* UI inconsistencies
* Bad spacing
* Poor mobile responsiveness
* Broken images
* Empty states
* Incorrect calculations
* Cart bugs
* Stock bugs
* Order bugs
* Authentication bugs

Fix these issues before declaring the project complete.

---

# 55. VERY IMPORTANT — UI QUALITY

The frontend is one of the most important requirements.

I DO NOT WANT:

* ugly default Laravel pages
* plain HTML forms
* unstyled tables
* random colors
* inconsistent spacing
* giant text
* broken mobile layouts
* excessive gradients
* amateur-looking dashboards
* copied-looking Amazon/Daraz UI

I WANT:

* professional modern e-commerce UI
* consistent design system
* responsive layouts
* polished navbar
* beautiful hero section
* attractive product cards
* professional admin dashboard
* clean forms
* modern tables
* clear status badges
* good empty states
* proper hover states
* clean typography
* professional footer
* good mobile experience

The application should look like a **real small e-commerce startup website**, not a basic CRUD assignment.

---

# 56. IMPORTANT — DO NOT OVERBUILD

Remember that this is a beginner Laravel project.

Do NOT add:

* Online payment gateway
* Stripe
* SSL payment
* Delivery tracking
* Coupon system
* Product reviews
* Seller/vendor module
* Wishlist
* Advanced recommendation engine
* Chat system
* AI
* Complex analytics
* Multi-vendor functionality
* Microservices
* React
* Vue
* API architecture unless absolutely required

Keep the project focused.

The final application should be:

```text
Simple
Functional
Clean
Professional
Responsive
Easy to understand
Easy to demonstrate
```

---

# 57. FINAL EXPECTED RESULT

When completed, Mini-Mart should provide this complete workflow:

```text
                    MINI-MART
                       │
          ┌────────────┴────────────┐
          │                         │
       CUSTOMER                   ADMIN
          │                         │
     Register/Login            Register/Login
          │                         │
      Browse Products          Dashboard
          │                         │
        Search               Categories CRUD
          │                         │
     Product Details          Products CRUD
          │                         │
        Add Cart               User Management
          │                         │
        Checkout                Order Management
          │                         │
     Cash on Delivery              │
          │                         │
     Order = Pending ───────────────┘
          │
          ▼
    Admin changes status
          │
    ┌─────┼─────────┐
    ▼     ▼         ▼
Approved Declined Delivered
    │
    ▼
Customer Order History
```

Build this project carefully, step by step.

Do not skip core functionality.

Do not replace requested functionality with mock/demo buttons.

Every button that represents a feature must actually work.

Every CRUD operation must work with the MySQL database.

Every role restriction must actually be enforced server-side.

The final application must be runnable locally using XAMPP + MySQL + Laravel.

At the end, provide:

1. Summary of what was implemented
2. Database tables
3. Routes created
4. Admin credentials
5. How to run the project
6. Testing checklist
7. Any remaining issues, if any

Start by inspecting the current project structure and then implement the project systematically rather than making random changes.

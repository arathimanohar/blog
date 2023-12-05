## Blogging Site Documentation
---
### Steps:
1. Install Dependencies:
Run the following command to install the project dependencies using Composer:
```
composer install
```
2. Setup the .env file to configure your database connection and other settings.
 Generate Application Key:
Run the following command to generate a unique application key:
```
php artisan key:generate
```
3. Install npm Packages:
Install the necessary npm packages for the front-end assets:
```
npm install
```
4. Run npm dev:
Compile and build the front-end assets:
```
npm run dev
```
5. Run Migrations:
```
php artisan migrate
```
6. Run Seeder
```
php artisan db:seed
```

8. Start the Development Server:
Launch the Laravel development server:
```
php artisan serve
```
---

## Screenshots
Blog Listing
<img width="1440" alt="blogs listing" src="https://github.com/arathimanohar/blog/assets/34857242/99e74198-fd57-47d4-a635-8e6eed037b64">

Create Post
<img width="1440" alt="Create post" src="https://github.com/arathimanohar/blog/assets/34857242/eeae7223-92b7-4ae9-be8b-947d5b0de541">

Reports page without authentication
<img width="1440" alt="reports-without auth" src="https://github.com/arathimanohar/blog/assets/34857242/75426308-d2dc-4941-ad02-b9bf3af6a37d">

Post Liking
<img width="1440" alt="Liked posts" src="https://github.com/arathimanohar/blog/assets/34857242/c1c8813a-302b-421f-a9ce-834065dd1931">

Edit Post
<img width="1440" alt="editpost" src="https://github.com/arathimanohar/blog/assets/34857242/fdd8058f-aa6f-48ea-9fac-6bfd5d989f04">


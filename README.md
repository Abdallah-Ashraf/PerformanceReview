Introduction
===
###Assumptions
• Admin and Employee user are the same user entity distinguished by role (is_admin:
false/true)

• Admin user can create a performance review, assign multiple employees/users as
reviewees for that specific performance review, and assign multiple employees/users
as reviewers for each reviewee's performance review

• A reviewer can submit only one review feedback for each pending feedback request.
Once submitted, the feedback cannot be edited or resubmitted
###Working Functionalities
• User authentication (Login and Logout)

• Dashboard/landing page

• Employees page (only Admin can view this page): Admin user can create/view/update/
delete employee users.

• Performance Reviews Page (only Admin can view this page): Admin user can
create/view/update performance review with the ability to assign reviewees and
reviewers.

• Feedback Requests page (Both Admin and employee user can view this page):
Displays a list of inquiring feedback requests that have been assigned to the
authenticated user. The reviewer can submit feedback for each pending feedback
request.

## Perquisites
The project is based on the version `8.x` of the Laravel framework,
so make sure that you are satisfying the requirements
listed in the [framework's documentation](https://laravel.com/docs/8.x)

## getting started steps
Run the following commands in order to get a ready to use clone of the application:

1. Clone the repository
```bash
git clone  https://github.com/Abdallah-Ashraf/PerformanceReview.git
```
2. Get into the directory
```bash
cd PerformanceReview
```
3. Check that your environment satisfy the requirements
```bash
composer check-platform-reqs
```
4. Install composer dependencies
```bash
composer install
```
5. Setup your environment
```bash
cp .env.example .env
```
6. Generate app secret key
```bash
php artisan key:generate
```
7.  Database
```bash
generate Mysql Database name="database_name" in Mysql 
``` 
feel free to change Database name or user or password  but ensure you add correct value in .env file
migrate tables to be used in project
```bash
php artisan migrate
``` 
run seeder to add default account to use to login
```bash
php artisan db:seed
```
Now you have a ready to use clone of the application.

## How To?



### Start The Development Server
In order to run the development server you need to run the following command:
```bash
php artisan serve
```

### Use The Solution

You can use Example
simply make a get request to the following :
```
http://127.0.0.1:8000/
```


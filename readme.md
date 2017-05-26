# Laravel App demo

This project was developped in c9.io and Laravel 5.2 therefore I had to edit the config/database.php configuration file in order to connect to c9 local workspace database. Please edit this file accordingly when you install it in order to connect to your database.

Unlike the API project, this one has a visual web interface to view and edit the data involved.

## Links

### Home
    
Basic homepage
    
### Users

Displays a list of all the users with minimal information

#### View (in users table)
Displays this specific user's complete information
##### View all posts by this user (in user/[id] page)
Displays a list of all blog posts by this user
##### Edit (pencil icon in the user/[id] page)
Returns a form to edit this user, which will then redirect to view user page unless there were errors.

### Blog

Displays a list of all the blog posts minus the "updated_at" date.

#### Create Blog Post 
Returns a form to create a new form, which will redirect to view post page unless there were errors.
#### View post (icon in posts list)
Displays more information about this specific post.


## Notes

I've had to change some things in laravel's structure in order to get this project as clean as I would like it to be. Here is a list of my changes:

1. I've created an .htaccess file in the root folder to better serve css and js files inside the public folder
2. I've renamed server.php to index.php in order for the request to automatically load the app
3. I've removed Csrf token verification

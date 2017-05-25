# Laravel JSON Api demo

This project was developped in c9.io therefore I had to edit the config/database.php configuration file in order to connect to c9 local workspace database. Please edit this file accordingly when you install it in order to connect to your database.

## Routes

### GET /users
    
Returns an array of all users including the label of their role, their address information and the number of blog posts they have.
    
### GET /users/[UserID]

Returns a specific user's information, [UserID] must be numeric.
    
### GET /blog_posts

Returns an array of all blog posts
    
### POST /create_blog_post

Creates a blog post, all fields are required.

#### Parameters
| variable | definition |
| -------- | ------------------- | 
| author   | Represents the id of the user who is creating this blog post |
| title    | The title of this blog post |
| content  | The content of this blog post |

### POST /edit_user/[UserID]

Edits a user's information, including their role and address information. [UserID] must be numeric and is required. All POST fields are also required.

#### Parameters
| variable | definition |
| -------- | ------------------- | 
| username   | The user's new username |
| user_roles_id    | The numeric representation of this user's role: 1 = Admin, 2 = Publisher, 3 = Public User |
| email  | The user's new email |
| address | The user's new address |
| province | The user's new province |
| city | The user's new city |
| country | The user's new country |
| postal_code | The user's new postal code |



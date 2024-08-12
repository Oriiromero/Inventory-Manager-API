## About the project

This project is inteded to work as an inventory manager. You can create packages, update their movements and associate supermarkets where they have to be delivered. You have to be registered and logged in for this to work. 
When a user does any action, the action is saved into a tracking register.

## Actions available 

CRUD for packages, packages moves, supermarkets and users. Audit logs are registered automatically.

There are two roles to assign to a user when created, 'admin' or 'employee'. Admins have access to all the actions in the database whereas employees can do everything that's not deleting data. Only admin users can create or delete other users.


## How to test it

The project database is always active as it is hosted in a cloud DB, to be able to test the routing it is necessary to download the code, and run the next command:
 - php artisan serve

Once the api is running it is needed to have some app such as postman to test the routes, and you can use this user to test them as it has access to all the routing (remember to put the token for it to work after login in): 
    "email": "oriana@example.com"
    "password": "oriana123"

The routes always need to start with your http://localhost:8000/api/.... and the first thing you need to do is login in! 

Hope it works and if something doesn't work you can write me an email at oriana.nahir.r@gmail.com and I'll check it out. Thank you <3


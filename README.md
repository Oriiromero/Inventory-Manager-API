## About the project

This project is inteded to work as an inventory manager. You can create packages, update their movements and associate supermarkets where they have to be delivered. You have to be registered and logged in for this to work. 
When a user does any action, the action is saved into a tracking register.

## Actions available 

CRUD for packages, packages moves, supermarkets and users. Audit logs are registered automatically.

There are two roles to assign to a user when created, 'admin' or 'employee'. Admins have access to all the actions in the database whereas employees can do everything that's not deleting data. Only admin users can create or delete other users.

### Run on Google cloud run

[![Run on Google Cloud](https://storage.googleapis.com/cloudrun/button.svg)](https://console.cloud.google.com/cloudshell/editor?shellonly=true&cloudshell_image=gcr.io/cloudrun/button&cloudshell_git_repo=https://github.com/Oriiromero/Inventory-Manager-API.git)


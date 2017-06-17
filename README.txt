BBC Technical Test

- The single entry point to the app is through /public that loads initialisation file, creates a new router and adds a single route. This could be seen as as front controller pattern implementation.
- The app tries to follow a MVC pattern, separating controller, models and views
- A lightweight, custom-built framework / router was used to support the task and is located in /vendor/basic-framework/framework/src
- A dependency manager (Composer) was used for autoloading and to pull in phpUnit dependencies
- Very basic phpUnit tests are included in /tests folder

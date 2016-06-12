Some College Api
================

Full stack sample application, the user interface allows users to enroll to courses and provide a visual representation of the schedule. This is the repo for the server side done in PHP with Laravel 5.

Developed in PHP using Laravel 5. The database is SQLite with 4 different tables (3 models), one for storing the users, another for courses, one for periods and finally one for to joining users with courses in order to represent the many to many relationship between them. Although in the client side there is no sign in form at the moment, the server side fully supports multiple users. Authentication is preform with a API token that the client will put in the header after the login. Cross origin requests are enabled allowing clients in different domains as well as mobile clients.

[LIVE DEMO](http://luisbravoa.com/sandbox/some-college-client/)

[CLIENT REPO](https://github.com/luisbravoa/some-college-client)

Dependencies
============

- Laravel 5
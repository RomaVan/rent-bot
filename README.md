# Simple telegram rent bot for communication
### For training purposes
###Goals:
- try to learn and use spiral framework with road runner
- code long-running application
- learn Telegram API
- use new features in PHP

### Uses:
* PHP 8+
* Postgres 12
* Roadrunner with Spiral framework and CircleORM

### Project Idea
An easy way to communicate between a landlord and a renter.  
The landlord can create a new rental housing and assign the renter/renters to it.  
The landlord could request pays utility information (gas, electricity, water, etc) and after getting such info send a response about the payment amount.  
Also, the renters could send a request for support info or repair something in the rental housing.

### How it should work
By commands in telegram bot


#### To do:
- Finish user saving data
- Select a role for users
- Creating rental housing for owners
- Invite system for rental
- Request for house communication billing info
- Sending responses for that info

#### Tech part fix
- add php cs fixer
- add psalm and phpstan
- add mutation testing tools
- add rabbitmq for events and pub/sub
- fix issues related to unknowns parts of spiral framework and cycle orm

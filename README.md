## For bth course mvc


[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Rilr20/bth-mvc-proj/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/Rilr20/bth-mvc-proj/?branch=main)
[![Code Coverage](https://scrutinizer-ci.com/g/Rilr20/bth-mvc-proj/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/Rilr20/bth-mvc-proj/?branch=main)
[![Build Status](https://scrutinizer-ci.com/g/Rilr20/bth-mvc-proj/badges/build.png?b=main)](https://scrutinizer-ci.com/g/Rilr20/bth-mvc-proj/build-status/main)

[![Build Status](https://travis-ci.com/Rilr20/bth-mvc-proj.svg?branch=main)](https://travis-ci.com/Rilr20/bth-mvc-proj)

---

## About

Website that has a page for a 21 game, yatzy, book and a blog page. 

The website is using laravel framework and mysql as a database. The css is build with scss. The project also has validation tools such as phpcpd phpmd phpstan and phpunit for the unit tests the project has. 


## 21 Game
You can choose 1 or 2 dice. Then you can roll the die to get up to but not over 21. You play against the computer. After each win the result is saved in the session which is displayed after each play session.

## Yatzy
Play the first part of Yatzy. You have 3 throws per round, after each throw you can choose to keep some die or add it to the points table. You can submit your score to the highscore table. 

## Dice

There are 3 different dice classes, Dice, DiceHand, and GraphicalDice. Dice is just a simple when creating you can set how many sides it can have. DiceHand is for when you need multiple die. You set how many you want and how many sides you want. Graphical die draws a 6 sides die with css based on the result the die got.

## Book
Displays books based on the table with id, title, author, isbn, published (year) and image. 

## Blog
The table that is used for Blogposts contains the following columns:
id, header, bodytext, image_one, image_two, author, published (Date and time), deletad_at (dateTime), created_at (dateTime), updated_at (dateTime). 

You can create a blogpost, edit and delete. When creating the following parameters are required, Title, Body text, Author. You get a different view depending on how many images (0-2) you give it. You need to log in as a user to access the admin page which is where you can create, update and delete. When creating you don't need to add a date it will default to the time now. If you want to publish in the future you can do that by setting the date. In the admin page you can select a post and edit it. 
Delete is a soft delete from the database. It adds the current time in the deleted_at column. 

The website has a preview of all blogs that has been published. The user can then go into a specific blog and see the full text and images.
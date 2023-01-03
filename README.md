# Univers-it

![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/tailwindcss-%2338B2AC.svg?style=for-the-badge&logo=tailwind-css&logoColor=white)![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)
![jQuery](https://img.shields.io/badge/jquery-%230769AD.svg?style=for-the-badge&logo=jquery&logoColor=white)

Univers-it is a social network inspired by:
- [Reddit](https://www.reddit.com/): users will post in groups
- [Blind](https://www.teamblind.com/): only university students will be able to register. 

## Requirements
The project was assigned for the "web technologies" course with the following requirements:
- Design: max 3 pts
- Registration/Login: max 3 pts
- Feed: max 4 pts
- Posts: max 3 pts
- Comments: max 3 pts
- Follow: max 3 pts
- User page: max 4 pts
- Notifications: max 5 pts
- Extra: max 4 pts

It is developed by:
- [Filippo Sanzani](https://github.com/FiloSanza)
- [Lorenzo Drudi](https://github.com/LorenzoDrudi)
- [Rachele Margutti](https://github.com/Rachele01)

## Features

1. [Registration & Login](#registration--login)
2. [Feed](#feed)
3. [Posts](#posts)
4. [Comments](#comments)
5. [Follow](#follow)
6. [User Page](#user-page)
7. [Notifications](#notifications)
8. [Extra](#extra)

### Registration & Login

As stated before, only university students will be able to register to the website. \
This will be enforced at registration time forcing the user to use an istitutional email, we currently accept the following ones:
- University of Bologna: `@studio.unibo.it`
- University of Trento: `@studenti.unitn.it`

The registration process includes a verification email.

### Feed

Once a user logs in he'll be shown the latest posts from users and groups that he follows. \
A user who is not logged in can only see some random posts without the possibility to react or comment to it.

### Posts

Users can post only inside a group. \
Posts are made of:
- Title
- Description (optional)
- Image (Optional)

### Comments

Users can comments posts from the post's page, each comment can be a reply to a previous one.

### Follow

Users can follow other users and groups. Posts in followed groups and from followed users are shown in the feed.

### User page

From this page users will be able to:
- See all the posts of a user.
- Follow the user.
- See all the followers of the user.
- See all the users that the user is following.

### Notifications

The application will send notifications to its users for the following events:
- A new post from a followed user.
- A new comment under a post.
- A new follower.
- A new reaction to a post.
Each notification will both be shown in the website and be sent as an email.

### Extra

We decided to add the following things that were not in the assignment:
- `Groups`: a place where users can post.
- `Reactions`: users can like or dislike a post.
- Replies to comments.
- `Toggle email notification`: user's can decide which notifications they want to receive via mail.
- Secure password store.
- `Ajax`
- `Laravel`

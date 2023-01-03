# Univers-it

Univers-it is a social network inspired by Reddit with groups where users will post and Blind, infact only university students will be able to register. 

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

## Features

### Registration & Login

As stated before only university students will be able to register to the website. This will be enforced at registration time forcing the user to use an istitutional email, we currently accept the following ones:
- Università di Bologna: @studio.unibo.it
- Università di Trento: @studenti.unitn.it

The registration process includes a verification email.

### Feed

Once a user logs in he'll be shown the latest posts from users and groups that he follows. 

### Posts

A user can only post in a group. A post is made of:
- Title
- Description (optional)
- Image (Optional)

### Comments

Users can comments posts from the post's page, each comment can be a reply to a previous one.

### Follow

Users can follow each others, but they can also follow groups. Posts in followed groups or from followed users can be found in the feed.

### User page

From this page users will be able to see:
- All the posts of a user.
- Follow the user.
- See all the followers of that user.
- See all the users that user is following.

### Notifications

The application will send notifications to its users for the following evetns:
- A new post from a followed user.
- A new comment under a post.
- A new follower.
- A new reaction to a post.
Each notification will both be shown in the website and be sent as an email.

### Extra

We decided to add the following things that were not in the assignment:
- Groups: a place where users can post.
- Reactions: users can like or dislike a post.
- Replies to comments.
- Toggle email notifications: user's can decide which notifications they want to receive via mail.
- Secure password store.
- Ajax
- Laravel
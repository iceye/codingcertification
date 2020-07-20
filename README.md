# D-Board
Docebo Coding Certification repository, Mockup https://docebo.invisionapp.com/share/B6Y44YTKMH8

## How to start the project
Install Git (you should know how thanks to Niccolo')

Use Carmine's Env (Apache, PHP, MySQL with MAMP/XAMPP) or equivalent

Clone this Repository with GUI or by running 
```
git clone https://github.com/iceye/codingcertification.git
```

## Project structure
* **docs**: here you can find the scenarios 
* **db**: here you can find the DB structure and initial data
* **lib**: some useful PHP functions for your project (helper funtions to manage users, topics and messages)
* **css**: css files, global style.css and a css file for each page
* **js**: js files, global script.js and a js file for each page
* **README.md** this file
* **LICENSE** unused
* **index.php** the main platform page, here you should show the sign-in/registration link for guests and the topic list for logged in users
* **signin.php** the sigin dedicated page
* **register.php** the user registration dedicated page
* **topic.php** the single topic detail page

* **examples.php** some code fragments using all the *lib* helper funtions


# EVOLUTION
Are you a dev rockstar? Add these features:
* **Timezone**: Add timezone management in user registration and show the dates based on user selected timezone.
* **Multilanguage**: Remove hard-coded labels and use multilanguage keys instead. Choose the D-board language by using the browser language if you have the translations or use ENG as fallback.
* **Pagination**: Paginate topics and messages using traditional pagination controls or be a rockstar and implement the continuos scoll!
* **Styles**: Use an advanced editor for messages and display some basic styles (bold, italic, lists, bullets) into messages. If you want to be a rockstar add the support for images and tables.
* **My profile**: Create a new My profile page, let the user to change the password and the timezone. Are you the best? Add the user avatar management.

# ENJOY

# Facemash
# ***CURRENTLY A WORK IN PROGRESS***
<br>
Facemash Code w/ Leaderboard + Profiles <br>


__Introduction + Disclaimer__: <br>
Hey everyone, Ptrfamily here. This code is essentially a template to make your own Facebook "Facemash". You are probably here after watching The Social Network and seeing Mark Zuckerberg create a similar program. I would like to first say that what Mr. Zuckerberg did was against school policies because he illegally retrieved and used photos of his Harvard classmates without their permission. I am not responsible for what you do with this code and the moment you download or copy the code, you are responsible for your actions. 
<br>
<br>
__Summary of Key Differences:__ <br>
I would like to talk about the key differences between this code and Zuckerbergs: 
- In the movie and I believe in real life, he made a simple website that showed only the top (and maybe) bottom ranked people. This project contains a leaderboard to see where everyones rank and updates by refreshing the page in real time.
- He does this facemash code for only the females, I created a facemash template for both males and females, each having the exact same code. The difference is males code and SQL database are diffferentiated in the code by an "m" placed either infront or at the very end of the files.
- In the movie, the facemash pairings are completely random and the scoring is based on an elo system. I have kept the same elo system used (equations can be found <a href = "https://en.wikipedia.org/wiki/Elo_rating_system">here</a>), but have changed the pairing method. I have based the pairing method on competitive video game matchmaking systems, where your current elo determines who you are matched up against. Breakdown of the matchmaking code will be down below but as a quick example, if you are rated 2000, you will most likely be paired up with another person between the range of 1950-2050, where in Zuckerberg's code, a 1500 could have the chance of being placed against a 2000.
-Recent addition: Profile pages where you can see a persons recent 10 matchups and most of their stats

__Instructions:__
<br> *I run this project over XAMPP to test out my code on a local server. I will skip over the XAMPP tutorial part, but if enough people ask for it, I may write directions to guide beginners. When configuring XAMPP, ensure that MySQL is enabled, and you have access to your localhost pHpMyAdmin. Also, if you plan on publishing this website, ensure that you change authtype in config.inc.php from "config" to "cookie" to allow you to change the password in phpmMyAdmin to secure your databases. In addition, because this code is messy (I will work on cleaning it up), you will need to add your passwords for male and female seperately and at every designated spot that is mentioned down below.*

Assuming you have the prerequisites done, lets get implementing!
Windows 10:
- Open XAMPP and start Apache and MySQL
- Quickly go to your browser (for all intents and purposes, I will be using Chrome), and type "localhost" to check if XAMPP is working; You should see XAMPP's default HTML docs or whatever projects you have used before in XAMPP
- Go back to the XAMPP client, and click on the "File" Explorer button, navigate to htdocs
- For new users to XAMPP, there will be files already in here, go ahead and create an empty folder inside htdocs, and move all the default files into this new folder
- Download this project (if not done when downloaded, have the contents contained in a folder with the name of your choosing), and drag the folder into htdocs
- Now use a code editor (for all intents and purposes, I will be using Brackets), and navigate to this project

Mac OSX:

Linux: (Work in progress)

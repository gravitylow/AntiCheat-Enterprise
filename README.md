AntiCheat-Enterprise
====================

<p align="center">
  <img src="http://i.imgur.com/TuRDVDv.png" alt="AntiCheat Logo"/>
  <br>AntiCheat Enterprise is a web panel used to control and monitor servers running AntiCheat 2.0's enterprise system.<br><br>
  <img src="http://i.imgur.com/LiJlELa.png" alt="AntiCheat Enterprise Level Editing"/>
</p>

Installation
-------

1. Install [AntiCheat 2.0 or higher](http://dev.bukkit.org/bukkit-plugins/anticheat/) to your Bukkit server
2. Start AntiCheat to generate its configuration files
3. Edit plugins/AntiCheat/enterprise.yml and configure your MySQL server's connection details. In this file you may additionally customize the server's name and other options.
4. When you've properly configured your enterprise settings, edit plugins/AntiCheat/config.yml and set the system.enterprise value to true
5. Restart AntiCheat, ensuring it properly connects to your database
6. Download the AntiCheat Enterprise Web Panel as either a [.zip](https://github.com/gravitylow/AntiCheat-Enterprise/zipball/master) or [.tar.gz](https://github.com/gravitylow/AntiCheat-Enterprise/tarball/master)
7. Move the contents of the 'website' folder found inside the archive to your webserver's root directory, or a subdirectory you wish to use, such as 'anticheat' (so that your panel can be accessed by http://yourdomain.com/anticheat).
8. Edit the config.php file and configure your MySQL server's connection details
9. Access the web panel by navigating to the directory where placed the website files in step 7 (such as http://yourdomain.com/anticheat).
10. Create a superuser using the installation interface, choosing a secure password for your new user. Once you have filled in the required fields, click the Install button.
11. Delete the install.php file and navigate back to your panel's index. You should now be able to login with your new username and password and use the AntiCheat Enterprise Web Panel.


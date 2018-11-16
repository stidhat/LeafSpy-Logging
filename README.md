# LeafSpy-Logging
Log output from Leafspy program and display information

Setup these files on your web server
Create the database and tables

In leaf spy open the settings screen, scroll down to the server section.
Click enable
Set desired interval
Enter an ID and PW
Select the protocol your server supports
Enter the URL where logrecord.php is hosted

In the leafspy.ini file update the fields for your installation. 
The applogin and apppassword fields will need to match the ID and PW entered above

TODO:
Check the PW so that it only logs when the password matches, the ID is saved in the User column in database

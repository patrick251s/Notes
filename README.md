# Notes

1.What is required for running the project?
  You must have a working server to run the project. For example you can use XAMPP, which is a popular www server for PHP.

2.Steps how to run scripts that will setup database for the project.
  Run your database server. If you don't have one, use the xampp package. Import project_notes.sql file into your database. If you need you can change a server name, username and password in the constructor of class Database in database.php file.

3.Steps how to build and run the project.
  Download Notes.zip and extract the files to the appropriate folder of your server (e.g. if you use xampp then extract to htdocs folder). Import the project_notes.sql file into your database. Then run your server. Enter address serverName/Notes

4.Example usages (i.e., like example curl commands to CRUD the notes).
  You can add your note by entering title, content and confirming. You have the option to edit the selected note. You can also delete your note. You can sort notes by a creation date, modification date, title or content. You have the additional option to view all your notes, including those deleted and modified
  <br />
  <br />
<img src="https://user-images.githubusercontent.com/80048198/228218119-1225bf1b-1bcd-459b-bb6a-383644a5c825.jpg" width="300" height="450">

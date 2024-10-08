How to use this repository:
- Install XAMPP and run MySQL and Apache Server
- Create database with the name is 'db_leads'
- Open localhost/phpmyadmin/
- Point to db_leads and copy paste the query from connection/db_leads.sql to create and insert the data
- Make a folder named 'leads_website' inside C://xampp/htdocs/ folder if you use Windows (/opt/lampp/htdocs/ folder in Ubuntu)
- Put all the project files to that folder
- Open your browser and type in localhost/leads_website/index.php and the page will ask you to input email (type in: adminUnitedTractor@gmail.com) and password (type in: adminUnitedTractor123 (it has to be persisted because the password is saved in SHA256 format))

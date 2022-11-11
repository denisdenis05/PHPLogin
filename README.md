# simple php site
A site with basic PHP stuff such as a login system | lang: RO


# What is that
This is a little side-project. The initial concept was to create a common space for teachers and students for 1 to 1 online classes. The project used custom css (and scss) files, a few elements still have a few custom classes but aren't defined anywhere. 
**This project focuses only on the PHP part**  

## What works:
### Account system

> login

> authentication

> mail verification by code

> forgot password system (by verifying the mail)

> Google Login

> profile pic upload


### Administration system

> data saved to a mySQL server, local or remote (see config.php)

There's no need for managing folders for upload as eveything, including images(URI), is saved as strings

> users with admin control can see the database (see adminpage.php and admindatabase.php)


### Screenshots
<br>
![first](https://imgur.com/YCbxDw4)
<br>
![second](https://imgur.com/2Viob3F)
<br>
![third](https://imgur.com/oVEOINw)
<br>
![fourth](https://imgur.com/eIrU51r)

# Dependencies needed:
## PHP:

> composer (or any other similar library)

> Google PHP SDK Client Library

> PHPMailer


### User registration  
**Description**:   
AS User   
I WANT to register to the Coding Certification discussion board   
SO THAT I can read discussions and contribute with my topics and messages  

**Scenarios**:   

#### I see the registration link  
GIVEN I'm a guest user  
AND I have a username and password  
WHEN I visit _D-BOARD URL_ /index.php  
THEN I see a _REGISTRATION_ link  
AND I see _SIGNIN_ link if SIGNIN project is completed  

##### I click on the registration link  
GIVEN I'm a guest user  
AND I visit _D-BOARD URL_ /index.php  
AND I see a _REGISTER_ link  
WHEN I click the _REGISTER_ link  
THEN I'm redirected on the _REGISTRATION_ page /register.php  
AND I see the _REGISTER TITLE_ label  
AND I see the _USERNAME_ field  
AND I see the _PASSWORD_ field  
AND I see the _RETYPE PASSWORD_ field  
(_OPTIONAL_)  
AND I see the _REGISTER BUTTON_ disabled  
(_OPTIONAL_)  

##### I register a new user on D-BOARD site   
GIVEN I'm a guest user  
AND I visit _D-BOARD URL_ /index.php  
AND I click the _REGISTER_ link  
AND I'm redirected on the _REGISTRATION_ page /register.php  
AND I see the _REGISTRATION_ page  
AND I type into the _USERNAME_ field 'my_new_username'  
AND I type into the _PASSWORD_ field '$mynewpassword&123'  
(_OPTIONAL_)  
WHEN I type into the _RETYPE PASSWORD_ field '$mynewpassword&123'  
THEN I see the _REGISTER BUTTON_ enabled  
(_OPTIONAL_)  
AND  
AND I type into the _RETYPE PASSWORD_ field '$mynewpassword&123'  
WHEN I click the _REGISTER BUTTON_  
THEN I see a confirmation message 'Registration successful, you can now Sign In in D-BOARD'  
AND I'm redirected to the _SIGNIN_ page after ~3 seconds  

##### Registration password match   
GIVEN I'm a guest user  
AND I visit _D-BOARD URL_ /index.php  
AND I click the _REGISTER_ link  
AND I'm redirected on the _REGISTRATION_ page /register.php  
AND I see the _REGISTRATION_ page  
AND I type into the _USERNAME_ field 'my_new_username'  
AND I type into the _PASSWORD_ field '$mynewpassword&123'  
(_OPTIONAL_)  
WHEN I type into the _RETYPE PASSWORD_ field 'anotherpass'  
THEN I see the _REGISTER BUTTON_ disabled  
AND I see a red message under _RETYPE PASSWORD_ field  
AND I see the red message is 'Password did not match, please type the same password into _PASSWORD_ field and into the _RETYPE PASSWORD_ field'  
(_OPTIONAL_)  
AND I type into the _RETYPE PASSWORD_ field 'anotherpass'  
WHEN I click the _REGISTER BUTTON_  
THEN I see the red message is 'Password did not match, please type the same password into _PASSWORD_ field and into the _RETYPE PASSWORD_ field'  

##### Existing username   
GIVEN I'm a guest user  
AND I visit _D-BOARD URL_ /index.php  
AND I previously registered a user with username 'my_existing_username'  
AND I click again on the _REGISTER_ link  
AND I'm redirected on the _REGISTRATION_ page /register.php  
AND I see the _REGISTRATION_ page  
AND I type into the _USERNAME_ field 'my_existing_username'  
AND I type into the _PASSWORD_ field 'anypassword'  
AND I type into the _RETYPE PASSWORD_ field 'anypassword'  
(_OPTIONAL_)  
AND I see the _REGISTER BUTTON_ enabled  
(_OPTIONAL_)  
WHEN I click the _REGISTER_ button  
THEN I see a red error message 'A user with the same username already exists, please choose a different username.'  

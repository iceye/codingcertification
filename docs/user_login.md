### User Login. 
**Description**:   
AS User   
I WANT to login into the Coding Certification discussion board   
SO THAT I can contribute with my name automatically added to my topics and messages  
AND I can see the Coding Certification website based on my culture and timezone  

**Scenarios**:   

#### I see the sign in link  
GIVEN I'm a guest user  
AND I have a username and password  
WHEN I visit _D-BOARD URL_ /index.php  
THEN I see a _SIGNIN_ link  
AND I see _REGISTRATION_ link if REGISTRATION project is completed  


##### I fill the sign fields  
GIVEN I'm a guest user  
AND I visit _D-BOARD URL_ /index.php  
AND I see a _SIGNIN_ link  
WHEN I click the _SIGNIN_ link  
THEN I'm redirected to the _SIGNIN_ page /signin.php  
AND I see the _SIGNIN TITLE_ label  
AND I see the _USERNAME_ field  
AND I see the _PASSWORD_ field  
(_OPTIONAL_)  
AND I see _SIGNIN BUTTON_ disabled   
AND  
WHEN I fill _USERNAME_ and _PASSWORD_ fields with some values  
THEN I see the _SIGNIN BUTTON_ enabled  
(_OPTIONAL_)  

##### I sign in link  
GIVEN I'm a guest user  
AND I previoulsy registered a new user with username 'myuser' and 'pass123!' as password  
AND I visit _D-BOARD URL_ /index.php  
AND I see a _SIGNIN_ link  
AND I click on _SIGNIN_ link  
AND I fill the _USERNAME_ field with 'myuser'  
AND I fill the _PASSWORD_ field with 'pass123!'  
WHEN I click the _SIGNIN BUTTON_  
THEN I'm redirected to /index.php  
AND I see 'Hi {username}' label on the _TOP RIGHT_ corner  

##### I sign fail  
GIVEN I'm a guest user  
AND I previoulsy registered a new user with username 'myuser' and 'pass123!' as password  
AND I visit _D-BOARD URL_ /index.php  
AND I see a _SIGNIN_ link  
AND I click on _SIGNIN_ link  
AND I fill the _USERNAME_ field with 'myuser'  
AND I fill the _PASSWORD_ field with 'pass123!wrong'  
WHEN I click the _SIGNIN BUTTON_   
THEN I'm redirected to /signin.php  
AND I see a red error message 'Login failed, please use a valid username and password.'  




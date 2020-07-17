### Messages
**Description**:   
AS User.  
I WANT to see the list of available messages for a topics and add my own message in the topic. 
SO THAT I can read all the contribuition from other users and add my own contribution. 

**Scenarios**: 

#### I see the topic detail page. 
GIVEN I visit _D-BOARD URL_. 
AND I have the topic 'My new wonderful topic' in my _D-BOARD_ platform  
AND I know the topic ID for 'My new wonderful topic' is 10  
AND I have 18 messages in the topic 'My new wonderful topic'  
WHEN I visit /topic.php?topicID=10&page=last  
THEN I see _TOPIC DETAIL_ page  
AND I see the _TOPIC TITLE_ at the top of the page  
AND I see the _OWNER_ label showing the username who created the topic  
AND I see the _CREATED AT_ label showing the date when the topic has been created  


#### I see the topic messages  
GIVEN I visit _D-BOARD URL_  
AND I have the topic 'My new wonderful topic' in my _D-BOARD_ platform  
AND I know the topic ID for 'My new wonderful topic' is 10  
AND I have 18 messages in the topic 'My new wonderful topic'  
WHEN I visit /topic.php?topicID=10&page=last  
THEN I see the list of _MESSAGES LIST_ in the topics  
AND I see the 8 newest message fro my topic  
AND I see the messages are ordered from the oldest to the most recent based on the message _CREATED AT_ date  
AND I see the _MESSAGES LIST_ are below the _TOPIC TITLE_,_OWNER_ and _CREATED AT_ labels  
AND I see at the end of the _MESSAGES LIST_ the _PAGINATION CONTROLS_  
AND I see a '>' link grayed out  
AND I see the number '1' and '2' clickable link  
AND I see the '<' clickable link  


#### I go to the next messages page  
GIVEN I visit _D-BOARD URL_  
AND I have the topic 'My new wonderful topic' in my _D-BOARD_ platform  
AND I know the topic ID for 'My new wonderful topic' is 10  
AND I have 18 messages in the topic 'My new wonderful topic'  
AND I visit /topic.php?topicID=10&page=last  
AND I see the list of _MESSAGES LIST_ in the topics  
AND I see at the end of the _MESSAGES LIST_ the _PAGINATION CONTROLS_  
AND I see a '>' link grayed out  
AND I see the number '1' and '2' clickable link  
AND I see the '<' clickable link  
WHEN I click on the '>' link into the _PAGINATION CONTROLS_   
THEN I'm redirected to /topic.php?topicID=10&page=2  
AND I see the same content in the new page  
AND  
WHEN I click on the '<' link into the _PAGINATION CONTROLS_   
THEN I'm redirected to /topic.php?topicID=10&page=1  
AND I see the 10 oldest messages for the topic ordered by _CREATED AT_ date from oldest to the most recent  


#### I see the new message form  
GIVEN I visit _D-BOARD URL_  
AND I login in as User  
AND I visit /topic.php?topicID=10&page=last  
AND I scroll to the end of the page  
THEN I see the _ADD NEW MESSAGE_ box  
AND I see the _MESSAGE_ textarea field in the _ADD NEW MESSAGE_  
(_OPTIONAL_)  
AND I see the _ADD_ disabled button in the _ADD NEW MESSAGE_  
(_OPTIONAL_)  

#### I add a new message  
GIVEN I visit _D-BOARD URL_  
AND I login in as User  
AND I visit /topic/10  
AND I scroll to the end of the page  
THEN I see the _ADD NEW MESSAGE_ box  
AND I see the _MESSAGE_ textarea field in the _ADD NEW MESSAGE_  
(_OPTIONAL_)  
AND I see the _ADD_ disabled button in the _ADD NEW MESSAGE_  
WHEN I type 'My new wonderful message for all my friends' in the _MESSAGE_ textarea field  
THEN I see the _ADD_ button enabled  
AND  
(_OPTIONAL_)  
AND I type 'My new wonderful message for all my friends' in the _MESSAGE_ textarea field  
WHEN I click the _ADD_ button  
THEN I see the message 'Your message has been shared in this topic.'  
AND I'm redirected to /topic.php?topicID=10&page=2 after few seconds  
AND I see my new message at the end of the _MESSAGES LIST_  



1. What is the difference between a cookie and a session?

If you save information in a cookie, it will remain on your computer for
a period of time (days, weeks)and be returned to the server with every request.
If you store information as a session, its stored on the server and a 
token is sent to the browser.Sessions normally expire when the browser is closed.


2. Where is each one stored (browser or server)?

A cookie in the browser. Session data on the server. 
Just the session ID cookie (PHPSESSID) in the browser.

3. Why do we use prepared statements?

Prepared statements isolate user input from the SQL command so the input is treated 
only as data and not as part of the command. This prevents SQL injection.

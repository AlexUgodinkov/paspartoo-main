<?php exit; ?>
[2021-06-04 16:30:08] ERROR: Form 2558 > Mailchimp API error: 400 Bad Request. Invalid Resource. Your merge fields were invalid. 
- MMERGE6 : Please enter a value

Request: 
POST https://us1.api.mailchimp.com/3.0/lists/d2b92e907e/members

{"status":"pending","email_address":"sshl****@ev*****.com","interests":{},"merge_fields":{},"email_type":"html","ip_signup":"94.232.75.50","tags":[]}

Response: 
400 Bad Request
{"type":"https://mailchimp.com/developer/marketing/docs/errors/","title":"Invalid Resource","status":400,"detail":"Your merge fields were invalid.","instance":"0935713b-96cf-17d4-1bcc-de5b99b72ca5","errors":[{"field":"MMERGE6","message":"Please enter a value"}]}

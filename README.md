# Core php REST API with JWT Authentication - DDD Approach
## Environment - Requirements
1. Php >= 7.4
2. Mysql >= 5.7
3. Composer
## Setup
1. Clone this repo\
``git clone``
2. Goto working dir
`cd ...`
3. Run composer to install jwt package
`composer install`
4. Edit db connection string in config/Constants.php
`'HOSTNAME' => 'localhost',
        'USERNAME' => 'root',
        'PASSWORD' => 'password',
        'DATABASE' => 'demo',`
5. Run the local web server
`php -S localhost:8000`
## Usage
### Use Curl or Postman
- Login to get token string:\
`curl --location --request POST 'http://localhost:8000/api/auth/login' \
--header 'Content-Type: application/json' \
--data-raw '{
    "username": "user1",
    "password": "password1"
}'`
- Sample response:\
`{
    "id": "1",
    "username": "user1",
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InVzZXIxIiwiaWF0IjoxNjY5NzIxMTA5LCJleHAiOjE2Njk4MDc1MDl9.DogtwMfi-gr2TWmdPLRILCFKc8PbCdL6bqawxLiNTjA"
}`

- Create Post (replace Bearer token with login token above)
`curl --location --request POST 'http://localhost:8000/api/post' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InVzZXIxIiwiaWF0IjoxNjY5NzE5ODk4LCJleHAiOjE2Njk4MDYyOTh9.dIrxwBonxVjycMquPOAJKJ9BFkyx7UZ-rdqnGKfJG08' \
--data-raw '{
    "category":"cat 1",
    "title":"sample title",
    "body":"sample body",
    "author":"sample author"
}'`
- Response:\
`{"message":"new post created"}`

- Update Post (replace Bearer token with login token above)
`curl --location --request PUT 'http://localhost:8000/api/post/1' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InVzZXIxIiwiaWF0IjoxNjY5NzE5ODk4LCJleHAiOjE2Njk4MDYyOTh9.dIrxwBonxVjycMquPOAJKJ9BFkyx7UZ-rdqnGKfJG08' \
--data-raw '{
    "category": "cat 1",
    "title": "post1",
    "body": "post1 desc",
    "author": "author1",
    "create_at": null
}'`
- Response:\
`{"message": "post updated"}`

- Delete Post (replace Bearer token with login token above)
`curl --location --request DELETE 'http://localhost:8000/api/post' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InVzZXIxIiwiaWF0IjoxNjY5NzE5ODk4LCJleHAiOjE2Njk4MDYyOTh9.dIrxwBonxVjycMquPOAJKJ9BFkyx7UZ-rdqnGKfJG08' \
--data-raw '{
    "id":"1"
}'`
- Response:\
`{"message": "deleted"}`
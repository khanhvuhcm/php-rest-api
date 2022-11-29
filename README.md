# Core php REST API with JWT Authentication - DDD Approach
## Environment - Requirements
1. Php >= 7.4
2. Mysql >= 5.7
3. Composer
## Setup
1. Create working dir\
`mkdir php-rest-api`
2. Goto working dir\
`cd php-rest-api`
3. Clone this repo\
`git clone https://github.com/khanhvuhcm/php-rest-api .`
4. Run composer to install jwt package\
`composer install`
5. Edit db connection string in config/Constants.php\
`'HOSTNAME' => 'localhost',
        'USERNAME' => 'root',
        'PASSWORD' => 'password',
        'DATABASE' => 'demo',`
6. Import database from ./demo.sql
5. Run the local web server\
`php -S localhost:8000`
## Usage
### Use Curl or Postman
- Create User:\
`curl --location --request POST 'http://127.0.0.1:8000/api/auth/create' \
--header 'Content-Type: application/json' \
--data-raw '{
    "username": "user1",
    "password": "password1",
    "role": "1"
}'`
- Sample response:\
`{
    "message": "new user created"
}`

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

- Create Post (replace Bearer token with login token above)\
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

- Update Post (replace Bearer token with login token above)\
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

- Delete Post (replace Bearer token with login token above)\
`curl --location --request DELETE 'http://localhost:8000/api/post' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InVzZXIxIiwiaWF0IjoxNjY5NzE5ODk4LCJleHAiOjE2Njk4MDYyOTh9.dIrxwBonxVjycMquPOAJKJ9BFkyx7UZ-rdqnGKfJG08' \
--data-raw '{
    "id":"1"
}'`
- Response:\
`{"message": "deleted"}`
# Newsifier Test project

## 1. DB Username & Password

Make a mysql database and put the name, username and password of the database in the `.env` file after you copy it from `.env.example`

```
DB_DATABASE=newsifier_test
DB_USERNAME=root
DB_PASSWORD=
```

## 2. Migrate the DB

To run the project you must migrate the schema to the database using the command:

```Bash
php artisan migrate
```

## 3. Seed the DB

The command:

```Bash
php artisan db:seed
```

will fill the database with 100,000 record of user random data

## 4. Call the API

Then in this step every thing is ready to call the api and see the result you will need a `user ID` to call the api on it. you can choose from 1 -> 100,000 and it will work

```http
GET http://127.0.0.1:8000/api/v1/user/{id}/karma-position?count=9
```

For Example:

```http
GET http://127.0.0.1:8000/api/v1/user/87688/karma-position?count=9
```

You can choose the number of returned result using the count query parameter.

If you choose an `ID` with the position `1` or `last position` the api with return always `count` number of records.

The test case will test if the response status code is equal to `200`.
I did not understand what to test since the data will be random and the test case will change every time we seed the table.
To run the test

```
php artisan test
```

The api return a view with a table to show the result.

I seeded the db with only one image and I used this image in all the records because creating 100,000 image will take for ever, since I use phpFaker to create an image in the storage to be used in the view.

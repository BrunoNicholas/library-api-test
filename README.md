# Library Management API

Welcome to the Library management System API. 
This API is to manage book checkouts and details.

Please follow the instructions that follow.

- [Installation](#installation)
  - [1. Windows](#windows)
  - [2. Linux](#linux)
- [Configuration](#configuration)

- [API Usage](#usage)
  - [Getting All](#getting-all)
    - [Users](#users)
    - [Books](#sermons)
    - [Users with books](#user-books)
  - [Getting One](#one)
  - [Create Item](#create-item)
  - [Edit Item](#edit-item)
  - [Deleting Item](#deleting-item)
  - [Authentication](#authentication)

- [Platforms](#platforms)
- [License & Copyright](#license)
- [Development](#development)

## Installation

The project can either be installed on a linux server or a windows server given the choice of the operating system from the above.

### 1. Windows

If you have [Git](https://git-scm.com/) download the project by opening a command prompt (cmd) in the *www* or *htdocs* of the local server and start *Apache & MySQL*. Clone the repo as this

```bash
    git clone https://gitlab.com/epione-tests/brunonicholas-be.git
```

or download the folder and extract the file in the server directory environment

The default link for the app is

```url
    http://localhost/api/
```
or if run in a development environment 
```url
    http://localhost:PORT_NUMBER/api/
```
or when in a windows local server
```url
    http://localhost/public/api/
```

### 2. Linux

Make sure you have your local server working well, for instance LAMP for Linux e.g Ubuntu.
Find out how to run Laravel installation on Apache server and know the name of *YOUR_FOLDER* from which you will call the project after clonning it in the example above for windows installation.

```bash
    http://localhost/YOUR_FOLDER/api/
 ```

Likewise you might use the artisan command on the internal Laravel server as and

 ```bash
    composer install
    composer update
    php artisan serve --port 5000
 ```

 NB: You can either exclude *--port 5000* for the default port 8000 or use any available of choice. In this case, here is the url

 ```bash
    http://localhost:5000/api/
 ```

## Configuration

Next step is to configure the project. Locate the *.env.example*, copy all its content and create a new file called *.env* and update these Fields to your created database name.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=YOUR_DB
DB_USERNAME=YOUR_USERNAME
DB_PASSWORD=YOUR_PASSWORD
```

either use the bash command to use a fresh database

```bash
    php artisan migrate:fresh --seed
    php artisan passport:install
```

Make sure to create the App Security Key which is automatically generated with this command

```bash
    php artisan key:generate 
```


## API Usage

This API is intended for examination purposes and not meant for production of any kind.


### Getting All

| **Request** | **Route** | **Category**   |
| ----------- | --------- | -------------- |
| *GET* | ```http://localhost:5000/api/users``` | Users |
| *GET* | ```http://localhost:5000/api/books``` | Books |
| *GET* | ```http://localhost:5000/api/userbooks``` | Users with books |

### View One

| **Request** | **Route** | **Category**   |
| ----------- | --------- | -------------- |
| *GET*    | ```http://[THE LINKS ON [Getting All]]/1``` | One Item |

NB: *1* in the route above can be any number of choice

### Create Item

| **Request** | **Route** | **Category**   |
| ----------- | --------- | -------------- |
| *POST*    | ```http://[THE LINKS ON [Getting All]]``` | Add Item |

NB: You can  test this with Postman for all routes put there, make sure you made the [Configuration](#configuration) correctly.. This route needs authentication with token.

### Edit Item

| **Request** | **Route** | **Category**   |
| ----------- | --------- | -------------- |
| *PUT*    | ```http://[THE LINKS [Getting All]]/1``` | Edit Item |

NB: *1* in the route above can be any number of choice, make sure you made the [Configuration](#configuration). This route needs authentication.

### Deleting Item

| **Request** | **Route** | **Category**   |
| ----------- | --------- | -------------- |
| *DELETE*    | ```http://[THE LINKS [Getting All]]/1``` | Delete Item |

NB: *1* in the route above can be any number of choice, make sure you made the [Configuration](#configuration). This route needs authentication.

### Authentication

You use this to access the protected endpoints

| **Request** | **Route** | **Category**   |
| ----------- | --------- | -------------- |
| *GET* | ```http://localhost:5000/api/auth/user``` | Auth user |
| *POST* | ```http://localhost:5000/api/auth/login``` | Login |
| *POST* | ```http://localhost:5000/api/auth/logout``` | Logout |


## Platforms

This project is designed to be a web application that is sstaged into the following:

1. The API

This repo is intended fo the API and so endpoints, data and JWT are expected here

2. The Frontend

It is mainly of a fron-end framework that persues to consume this API.

## License & Copyright

This is a Test Application is of the MIT License but strictly a property of OWNERS as referenced by [Bruno Nicholas](#developement).

## Development

By [Bruno Nicholas](mailto:bruno.nicholas55@gmail.com)

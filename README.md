# PR-API

## methods
| methods  | path        | описание |
| -------- |:------------|---------:|
| POST     | /auth/login | регистрация и авторизация пользоватля |
||||
| GET      | /user       | получение данных о пользователе по токену|   
| PUT      | /user       | обновление данных пользователя |   
| GET      | /users       | получение данных обо всех пользователях системы |   
||||
|POST      | /perfRequest| Создание нового PerformanceRequest |
|PUT       | /perfRequest/{id}| обновление, редактирование PR |
|GET      | /perfRequest | получить все PR по токену|
||||
|POST|/comment|создание отзыва на PR|
|PUT|/comment/{id}|редактирвоание отзыва|
|GET|/comment/{prID}|просмотр всех отзывов по PR|
||||
|POST      | /selfReveiw| Создание нового SR |
|PUT       | /selfReveiw/{id}| обновление, редактирование SR |
|GET      | /selfReview/{id} | получить SR|
||||


1. ## /auth/login POST
    ### Request: 
    
    Заголовки: default

    Обязательные параметры:
    - `phone` - номер телефона пользвоателя

    Необязательные параметры:
    - `fio` - Фамилия Имя Отчество пользователя
    - `name` - Короткое имя пользователя
    
    ### Response:
    - `id` - id пользователя
    - `token` - токен пользователя

    ### Example:
    ```bash
    # request
    curl --request POST \
    --url http://192.168.0.111:8234/auth/login \
    --header 'Content-Type: application/json' \
      --data '{
	    "phone":"79511234578",
	    "fio": "Matyukhin Danil"
        "name": "TruePi4"
    }'
    # response
    {
        "token": "cadfc12cd20c6ac48e86055b6c7ad48e"
    }
    ```

1. ## /user  GET
    ### Request: 
    Заголовки:
    - Authorization: Bearer

    ### Response:
    - `id` - id пользователя
    - `phone` - телефон пользователя
    - `fio` - ФИО
    - `name` - короткое имя

    ### Example:
    ```bash
    # request
    wget --quiet \
      --method GET \
      --header 'Authorization: Bearer cadfc12cd20c6ac48e86055b6c7ad48e' \
      - http://192.168.0.111:8234/

    # response
    {
      "phone": "79511234578",
	  "fio": "Matyukhin Danil",
      "name": "TruePi4"
    }
    ```

2. ## /user  PUT
   ### Request: 
    Заголовки:
    - Authorization: Bearer

    Обязательные параметры:
    - `id` - id пользователя

    Необязательные параметры:
    *(изменяемые добавляемые)*
    - `phone`
    - `fio`
    - `name`

    ### Response:
    - `id` - id пользователя
    - `phone`
    - `fio`
    - `name`
    
    ### Example:
    ```bash
    # request

    # response
    ```

2. ## /users  GET
   ### Request: 
    Заголовки:
    - Authorization: Bearer

    ### Response:
    *массив пользователей*
    - `id` - id пользователя
    - `phone`
    - `fio`
    - `name`
	
    
    ### Example:
    ```bash
    # request

    # response
    ```


# PR-API

## methods
| methods  | path        | описание |
| -------- |:------------|---------:|
| POST     | [/auth/login](#authlogin-post) | регистрация и авторизация пользоватля |
||||
| GET      | [/user](#user--get)      | получение данных о пользователе по токену|   
| PUT      | [/user](#user--put)       | обновление данных пользователя |   
| GET      | [/users](#users--get)       | получение данных обо всех пользователях системы |   
||||
|POST      | [/perfRequest](#perfrequest-post)| Создание нового PerformanceRequest |
|PUT       | [/perfRequest/{id}](#perfrequestid-put)| обновление, редактирование PR |
|GET      | [/perfRequest](#perfrequest-get) | получить все PR по токену|
||||
|POST|[/comment](#comment-post)|создание отзыва на PR|
|PUT|[/comment/{id}](#commentid-put)|редактирвоание отзыва|
|GET|[/comment/{prID}](#commentprid-get)|просмотр всех отзывов по PR|
||||
|POST      | [/selfReveiw](#selfreveiw-post)| Создание нового SR |
|PUT       | [/selfReveiw/{id}](#selfreveiwid-put)| обновление, редактирование SR |
|GET      |  [/selfReview/{id}](#selfreveiwid-get) | получить SR|
||||


## /auth/login POST
   ### Request: 
   Заголовки: 
   - default 
  
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
## /user  GET
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
## /user  PUT
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
## /users  GET
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

## /perfRequest POST
   ### Request: 
   Заголовки: 
   - Authorization: Bearer

   Обязательные параметры:
   - `managerID` - id менеджера, который проводит PR
   Необязательные параметры:
   - `selfReviewID` - 
   - 
   ### Response:
   - `id` - id PR (aka prID)

   ### Example:
   ```bash
   # request
   # response
   ```

## /perfRequest GET
   ### Request: 
   Заголовки: 
   - Authorization: Bearer

   Обязательные параметры:
   - .
   Необязательные параметры:
   - .
   
   ### Response:
   - данные по всем PR для пользоателя определяемого токеном

   ### Example:
   ```bash
   # request
   # response
   ```

## /perfRequest/{id} PUT
   ### Request: 
   Заголовки: 
   - Authorization: Bearer

   Обязательные параметры:
   - .
   Необязательные параметры:
   - .
   
   ### Response:
   - `id` - id PR (aka prID)
   - все данные по PR

   ### Example:
   ```bash
   # request
   # response
   ```

## /comment POST
   ### Request: 
   Заголовки: 
   - Authorization: Bearer

   Обязательные параметры:
   - `prID` - id PR 
   Необязательные параметры:
   - `rating` оценка
   - `status` статус отзыва (новый, опубликованный)
   - `hidden` скрытое или нет bool, default true
   - `text` текст коммента\отзыва
   
   ### Response:
   - `id` - id comment
   - все данные по comment

   ### Example:
   ```bash
   # request
   # response
   ```
## /comment/{id} PUT
   ### Request: 
   Заголовки: 
   - Authorization: Bearer

   Обязательные параметры:
   - `prID` id PR
   Необязательные параметры:
   - изменяемые параметры
   
   ### Response:
   - все данные по comment

   ### Example:
   ```bash
   # request
   # response
   ```
## /comment/{prID} GET
   ### Request: 
   Заголовки: 
   - Authorization: Bearer

   Обязательные параметры:
   - .
   Необязательные параметры:
   - .
   
   ### Response:
   - массив comment

   ### Example:
   ```bash
   # request
   # response
   ```

## /selfReveiw POST
   ### Request: 
   Заголовки: 
   - Authorization: Bearer

   Обязательные параметры:
   - .
   Необязательные параметры:
   - .
   
   ### Response:
   - 

   ### Example:
   ```bash
   # request
   # response
   ```

## /selfReveiw{id} PUT
   ### Request: 
   Заголовки: 
   - Authorization: Bearer

   Обязательные параметры:
   - .
   Необязательные параметры:
   - .
   
   ### Response:
   - 

   ### Example:
   ```bash
   # request
   # response
   ```

## /selfReveiw/{id} GET
   ### Request: 
   Заголовки: 
   - Authorization: Bearer

   Обязательные параметры:
   - .
   Необязательные параметры:
   - .
   
   ### Response:
   - 

   ### Example:
   ```bash
   # request
   # response
   ```
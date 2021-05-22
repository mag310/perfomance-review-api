# PR-API

## methods
| methods  | path        | описание |
| -------- |:------------|---------:|
| POST     | [/auth/login](#authlogin-post) | регистрация и авторизация пользоватля |
| GET      | [/auth/logout](#authlogout-post) | logout |
||||
| GET      | [/user](#user-get)      | получение данных о пользователе по токену|   
| PUT      | [/user](#user-put)       | обновление данных пользователя |   
| GET      | [/user/list](#userlist-get)       | получение данных обо всех пользователях системы |   
| GET      | [/user/info/{id}](#userinfoid-get)       | получение данных по пользователю системы |   
||||
|POST      | [/pr](#pr-post)| Создание нового PerformanceRequest |
|PUT       | [/pr/{id}](#prid-put)| обновление, редактирование PR |
|GET       | *[/pr](#pr-get)| получить объект PR для текущего пользователя |
||||
|POST      |[/comment](#comment-post)|создание отзыва на PR|
|PUT       |[/comment/{id}](#commentid-put)|редактирвоание отзыва|
|GET       |*[/comment/{prID}](#commentprid-get)|просмотр всех отзывов по PR|
||||
|POST      | *[/selfReveiw](#selfreveiw-post)| Создание нового SR |
|PUT       | *[/selfReveiw/{id}](#selfreveiwid-put)| обновление, редактирование SR |
|GET       | *[/selfReview/{id}](#selfreveiwid-get) | получить SR|
||||
|GET       |  [/chat/message](#chatmessage-get) | получить сообщения для отправки пользователю|
||||

**- метод не реализован*

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
## /auth/logout GET
    response:
    204 No Content

## /user GET
   ### Request: 
   Заголовки:
   - Authorization: Bearer
   ### Response:
   - `id` - id пользователя
   - `phone` - телефон пользователя
   - `fio` - ФИО
   - `authToken` токен пользователя
   - `chatId` id чата телеграм
   ### Example:
   ```bash
   # request
   wget --quiet \
     --method GET \
     --header 'Authorization: Bearer cadfc12cd20c6ac48e86055b6c7ad48e' \
     - http://192.168.0.111:8234/
   # response
   {
     "id": "b3c90f5a-40b4-46f0-9efc-5c0e9f6e019d",
     "phone": "79517898136",
     "fio": "Matyukhin Danil",
     "authToken": "cadfc12cd20c6ac48e86055b6c7ad48e",
     "chatId": null
   }
   ```
## /user PUT
   ### Request: 
   Заголовки:
   - Authorization: Bearer

   Обязательные параметры:
   - `id` - id пользователя
   Необязательные параметры:
   *(изменяемые добавляемые)*
   - `phone` - телефон пользователя
   - `fio` - ФИО
   - `authToken` токен пользователя
   - `chatId` id чата телеграм
   ### Response:
   - `id` - id пользователя
   - `phone` - телефон пользователя
   - `fio` - ФИО
   - `authToken` токен пользователя
   - `chatId` id чата телеграм
   ### Example:
   ```bash
   # request
   # response
   ```
## /user/list GET
   ### Request: 
   Заголовки:
   - Authorization: Bearer

   ### Response:
   *массив пользователей*
   - `id` - id пользователя
   - `phone` - телефон пользователя
   - `fio` - ФИО
   - `authToken` токен пользователя
   - `chatId` id чата телеграм
   ### Example:
   ```bash
   # request
   # response
   ```

## /user/info/{id} GET
   ### Request: 
   Заголовки:
   - Authorization: Bearer

   ### Response:
   - `id` - id пользователя
   - `phone` - телефон пользователя
   - `fio` - ФИО
   - `authToken` токен пользователя
   - `chatId` id чата телеграм
   ### Example:
   ```bash
   # request
   # response
   ```

## /pr POST
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

## /pr/{id} PUT
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
## /chat/message GET
   ### Request: 
   Заголовки: 
   - .
   - 
   Обязательные параметры:
   - .
   
   Необязательные параметры:
   - .
   
   ### Response:
   - *массив с сообщениями для пользователей*
   - `chatId`  id телеграм чата
   - `message` сообщение, которое нужно отправить пользователю

   ### Example:
   ```bash
   # request
   # response
   ```
   
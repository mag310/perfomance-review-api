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

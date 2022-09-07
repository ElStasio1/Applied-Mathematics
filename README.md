# Русский

Сайт по прикладной математике

Реализовать сайт-блог по прикладной математике. Задачи, которые должны быть решены: создание базы данных, добавление статей в общую базу, сортировка статей по трем категориям (математика; механика; электромеханика), комментирование статей, регистрация пользователей, авторизация на сайте.
	Должно быть реализовано 4 роли: 
1.	Гость
2.	Читатель
3.	Администратор

  Гость – посетитель сайта, который может читать статьи и комментарии других пользователей.
Функционал гостя: просмотр информационных страниц сайта; просмотр статей; регистрация на сайте; авторизация на сайте.

	Читатель – это пользователь, который читает и комментирует статьи на сайте, то есть зарегистрированный пользователь.
Функционал читателя: комментировать статьи, читать статьи, просматривать свои данные и редактировать их и добавлять статьи в избранное.

	Администратор – зарегистрированный привилегированный пользователь сайта, прошедший авторизацию.
Функционал администратора: просмотр статей; возможность добавлять, удалять и редактировать статьи.

Исходные данные для БД:
Набор таблиц БД – Статьи, Избранные статьи, Пользователи.

Таблица «Статьи» имеет поля: ID статьи, название, описание, текст, компилированный текст, ключевые слова, категория, дата и время ее размещения, количество комментариев.

Таблица «Избранные статьи» имеет поля: номер избранной статьи, название, описание, текст, компилированный текст, ключевые слова, категория, количество комментариев дата и время ее размещения, ID статьи, ID пользователя.

Таблица «Пользователи» имеет поля: ID пользователя, имя, логин, электронная почта, пароль, статус.

# English 

Applied-Mathematics

Implement a website-blog on applied mathematics. Tasks to be solved: creating a database, adding articles to a common database, sorting articles into three categories (mathematics; mechanics; electromechanics), commenting on articles, user registration, authorization on the site.
 4 roles must be implemented: 
1. Guest
2. The reader
3. Administrator

A guest is a site visitor who can read articles and comments from other users.
Guest functionality: viewing information pages of the site; viewing articles; registration on the site; authorization on the site.

 A reader is a user who reads and comments on articles on the site, that is, a registered user.
Reader functionality: comment on articles, read articles, view your data and edit them and add articles to favorites.

 The administrator is a registered privileged user of the site who has passed authorization.
Admin functionality: viewing articles; ability to add, delete and edit

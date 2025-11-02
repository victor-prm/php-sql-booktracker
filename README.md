These docs are auto-generated from postman_collection.json.

# Book Tracker

A RESTful API for managing books, authors, and genres. It allows clients to:

- Retrieve lists of books, authors, and genres with optional pagination.
    
- View detailed information about a single book, author, or genre.
    
- Add or update books and authors (editor/admin only).
    
- Delete books (admin only).
    

All GET requests are publicly accessible. Modifying data is restricted based on user roles: **editor** for creating/updating and **admin** for deletion. Each resource includes hypermedia links for easy navigation between previous and next items.

| Type | Key | Value |
|---|---|---|
| <img src="https://img.shields.io/badge/VARIABLE-darkslategrey?style=flat-square&rounded=true" alt="VARIABLE" style="height:18px; vertical-align:middle; margin-right:2px;"> | `base_url` | `http://localhost:8888/booktracker` |
| <img src="https://img.shields.io/badge/HEADER-orange?style=flat-square&rounded=true" alt="HEADER" style="height:18px; vertical-align:middle; margin-right:2px;"> | `X-Authorization` | `Bearer EDITOR_TOKEN` |
| <img src="https://img.shields.io/badge/HEADER-orange?style=flat-square&rounded=true" alt="HEADER" style="height:18px; vertical-align:middle; margin-right:2px;"> | `X-Authorization` | `Bearer ADMIN_TOKEN` |


## 📁 1. Books endpoint

Manage and retrieve information about books in the API. Each book includes expandable metadata such as title, authors, main genre, subgenres, publication year, page count, reading status, frontpage image, and summary. Endpoints allow listing, fetching single books, and (for authorized users) creating, updating, or deleting books.

| Method | Description | Endpoint | Role |
|---|---|---|---|
| <img src="https://img.shields.io/badge/GET-mediumseagreen?style=flat-square&rounded=true" alt="GET" style="height:18px; vertical-align:middle; margin-right:2px;"> | All Books - Paginated | `/books?offset=20&limit=3` | <img src="https://img.shields.io/badge/Public-mediumseagreen?style=flat-square&rounded=true" alt="Public" style="height:18px; vertical-align:middle; margin-right:2px;"> |
| <img src="https://img.shields.io/badge/GET-mediumseagreen?style=flat-square&rounded=true" alt="GET" style="height:18px; vertical-align:middle; margin-right:2px;"> | All Books - Expanded | `/books?expand=genres,authors,frontpage_img,year,description` | <img src="https://img.shields.io/badge/Public-mediumseagreen?style=flat-square&rounded=true" alt="Public" style="height:18px; vertical-align:middle; margin-right:2px;"> |
| <img src="https://img.shields.io/badge/GET-mediumseagreen?style=flat-square&rounded=true" alt="GET" style="height:18px; vertical-align:middle; margin-right:2px;"> | All Books - Filter | `/books?main_genre_id=11&sub_genre_id=14` | <img src="https://img.shields.io/badge/Public-mediumseagreen?style=flat-square&rounded=true" alt="Public" style="height:18px; vertical-align:middle; margin-right:2px;"> |
| <img src="https://img.shields.io/badge/GET-mediumseagreen?style=flat-square&rounded=true" alt="GET" style="height:18px; vertical-align:middle; margin-right:2px;"> | All Books - Search | `/books?q=society` | <img src="https://img.shields.io/badge/Public-mediumseagreen?style=flat-square&rounded=true" alt="Public" style="height:18px; vertical-align:middle; margin-right:2px;"> |
| <img src="https://img.shields.io/badge/GET-mediumseagreen?style=flat-square&rounded=true" alt="GET" style="height:18px; vertical-align:middle; margin-right:2px;"> | Single Book | `/books?id=9` | <img src="https://img.shields.io/badge/Public-mediumseagreen?style=flat-square&rounded=true" alt="Public" style="height:18px; vertical-align:middle; margin-right:2px;"> |
| <img src="https://img.shields.io/badge/POST-yellow?style=flat-square&rounded=true" alt="POST" style="height:18px; vertical-align:middle; margin-right:2px;"> | New Book | `/books/` | <img src="https://img.shields.io/badge/Editor-yellow?style=flat-square&rounded=true" alt="Editor" style="height:18px; vertical-align:middle; margin-right:2px;"><br><img src="https://img.shields.io/badge/Admin-red?style=flat-square&rounded=true" alt="Admin" style="height:18px; vertical-align:middle; margin-right:2px;"> |
| <img src="https://img.shields.io/badge/PUT-blue?style=flat-square&rounded=true" alt="PUT" style="height:18px; vertical-align:middle; margin-right:2px;"> | Edit Book | `/books?id=74` | <img src="https://img.shields.io/badge/Editor-yellow?style=flat-square&rounded=true" alt="Editor" style="height:18px; vertical-align:middle; margin-right:2px;"><br><img src="https://img.shields.io/badge/Admin-red?style=flat-square&rounded=true" alt="Admin" style="height:18px; vertical-align:middle; margin-right:2px;"> |
| <img src="https://img.shields.io/badge/DELETE-salmon?style=flat-square&rounded=true" alt="DELETE" style="height:18px; vertical-align:middle; margin-right:2px;"> | Delete Book | `/books?id=74` | <img src="https://img.shields.io/badge/Admin-red?style=flat-square&rounded=true" alt="Admin" style="height:18px; vertical-align:middle; margin-right:2px;"> |
| <img src="https://img.shields.io/badge/OPTIONS-deeppink?style=flat-square&rounded=true" alt="OPTIONS" style="height:18px; vertical-align:middle; margin-right:2px;"> | All Books | `/books` | <img src="https://img.shields.io/badge/Public-mediumseagreen?style=flat-square&rounded=true" alt="Public" style="height:18px; vertical-align:middle; margin-right:2px;"> |


## 📁 2. Authors endpoint

Manage and retrieve author information. Each author entry includes name, biography, birth year, and a list of their associated books. Endpoints allow listing all authors, fetching details for a single author, and (for authorized users) adding or updating author records.

| Method | Description | Endpoint | Role |
|---|---|---|---|
| <img src="https://img.shields.io/badge/GET-mediumseagreen?style=flat-square&rounded=true" alt="GET" style="height:18px; vertical-align:middle; margin-right:2px;"> | All Authors - Paginated | `/authors` | <img src="https://img.shields.io/badge/Public-mediumseagreen?style=flat-square&rounded=true" alt="Public" style="height:18px; vertical-align:middle; margin-right:2px;"> |
| <img src="https://img.shields.io/badge/GET-mediumseagreen?style=flat-square&rounded=true" alt="GET" style="height:18px; vertical-align:middle; margin-right:2px;"> | All Authors - Filter | `/authors?birth_year=1892` | <img src="https://img.shields.io/badge/Public-mediumseagreen?style=flat-square&rounded=true" alt="Public" style="height:18px; vertical-align:middle; margin-right:2px;"> |
| <img src="https://img.shields.io/badge/GET-mediumseagreen?style=flat-square&rounded=true" alt="GET" style="height:18px; vertical-align:middle; margin-right:2px;"> | All Authors - Search | `/authors?q=her` | <img src="https://img.shields.io/badge/Public-mediumseagreen?style=flat-square&rounded=true" alt="Public" style="height:18px; vertical-align:middle; margin-right:2px;"> |
| <img src="https://img.shields.io/badge/GET-mediumseagreen?style=flat-square&rounded=true" alt="GET" style="height:18px; vertical-align:middle; margin-right:2px;"> | Single Author | `/authors?id=4` | <img src="https://img.shields.io/badge/Public-mediumseagreen?style=flat-square&rounded=true" alt="Public" style="height:18px; vertical-align:middle; margin-right:2px;"> |
| <img src="https://img.shields.io/badge/POST-yellow?style=flat-square&rounded=true" alt="POST" style="height:18px; vertical-align:middle; margin-right:2px;"> | New Author | `/authors/` | <img src="https://img.shields.io/badge/Editor-yellow?style=flat-square&rounded=true" alt="Editor" style="height:18px; vertical-align:middle; margin-right:2px;"><br><img src="https://img.shields.io/badge/Admin-red?style=flat-square&rounded=true" alt="Admin" style="height:18px; vertical-align:middle; margin-right:2px;"> |
| <img src="https://img.shields.io/badge/PUT-blue?style=flat-square&rounded=true" alt="PUT" style="height:18px; vertical-align:middle; margin-right:2px;"> | Edit Author | `/authors?id=71` | <img src="https://img.shields.io/badge/Editor-yellow?style=flat-square&rounded=true" alt="Editor" style="height:18px; vertical-align:middle; margin-right:2px;"><br><img src="https://img.shields.io/badge/Admin-red?style=flat-square&rounded=true" alt="Admin" style="height:18px; vertical-align:middle; margin-right:2px;"> |
| <img src="https://img.shields.io/badge/DELETE-salmon?style=flat-square&rounded=true" alt="DELETE" style="height:18px; vertical-align:middle; margin-right:2px;"> | Delete Author | `/authors?id=71` | <img src="https://img.shields.io/badge/Admin-red?style=flat-square&rounded=true" alt="Admin" style="height:18px; vertical-align:middle; margin-right:2px;"> |
| <img src="https://img.shields.io/badge/OPTIONS-deeppink?style=flat-square&rounded=true" alt="OPTIONS" style="height:18px; vertical-align:middle; margin-right:2px;"> | All Authors | `/authors` | <img src="https://img.shields.io/badge/Public-mediumseagreen?style=flat-square&rounded=true" alt="Public" style="height:18px; vertical-align:middle; margin-right:2px;"> |


## 📁 3. Genres endpoint

Manage and retrieve genre information for books. Each genre includes its name and a list of books associated with it, either as main genre or subgenre. Endpoints allow listing all genres, fetching details for a single genre, and browsing books by genre.

| Method | Description | Endpoint | Role |
|---|---|---|---|
| <img src="https://img.shields.io/badge/GET-mediumseagreen?style=flat-square&rounded=true" alt="GET" style="height:18px; vertical-align:middle; margin-right:2px;"> | All Genres - Paginated | `/genres` | <img src="https://img.shields.io/badge/Public-mediumseagreen?style=flat-square&rounded=true" alt="Public" style="height:18px; vertical-align:middle; margin-right:2px;"> |
| <img src="https://img.shields.io/badge/GET-mediumseagreen?style=flat-square&rounded=true" alt="GET" style="height:18px; vertical-align:middle; margin-right:2px;"> | Single Genre | `/genres?id=5` | <img src="https://img.shields.io/badge/Public-mediumseagreen?style=flat-square&rounded=true" alt="Public" style="height:18px; vertical-align:middle; margin-right:2px;"> |
| <img src="https://img.shields.io/badge/OPTIONS-deeppink?style=flat-square&rounded=true" alt="OPTIONS" style="height:18px; vertical-align:middle; margin-right:2px;"> | All Genres | `/genres` | <img src="https://img.shields.io/badge/Public-mediumseagreen?style=flat-square&rounded=true" alt="Public" style="height:18px; vertical-align:middle; margin-right:2px;"> |



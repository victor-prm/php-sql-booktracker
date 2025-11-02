These docs are auto-generated from postman_collection.json. This is a homemade script, as I did not like the other json-to-md libraries I found out there.

# Book Tracker

A RESTful API for managing books, authors, and genres. It allows clients to:

- Retrieve lists of books, authors, and genres with optional pagination.
    
- View detailed information about a single book, author, or genre.
    
- Add or update books and authors (editor/admin only).
    
- Delete books (admin only).
    

All GET requests are publicly accessible. Modifying data is restricted based on user roles: **editor** for creating/updating and **admin** for deletion. Each resource includes hypermedia links for easy navigation between previous and next items.

## 🔐 Base URL and tokens

| Type | Key | Value |
|---|---|---|
| ![VARIABLE](https://img.shields.io/badge/VARIABLE-darkslategrey?style=flat&logoColor=white) | `base_url` | `http://localhost:8888/booktracker` |
| ![HEADER](https://img.shields.io/badge/HEADER-orange?style=flat&logoColor=white) | `X-Authorization` | `Bearer EDITOR_TOKEN` |
| ![HEADER](https://img.shields.io/badge/HEADER-orange?style=flat&logoColor=white) | `X-Authorization` | `Bearer ADMIN_TOKEN` |


## 📁 1. Books endpoint

Manage and retrieve information about books in the API. Each book includes expandable metadata such as title, authors, main genre, subgenres, publication year, page count, reading status, frontpage image, and summary. Endpoints allow listing, fetching single books, and (for authorized users) creating, updating, or deleting books.

**1. All Books - Paginated** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ![Public](https://img.shields.io/badge/Public-green?style=flat&logoColor=white)


↳ ![GET](https://img.shields.io/badge/GET-mediumseagreen?style=flat&logoColor=white) `/books?offset=20&limit=3`


---



**2. All Books - Expanded** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ![Public](https://img.shields.io/badge/Public-green?style=flat&logoColor=white)


↳ ![GET](https://img.shields.io/badge/GET-mediumseagreen?style=flat&logoColor=white) `/books?expand=genres,authors,frontpage_img,year,description`


---



**3. All Books - Filter** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ![Public](https://img.shields.io/badge/Public-green?style=flat&logoColor=white)


↳ ![GET](https://img.shields.io/badge/GET-mediumseagreen?style=flat&logoColor=white) `/books?main_genre_id=11&sub_genre_id=14`


---



**4. All Books - Search** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ![Public](https://img.shields.io/badge/Public-green?style=flat&logoColor=white)


↳ ![GET](https://img.shields.io/badge/GET-mediumseagreen?style=flat&logoColor=white) `/books?q=society`


---



**5. Single Book** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ![Public](https://img.shields.io/badge/Public-green?style=flat&logoColor=white)


↳ ![GET](https://img.shields.io/badge/GET-mediumseagreen?style=flat&logoColor=white) `/books?id=9`


---



**6. New Book** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ![Editor](https://img.shields.io/badge/Editor-yellow?style=flat&logoColor=white) ![Admin](https://img.shields.io/badge/Admin-red?style=flat&logoColor=white)


↳ ![POST](https://img.shields.io/badge/POST-goldenrod?style=flat&logoColor=white) `/books/`


---



**7. Edit Book** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ![Editor](https://img.shields.io/badge/Editor-yellow?style=flat&logoColor=white) ![Admin](https://img.shields.io/badge/Admin-red?style=flat&logoColor=white)


↳ ![PUT](https://img.shields.io/badge/PUT-royalblue?style=flat&logoColor=white) `/books?id=74`


---



**8. Delete Book** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ![Admin](https://img.shields.io/badge/Admin-red?style=flat&logoColor=white)


↳ ![DELETE](https://img.shields.io/badge/DELETE-salmon?style=flat&logoColor=white) `/books?id=74`


---



**9. All Books** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ![Public](https://img.shields.io/badge/Public-green?style=flat&logoColor=white)


↳ ![OPTIONS](https://img.shields.io/badge/OPTIONS-deeppink?style=flat&logoColor=white) `/books`


---



## 📁 2. Authors endpoint

Manage and retrieve author information. Each author entry includes name, biography, birth year, and a list of their associated books. Endpoints allow listing all authors, fetching details for a single author, and (for authorized users) adding or updating author records.

**1. All Authors - Paginated** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ![Public](https://img.shields.io/badge/Public-green?style=flat&logoColor=white)


↳ ![GET](https://img.shields.io/badge/GET-mediumseagreen?style=flat&logoColor=white) `/authors`


---



**2. All Authors - Filter** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ![Public](https://img.shields.io/badge/Public-green?style=flat&logoColor=white)


↳ ![GET](https://img.shields.io/badge/GET-mediumseagreen?style=flat&logoColor=white) `/authors?birth_year=1892`


---



**3. All Authors - Search** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ![Public](https://img.shields.io/badge/Public-green?style=flat&logoColor=white)


↳ ![GET](https://img.shields.io/badge/GET-mediumseagreen?style=flat&logoColor=white) `/authors?q=her`


---



**4. Single Author** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ![Public](https://img.shields.io/badge/Public-green?style=flat&logoColor=white)


↳ ![GET](https://img.shields.io/badge/GET-mediumseagreen?style=flat&logoColor=white) `/authors?id=4`


---



**5. New Author** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ![Editor](https://img.shields.io/badge/Editor-yellow?style=flat&logoColor=white) ![Admin](https://img.shields.io/badge/Admin-red?style=flat&logoColor=white)


↳ ![POST](https://img.shields.io/badge/POST-goldenrod?style=flat&logoColor=white) `/authors/`


---



**6. Edit Author** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ![Editor](https://img.shields.io/badge/Editor-yellow?style=flat&logoColor=white) ![Admin](https://img.shields.io/badge/Admin-red?style=flat&logoColor=white)


↳ ![PUT](https://img.shields.io/badge/PUT-royalblue?style=flat&logoColor=white) `/authors?id=71`


---



**7. Delete Author** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ![Admin](https://img.shields.io/badge/Admin-red?style=flat&logoColor=white)


↳ ![DELETE](https://img.shields.io/badge/DELETE-salmon?style=flat&logoColor=white) `/authors?id=71`


---



**8. All Authors** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ![Public](https://img.shields.io/badge/Public-green?style=flat&logoColor=white)


↳ ![OPTIONS](https://img.shields.io/badge/OPTIONS-deeppink?style=flat&logoColor=white) `/authors`


---



## 📁 3. Genres endpoint

Manage and retrieve genre information for books. Each genre includes its name and a list of books associated with it, either as main genre or subgenre. Endpoints allow listing all genres, fetching details for a single genre, and browsing books by genre.

**1. All Genres - Paginated** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ![Public](https://img.shields.io/badge/Public-green?style=flat&logoColor=white)


↳ ![GET](https://img.shields.io/badge/GET-mediumseagreen?style=flat&logoColor=white) `/genres`


---



**2. Single Genre** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ![Public](https://img.shields.io/badge/Public-green?style=flat&logoColor=white)


↳ ![GET](https://img.shields.io/badge/GET-mediumseagreen?style=flat&logoColor=white) `/genres?id=5`


---



**3. All Genres** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ![Public](https://img.shields.io/badge/Public-green?style=flat&logoColor=white)


↳ ![OPTIONS](https://img.shields.io/badge/OPTIONS-deeppink?style=flat&logoColor=white) `/genres`


---




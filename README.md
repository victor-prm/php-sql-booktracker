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
| <span style=" display:inline-block; background:darkslategrey; color:white; border-radius:6px; padding:2px 6px; font-size:12px; line-height:18px; font-family:monospace; vertical-align:middle; white-space:nowrap; ">VARIABLE</span> | `base_url` | `http://localhost:8888/booktracker` |
| <span style=" display:inline-block; background:orange; color:white; border-radius:6px; padding:2px 6px; font-size:12px; line-height:18px; font-family:monospace; vertical-align:middle; white-space:nowrap; ">HEADER</span> | `X-Authorization` | `Bearer EDITOR_TOKEN` |
| <span style=" display:inline-block; background:orange; color:white; border-radius:6px; padding:2px 6px; font-size:12px; line-height:18px; font-family:monospace; vertical-align:middle; white-space:nowrap; ">HEADER</span> | `X-Authorization` | `Bearer ADMIN_TOKEN` |


## 📁 1. Books endpoint

Manage and retrieve information about books in the API. Each book includes expandable metadata such as title, authors, main genre, subgenres, publication year, page count, reading status, frontpage image, and summary. Endpoints allow listing, fetching single books, and (for authorized users) creating, updating, or deleting books.

**1. All Books - Paginated** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="display:inline-flex; align-items:center;"><span style="
            display:inline-block;
            background:transparent;
            color:DarkSeaGreen;
            border:1px solid DarkSeaGreen;
            border-radius:6px;
            padding:2px 6px;
            font-size:12px;
            line-height:18px;
            font-family:monospace;
            vertical-align:middle;
            white-space:nowrap;
            margin-right:4px;
        ">Public</span></span>


↳ <span style=" display:inline-block; background:mediumseagreen; color:white; border-radius:6px; padding:2px 6px; font-size:12px; line-height:18px; font-family:monospace; vertical-align:middle; white-space:nowrap; ">GET</span> `/books?offset=20&limit=3`


---



**2. All Books - Expanded** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="display:inline-flex; align-items:center;"><span style="
            display:inline-block;
            background:transparent;
            color:DarkSeaGreen;
            border:1px solid DarkSeaGreen;
            border-radius:6px;
            padding:2px 6px;
            font-size:12px;
            line-height:18px;
            font-family:monospace;
            vertical-align:middle;
            white-space:nowrap;
            margin-right:4px;
        ">Public</span></span>


↳ <span style=" display:inline-block; background:mediumseagreen; color:white; border-radius:6px; padding:2px 6px; font-size:12px; line-height:18px; font-family:monospace; vertical-align:middle; white-space:nowrap; ">GET</span> `/books?expand=genres,authors,frontpage_img,year,description`


---



**3. All Books - Filter** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="display:inline-flex; align-items:center;"><span style="
            display:inline-block;
            background:transparent;
            color:DarkSeaGreen;
            border:1px solid DarkSeaGreen;
            border-radius:6px;
            padding:2px 6px;
            font-size:12px;
            line-height:18px;
            font-family:monospace;
            vertical-align:middle;
            white-space:nowrap;
            margin-right:4px;
        ">Public</span></span>


↳ <span style=" display:inline-block; background:mediumseagreen; color:white; border-radius:6px; padding:2px 6px; font-size:12px; line-height:18px; font-family:monospace; vertical-align:middle; white-space:nowrap; ">GET</span> `/books?main_genre_id=11&sub_genre_id=14`


---



**4. All Books - Search** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="display:inline-flex; align-items:center;"><span style="
            display:inline-block;
            background:transparent;
            color:DarkSeaGreen;
            border:1px solid DarkSeaGreen;
            border-radius:6px;
            padding:2px 6px;
            font-size:12px;
            line-height:18px;
            font-family:monospace;
            vertical-align:middle;
            white-space:nowrap;
            margin-right:4px;
        ">Public</span></span>


↳ <span style=" display:inline-block; background:mediumseagreen; color:white; border-radius:6px; padding:2px 6px; font-size:12px; line-height:18px; font-family:monospace; vertical-align:middle; white-space:nowrap; ">GET</span> `/books?q=society`


---



**5. Single Book** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="display:inline-flex; align-items:center;"><span style="
            display:inline-block;
            background:transparent;
            color:DarkSeaGreen;
            border:1px solid DarkSeaGreen;
            border-radius:6px;
            padding:2px 6px;
            font-size:12px;
            line-height:18px;
            font-family:monospace;
            vertical-align:middle;
            white-space:nowrap;
            margin-right:4px;
        ">Public</span></span>


↳ <span style=" display:inline-block; background:mediumseagreen; color:white; border-radius:6px; padding:2px 6px; font-size:12px; line-height:18px; font-family:monospace; vertical-align:middle; white-space:nowrap; ">GET</span> `/books?id=9`


---



**6. New Book** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="display:inline-flex; align-items:center;"><span style="
            display:inline-block;
            background:transparent;
            color:DarkKhaki;
            border:1px solid DarkKhaki;
            border-radius:6px;
            padding:2px 6px;
            font-size:12px;
            line-height:18px;
            font-family:monospace;
            vertical-align:middle;
            white-space:nowrap;
            margin-right:4px;
        ">Editor</span><span style="
            display:inline-block;
            background:transparent;
            color:Peru;
            border:1px solid Peru;
            border-radius:6px;
            padding:2px 6px;
            font-size:12px;
            line-height:18px;
            font-family:monospace;
            vertical-align:middle;
            white-space:nowrap;
            margin-right:4px;
        ">Admin</span></span>


↳ <span style=" display:inline-block; background:goldenrod; color:white; border-radius:6px; padding:2px 6px; font-size:12px; line-height:18px; font-family:monospace; vertical-align:middle; white-space:nowrap; ">POST</span> `/books/`


---



**7. Edit Book** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="display:inline-flex; align-items:center;"><span style="
            display:inline-block;
            background:transparent;
            color:DarkKhaki;
            border:1px solid DarkKhaki;
            border-radius:6px;
            padding:2px 6px;
            font-size:12px;
            line-height:18px;
            font-family:monospace;
            vertical-align:middle;
            white-space:nowrap;
            margin-right:4px;
        ">Editor</span><span style="
            display:inline-block;
            background:transparent;
            color:Peru;
            border:1px solid Peru;
            border-radius:6px;
            padding:2px 6px;
            font-size:12px;
            line-height:18px;
            font-family:monospace;
            vertical-align:middle;
            white-space:nowrap;
            margin-right:4px;
        ">Admin</span></span>


↳ <span style=" display:inline-block; background:royalblue; color:white; border-radius:6px; padding:2px 6px; font-size:12px; line-height:18px; font-family:monospace; vertical-align:middle; white-space:nowrap; ">PUT</span> `/books?id=74`


---



**8. Delete Book** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="display:inline-flex; align-items:center;"><span style="
            display:inline-block;
            background:transparent;
            color:Peru;
            border:1px solid Peru;
            border-radius:6px;
            padding:2px 6px;
            font-size:12px;
            line-height:18px;
            font-family:monospace;
            vertical-align:middle;
            white-space:nowrap;
            margin-right:4px;
        ">Admin</span></span>


↳ <span style=" display:inline-block; background:salmon; color:white; border-radius:6px; padding:2px 6px; font-size:12px; line-height:18px; font-family:monospace; vertical-align:middle; white-space:nowrap; ">DELETE</span> `/books?id=74`


---



**9. All Books** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="display:inline-flex; align-items:center;"><span style="
            display:inline-block;
            background:transparent;
            color:DarkSeaGreen;
            border:1px solid DarkSeaGreen;
            border-radius:6px;
            padding:2px 6px;
            font-size:12px;
            line-height:18px;
            font-family:monospace;
            vertical-align:middle;
            white-space:nowrap;
            margin-right:4px;
        ">Public</span></span>


↳ <span style=" display:inline-block; background:deeppink; color:white; border-radius:6px; padding:2px 6px; font-size:12px; line-height:18px; font-family:monospace; vertical-align:middle; white-space:nowrap; ">OPTIONS</span> `/books`


---



## 📁 2. Authors endpoint

Manage and retrieve author information. Each author entry includes name, biography, birth year, and a list of their associated books. Endpoints allow listing all authors, fetching details for a single author, and (for authorized users) adding or updating author records.

**1. All Authors - Paginated** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="display:inline-flex; align-items:center;"><span style="
            display:inline-block;
            background:transparent;
            color:DarkSeaGreen;
            border:1px solid DarkSeaGreen;
            border-radius:6px;
            padding:2px 6px;
            font-size:12px;
            line-height:18px;
            font-family:monospace;
            vertical-align:middle;
            white-space:nowrap;
            margin-right:4px;
        ">Public</span></span>


↳ <span style=" display:inline-block; background:mediumseagreen; color:white; border-radius:6px; padding:2px 6px; font-size:12px; line-height:18px; font-family:monospace; vertical-align:middle; white-space:nowrap; ">GET</span> `/authors`


---



**2. All Authors - Filter** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="display:inline-flex; align-items:center;"><span style="
            display:inline-block;
            background:transparent;
            color:DarkSeaGreen;
            border:1px solid DarkSeaGreen;
            border-radius:6px;
            padding:2px 6px;
            font-size:12px;
            line-height:18px;
            font-family:monospace;
            vertical-align:middle;
            white-space:nowrap;
            margin-right:4px;
        ">Public</span></span>


↳ <span style=" display:inline-block; background:mediumseagreen; color:white; border-radius:6px; padding:2px 6px; font-size:12px; line-height:18px; font-family:monospace; vertical-align:middle; white-space:nowrap; ">GET</span> `/authors?birth_year=1892`


---



**3. All Authors - Search** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="display:inline-flex; align-items:center;"><span style="
            display:inline-block;
            background:transparent;
            color:DarkSeaGreen;
            border:1px solid DarkSeaGreen;
            border-radius:6px;
            padding:2px 6px;
            font-size:12px;
            line-height:18px;
            font-family:monospace;
            vertical-align:middle;
            white-space:nowrap;
            margin-right:4px;
        ">Public</span></span>


↳ <span style=" display:inline-block; background:mediumseagreen; color:white; border-radius:6px; padding:2px 6px; font-size:12px; line-height:18px; font-family:monospace; vertical-align:middle; white-space:nowrap; ">GET</span> `/authors?q=her`


---



**4. Single Author** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="display:inline-flex; align-items:center;"><span style="
            display:inline-block;
            background:transparent;
            color:DarkSeaGreen;
            border:1px solid DarkSeaGreen;
            border-radius:6px;
            padding:2px 6px;
            font-size:12px;
            line-height:18px;
            font-family:monospace;
            vertical-align:middle;
            white-space:nowrap;
            margin-right:4px;
        ">Public</span></span>


↳ <span style=" display:inline-block; background:mediumseagreen; color:white; border-radius:6px; padding:2px 6px; font-size:12px; line-height:18px; font-family:monospace; vertical-align:middle; white-space:nowrap; ">GET</span> `/authors?id=4`


---



**5. New Author** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="display:inline-flex; align-items:center;"><span style="
            display:inline-block;
            background:transparent;
            color:DarkKhaki;
            border:1px solid DarkKhaki;
            border-radius:6px;
            padding:2px 6px;
            font-size:12px;
            line-height:18px;
            font-family:monospace;
            vertical-align:middle;
            white-space:nowrap;
            margin-right:4px;
        ">Editor</span><span style="
            display:inline-block;
            background:transparent;
            color:Peru;
            border:1px solid Peru;
            border-radius:6px;
            padding:2px 6px;
            font-size:12px;
            line-height:18px;
            font-family:monospace;
            vertical-align:middle;
            white-space:nowrap;
            margin-right:4px;
        ">Admin</span></span>


↳ <span style=" display:inline-block; background:goldenrod; color:white; border-radius:6px; padding:2px 6px; font-size:12px; line-height:18px; font-family:monospace; vertical-align:middle; white-space:nowrap; ">POST</span> `/authors/`


---



**6. Edit Author** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="display:inline-flex; align-items:center;"><span style="
            display:inline-block;
            background:transparent;
            color:DarkKhaki;
            border:1px solid DarkKhaki;
            border-radius:6px;
            padding:2px 6px;
            font-size:12px;
            line-height:18px;
            font-family:monospace;
            vertical-align:middle;
            white-space:nowrap;
            margin-right:4px;
        ">Editor</span><span style="
            display:inline-block;
            background:transparent;
            color:Peru;
            border:1px solid Peru;
            border-radius:6px;
            padding:2px 6px;
            font-size:12px;
            line-height:18px;
            font-family:monospace;
            vertical-align:middle;
            white-space:nowrap;
            margin-right:4px;
        ">Admin</span></span>


↳ <span style=" display:inline-block; background:royalblue; color:white; border-radius:6px; padding:2px 6px; font-size:12px; line-height:18px; font-family:monospace; vertical-align:middle; white-space:nowrap; ">PUT</span> `/authors?id=71`


---



**7. Delete Author** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="display:inline-flex; align-items:center;"><span style="
            display:inline-block;
            background:transparent;
            color:Peru;
            border:1px solid Peru;
            border-radius:6px;
            padding:2px 6px;
            font-size:12px;
            line-height:18px;
            font-family:monospace;
            vertical-align:middle;
            white-space:nowrap;
            margin-right:4px;
        ">Admin</span></span>


↳ <span style=" display:inline-block; background:salmon; color:white; border-radius:6px; padding:2px 6px; font-size:12px; line-height:18px; font-family:monospace; vertical-align:middle; white-space:nowrap; ">DELETE</span> `/authors?id=71`


---



**8. All Authors** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="display:inline-flex; align-items:center;"><span style="
            display:inline-block;
            background:transparent;
            color:DarkSeaGreen;
            border:1px solid DarkSeaGreen;
            border-radius:6px;
            padding:2px 6px;
            font-size:12px;
            line-height:18px;
            font-family:monospace;
            vertical-align:middle;
            white-space:nowrap;
            margin-right:4px;
        ">Public</span></span>


↳ <span style=" display:inline-block; background:deeppink; color:white; border-radius:6px; padding:2px 6px; font-size:12px; line-height:18px; font-family:monospace; vertical-align:middle; white-space:nowrap; ">OPTIONS</span> `/authors`


---



## 📁 3. Genres endpoint

Manage and retrieve genre information for books. Each genre includes its name and a list of books associated with it, either as main genre or subgenre. Endpoints allow listing all genres, fetching details for a single genre, and browsing books by genre.

**1. All Genres - Paginated** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="display:inline-flex; align-items:center;"><span style="
            display:inline-block;
            background:transparent;
            color:DarkSeaGreen;
            border:1px solid DarkSeaGreen;
            border-radius:6px;
            padding:2px 6px;
            font-size:12px;
            line-height:18px;
            font-family:monospace;
            vertical-align:middle;
            white-space:nowrap;
            margin-right:4px;
        ">Public</span></span>


↳ <span style=" display:inline-block; background:mediumseagreen; color:white; border-radius:6px; padding:2px 6px; font-size:12px; line-height:18px; font-family:monospace; vertical-align:middle; white-space:nowrap; ">GET</span> `/genres`


---



**2. Single Genre** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="display:inline-flex; align-items:center;"><span style="
            display:inline-block;
            background:transparent;
            color:DarkSeaGreen;
            border:1px solid DarkSeaGreen;
            border-radius:6px;
            padding:2px 6px;
            font-size:12px;
            line-height:18px;
            font-family:monospace;
            vertical-align:middle;
            white-space:nowrap;
            margin-right:4px;
        ">Public</span></span>


↳ <span style=" display:inline-block; background:mediumseagreen; color:white; border-radius:6px; padding:2px 6px; font-size:12px; line-height:18px; font-family:monospace; vertical-align:middle; white-space:nowrap; ">GET</span> `/genres?id=5`


---



**3. All Genres** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="display:inline-flex; align-items:center;"><span style="
            display:inline-block;
            background:transparent;
            color:DarkSeaGreen;
            border:1px solid DarkSeaGreen;
            border-radius:6px;
            padding:2px 6px;
            font-size:12px;
            line-height:18px;
            font-family:monospace;
            vertical-align:middle;
            white-space:nowrap;
            margin-right:4px;
        ">Public</span></span>


↳ <span style=" display:inline-block; background:deeppink; color:white; border-radius:6px; padding:2px 6px; font-size:12px; line-height:18px; font-family:monospace; vertical-align:middle; white-space:nowrap; ">OPTIONS</span> `/genres`


---




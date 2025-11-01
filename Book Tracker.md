# Project: Book Tracker
# 📁 Collection: Books 
Manage and retrieve information about books in the API. Each book includes metadata such as title, authors, main genre, subgenres, publication year, page count, reading status, frontpage image, and summary. Endpoints allow listing, fetching single books, and (for authorized users) creating, updating, or deleting books. 


## End-point: All Books - Paginated
### Method: GET
>```
>{{base_url}}/books?offset=20&limit=3
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer EDITOR_TOKEN_123|


### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer ADMIN_TOKEN_456|


### Query Params

|Param|value|
|---|---|
|offset|20|
|limit|3|



⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: All Books - Expanded
### Method: GET
>```
>{{base_url}}/books?expand=genres,authors,frontpage_img,year,description
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer EDITOR_TOKEN_123|


### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer ADMIN_TOKEN_456|


### Query Params

|Param|value|
|---|---|
|expand|genres,authors,frontpage_img,year,description|



⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: All Books - Filter
### Method: GET
>```
>{{base_url}}/books?main_genre_id=11&sub_genre_id=14
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer EDITOR_TOKEN_123|


### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer ADMIN_TOKEN_456|


### Query Params

|Param|value|
|---|---|
|main_genre_id|11|
|sub_genre_id|14|



⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: All Books - Search
### Method: GET
>```
>{{base_url}}/books?q=society
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer EDITOR_TOKEN_123|


### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer ADMIN_TOKEN_456|


### Query Params

|Param|value|
|---|---|
|q|society|



⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: Single Book
### Method: GET
>```
>{{base_url}}/books?id=9
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer EDITOR_TOKEN_123|


### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer ADMIN_TOKEN_456|


### Query Params

|Param|value|
|---|---|
|id|9|



⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: New Book
### Method: POST
>```
>{{base_url}}/books/
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer EDITOR_TOKEN_123|


### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer ADMIN_TOKEN_456|



⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: Edit Book
### Method: PUT
>```
>{{base_url}}/books?id=74
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer EDITOR_TOKEN_123|


### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer ADMIN_TOKEN_456|


### Query Params

|Param|value|
|---|---|
|id|74|



⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: Delete Book
### Method: DELETE
>```
>{{base_url}}/books?id=74
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer EDITOR_TOKEN_123|


### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer ADMIN_TOKEN_456|


### Query Params

|Param|value|
|---|---|
|id|74|



⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: All Books
### Method: OPTIONS
>```
>{{base_url}}/books
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer EDITOR_TOKEN_123|


### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer ADMIN_TOKEN_456|



⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃
# 📁 Collection: Authors 
Manage and retrieve author information. Each author entry includes name, biography, birth year, and a list of their associated books. Endpoints allow listing all authors, fetching details for a single author, and (for authorized users) adding or updating author records. 


## End-point: All Authors - Paginated
### Method: GET
>```
>{{base_url}}/authors
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer EDITOR_TOKEN_123|


### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer ADMIN_TOKEN_456|



⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: All Authors - Filter
### Method: GET
>```
>{{base_url}}/authors?birth_year=1892
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer EDITOR_TOKEN_123|


### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer ADMIN_TOKEN_456|


### Query Params

|Param|value|
|---|---|
|birth_year|1892|



⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: All Authors - Search
### Method: GET
>```
>{{base_url}}/authors?q=her
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer EDITOR_TOKEN_123|


### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer ADMIN_TOKEN_456|


### Query Params

|Param|value|
|---|---|
|q|her|



⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: Single Author
### Method: GET
>```
>{{base_url}}/authors?id=4
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer EDITOR_TOKEN_123|


### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer ADMIN_TOKEN_456|


### Query Params

|Param|value|
|---|---|
|id|4|



⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: New Author
### Method: POST
>```
>{{base_url}}/authors/
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer EDITOR_TOKEN_123|


### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer ADMIN_TOKEN_456|



⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: Edit Author
### Method: PUT
>```
>{{base_url}}/authors?id=71
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer EDITOR_TOKEN_123|


### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer ADMIN_TOKEN_456|


### Query Params

|Param|value|
|---|---|
|id|71|



⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: Delete Author
### Method: DELETE
>```
>{{base_url}}/authors?id=71
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer EDITOR_TOKEN_123|


### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer ADMIN_TOKEN_456|


### Query Params

|Param|value|
|---|---|
|id|71|



⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: All Authors
### Method: OPTIONS
>```
>{{base_url}}/authors
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer EDITOR_TOKEN_123|


### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer ADMIN_TOKEN_456|



⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃
# 📁 Collection: Genres 
Manage and retrieve genre information for books. Each genre includes its name and a list of books associated with it, either as main genre or subgenre. Endpoints allow listing all genres, fetching details for a single genre, and browsing books by genre. 


## End-point: All Genres - Paginated
### Method: GET
>```
>{{base_url}}/genres
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer EDITOR_TOKEN_123|


### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer ADMIN_TOKEN_456|



⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: Single Genre
### Method: GET
>```
>{{base_url}}/genres?id=5
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer EDITOR_TOKEN_123|


### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer ADMIN_TOKEN_456|


### Query Params

|Param|value|
|---|---|
|id|5|



⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃

## End-point: All Genres
### Method: OPTIONS
>```
>{{base_url}}/genres
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer EDITOR_TOKEN_123|


### Headers

|Content-Type|Value|
|---|---|
|X-Authorization|Bearer ADMIN_TOKEN_456|



⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃ ⁃
_________________________________________________
Powered By: [postman-to-markdown](https://github.com/bautistaj/postman-to-markdown/)

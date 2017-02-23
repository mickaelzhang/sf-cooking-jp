# Comment endpoint

Add a recipe to a user's favorite.

PATH: `POST - /comment`

### Parameters
___
|     PARAM     |    REQUIRED     |   TYPE   | DESCRIPTION                              |
| --------------| --------------- | -------- | ---------------------------------------- |
| follower      |      true       | int      | Follower user id                         |
| followed      |      true       | int      | Followed user id                         |
| token         |      true       | string   | Token generated in the page's controller |

### Response format
On success, the HTTP status code in the response header is `201`.
#### Exemple
For this API call:
```
POST - /favorite
PARAM:
{
	"user": 1,
	"recipe": 3,
	"message": "Très bonne recette !",
	"token": "slyPO2hksbSuj4I9kEWYfFEk22hM82quzgWgk3JIYNw"
}
```

The response will be:

```JSON
{
  "status": "Created",
  "status_code": 201,
  "message": "Comment successfully posted."
}
```

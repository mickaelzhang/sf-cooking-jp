# Favorite endpoint

Add a recipe to a user's favorite.

PATH: `POST - /favorite`

### Parameters
___
|     PARAM     |    REQUIRED     |   TYPE   | DESCRIPTION                              |
| --------------| --------------- | -------- | ---------------------------------------- |
| u             |      true       | int      | User id                                  |
| r             |      true       | int      | Recipe id                                |
| token         |      true       | string   | Token generated in the page's controller |

### Response format
On success, if the user put a recipe into his favorite, the HTTP status code in the response header is `201`. Else, if the user remove a recipe from his favorite, the status code is `200`.

#### Exemple
For this API call:
```
POST - /favorite
PARAM:
{
	"u": 1,
	"r": 3,
	"token": "slyPO2hksbSuj4I9kEWYfFEk22hM82quzgWgk3JIYNw"
}


```

The response will be:

```JSON
{
  "status": "Created",
  "status_code": 201,
  "message": "The user now has this recipe in his favorite."
}
```

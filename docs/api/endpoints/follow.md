# Favorite endpoint

Add a recipe to a user's favorite.

PATH: `POST - /favorite`

### Parameters
___
|     PARAM     |    REQUIRED     |   TYPE   | DESCRIPTION                              |
| --------------| --------------- | -------- | ---------------------------------------- |
| follower      |      true       | int      | Follower user id                         |
| followed      |      true       | int      | Followed user id                         |
| token         |      true       | string   | Token generated in the page's controller |

### Response format
On success, if the user follow someone, the HTTP status code in the response header is `201`. Else, if the user cancel his follow, the status code is `200`.

#### Exemple
For this API call:
```
POST - /favorite
PARAM:
{
	"follower": 1,
	"followed": 3,
	"token": "slyPO2hksbSuj4I9kEWYfFEk22hM82quzgWgk3JIYNw"
}


```

The response will be:

```JSON
{
  "status": "Created",
  "status_code": 201,
  "message": "Mickael Zhang follow Clément Vion"
}
```

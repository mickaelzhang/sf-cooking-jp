# API documentation
Documentation for the website internal API. Enjoy.

You can access it with this url: `http://{domain_name}/api/`

## API Endpoint
* [Favorite](endpoints/favorite.md)
* [Follow](endpoints/follow.md)
* [Rating](endpoints/rating.md)

## API Response
All data is received in JSON. It follow the following structure :
- **If the response have data:**

```
{
  "status": "Created",
  "status_code": 201,
  "message": "This is an informative message",
  "data": { ... }
}
```

- **If the response don't have data:**

```
{
  "status": "Found",
  "status_code": 200,
  "message": "Result found"
}
```

For more information, check the different endpoint.

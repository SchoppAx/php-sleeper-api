# Users

There are two ways to get user information from sleeper. You can use the *username* or *user_id* of the user.
Both can be triggerd with the `find`-Method of the `users` class.

You will get a Array response that looks something like this:
```
[
  "username": "sleeperuser",
  "user_id": "12345678",
  "display_name": "SleeperUser",
  "avatar": "cc12ec49965eb7856f84d71cf85306af"
]
```

## Full Example

```php
$client = new SleeperClient();

$user = $client->users()->find("sleeperuser");

echo $user->["username"];
echo $user->["user_id"];
echo $user->["display_name"];
echo $user->["avatar"];
```

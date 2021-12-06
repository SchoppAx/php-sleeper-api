# Avatars

Users and leagues have avatar images. There are thumbnail and full-size images for each avatar.

## find

- Param: `avatarId`
- Type: `String`

- Param: `thumbnail`
- Type: `Boolean`
- Default: `false`

To get them just call the `find`-Method of the `avatars` class.

?> You can find the *avatar_id* inside the `Users` or `Leagues` response.

You will receive a simple url like:
```
https://sleepercdn.com/avatars/thumbs/<avatar_id>
```

### Example

```php
$client = new SleeperClient();

$imgUrl = $client->avatars()->find("cc12ec49965eb7856f84d71cf85306af", true);

echo "<img src='$imgUrl' />";
```

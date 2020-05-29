---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.

<!-- END_INFO -->

#Authentication


endpoints for everything related to authentication
<!-- START_ba35aa39474cb98cfb31829e70eb8b74 -->
## Login

> Example request:

```bash
curl -X POST \
    "http://localhost:8000/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"nesciunt","password":"maiores"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "nesciunt",
    "password": "maiores"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST login`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  required  | 
        `password` | string |  required  | 
    
<!-- END_ba35aa39474cb98cfb31829e70eb8b74 -->

<!-- START_66e08d3cc8222573018fed49e121e96d -->
## Authentication Middleware
Route that gets called if authentication failed

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET login`


<!-- END_66e08d3cc8222573018fed49e121e96d -->

<!-- START_d7aad7b5ac127700500280d511a3db01 -->
## Register

> Example request:

```bash
curl -X POST \
    "http://localhost:8000/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"nesciunt","email":"aliquid","password":"perferendis"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "nesciunt",
    "email": "aliquid",
    "password": "perferendis"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST register`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | 
        `email` | string |  required  | 
        `password` | string |  required  | 
    
<!-- END_d7aad7b5ac127700500280d511a3db01 -->

<!-- START_d07533fb356c1cce453f36f78e88d563 -->
## Token Refresh
Refresh JWT Token before it expires

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/refresh" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/refresh"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET refresh`


<!-- END_d07533fb356c1cce453f36f78e88d563 -->

#Comments


APIs for managing comments
<!-- START_d728f2176d9cdd509e70b4addfa59568 -->
## My Comments
returns comments of authenticated user

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/comments" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/comments"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET comments`


<!-- END_d728f2176d9cdd509e70b4addfa59568 -->

<!-- START_56e2420b314458eadaf3096d82dbb1b2 -->
## Comments of Post
edit existing comment

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/comments/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"text":"neque"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/comments/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "text": "neque"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET comments/{post}`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `text` | string |  required  | The content of the comment
    
<!-- END_56e2420b314458eadaf3096d82dbb1b2 -->

<!-- START_06387704dc60a91d3f9a316443d3e4ff -->
## Store a new Comment

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://localhost:8000/comment/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"text":"voluptas"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/comment/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "text": "voluptas"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST comment/{post}`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `text` | string |  required  | The content of the comment
    
<!-- END_06387704dc60a91d3f9a316443d3e4ff -->

<!-- START_3b99fcc718600046560c8d70d914ca0e -->
## Store a new nested Comment

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
used to store a response to another comment

> Example request:

```bash
curl -X POST \
    "http://localhost:8000/comment/1/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"text":"rem"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/comment/1/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "text": "rem"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST comment/{post}/{comment}`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `text` | string |  required  | The content of the comment
    
<!-- END_3b99fcc718600046560c8d70d914ca0e -->

<!-- START_0fb0e30f655ed96f32085e6a533fcf07 -->
## update a Comment

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X PUT \
    "http://localhost:8000/comment/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"text":"minus"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/comment/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "text": "minus"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT comment/{comment}`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `text` | string |  required  | The NEW content of the comment
    
<!-- END_0fb0e30f655ed96f32085e6a533fcf07 -->

<!-- START_96f948918a2fdce8e599741680346e3d -->
## Deletion
deletes a Comment by id

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE \
    "http://localhost:8000/comment/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/comment/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE comment/{comment}`


<!-- END_96f948918a2fdce8e599741680346e3d -->

#Friendships


APIs for managing friendships
<!-- START_9e60c29c63c63da995606e142bb6e576 -->
## Remove a Friend

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE \
    "http://localhost:8000/friends/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/friends/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE friends/{friend}`


<!-- END_9e60c29c63c63da995606e142bb6e576 -->

<!-- START_0cad3e9017c1172d259bc85def25267e -->
## List of Friends

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/friends" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/friends"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET friends`


<!-- END_0cad3e9017c1172d259bc85def25267e -->

<!-- START_2728d2987f81a20325803f1bc7c07d40 -->
## Location of Friends

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/friends/location" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/friends/location"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET friends/location`


<!-- END_2728d2987f81a20325803f1bc7c07d40 -->

<!-- START_b761fa3e16f3346e4df9591d923f4bd9 -->
## Send a Friend Request

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://localhost:8000/requestFriend/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/requestFriend/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST requestFriend/{friend}`


<!-- END_b761fa3e16f3346e4df9591d923f4bd9 -->

<!-- START_e195324d4c269da3ba01eb2565f59f36 -->
## Unaccepted Friend Requests
Friend Requests by other user towards me

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/friendrequests" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/friendrequests"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET friendrequests`


<!-- END_e195324d4c269da3ba01eb2565f59f36 -->

<!-- START_4f11189a6ea5d3efc8e1e449b0256d92 -->
## Pending Friend Requests
Friend Requests issued by the authenticated user

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/pendingfriendrequests" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/pendingfriendrequests"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET pendingfriendrequests`


<!-- END_4f11189a6ea5d3efc8e1e449b0256d92 -->

<!-- START_d90a73fd4894e0a9fe3c486268594f8a -->
## Accept a FriendRequest

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://localhost:8000/acceptFriend/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/acceptFriend/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST acceptFriend/{friend}`


<!-- END_d90a73fd4894e0a9fe3c486268594f8a -->

#Likes


APIs for managing likes
<!-- START_b12eb4d8d22965195bd411a99d3b5352 -->
## Like Post
likes a post by id

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://localhost:8000/likePost/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/likePost/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST likePost/{post}`


<!-- END_b12eb4d8d22965195bd411a99d3b5352 -->

<!-- START_efefbbee464a758d2f8fc581da574d47 -->
## Like Comment
likes a comment by id

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://localhost:8000/likeComment/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/likeComment/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST likeComment/{comment}`


<!-- END_efefbbee464a758d2f8fc581da574d47 -->

<!-- START_be19b855c59a3739698526e1d395ce28 -->
## Dislike Post
dislikes a post by id

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://localhost:8000/dislikePost/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/dislikePost/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST dislikePost/{post}`


<!-- END_be19b855c59a3739698526e1d395ce28 -->

<!-- START_c6f68092a046cc8102f07163256ac7da -->
## Dislike Comment
dislikes a comment by id

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://localhost:8000/dislikeComment/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/dislikeComment/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST dislikeComment/{comment}`


<!-- END_c6f68092a046cc8102f07163256ac7da -->

#Posts


APIs for managing posts
<!-- START_b50fbd1dc666341a0aba5436344a60d9 -->
## My Posts
returns a list of all posts of the user

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/posts" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/posts"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET posts`


<!-- END_b50fbd1dc666341a0aba5436344a60d9 -->

<!-- START_6bb34778bbf4ff8243bcb491022de63a -->
## Store a new post

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://localhost:8000/post" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"text":"qui","media":"exercitationem"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/post"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "text": "qui",
    "media": "exercitationem"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST post`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `text` | string |  required  | The content of the post
        `media` | file |  optional  | The media-file of the post
    
<!-- END_6bb34778bbf4ff8243bcb491022de63a -->

<!-- START_c3dbf7298ec1d346dbd413512ecf72a8 -->
## Posts of Friends

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the posts of friends

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/postfeed" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/postfeed"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET postfeed`


<!-- END_c3dbf7298ec1d346dbd413512ecf72a8 -->

<!-- START_33345ce527d368828335eb98787f5643 -->
## Get Posts Of User
gets posts of user labled as public

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/posts/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/posts/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET posts/{user}`


<!-- END_33345ce527d368828335eb98787f5643 -->

<!-- START_28879fe61d51a12419cf43f57cefa40c -->
## Deletion
deletes a post by id

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE \
    "http://localhost:8000/post/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/post/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE post/{post}`


<!-- END_28879fe61d51a12419cf43f57cefa40c -->

<!-- START_377e2fce65bf74705cfad3cc0c4ce6b4 -->
## Update a post

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X PUT \
    "http://localhost:8000/post/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"text":"repellendus","media_uuid":"vel","media":"deleniti","post_visibility":10}'

```

```javascript
const url = new URL(
    "http://localhost:8000/post/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "text": "repellendus",
    "media_uuid": "vel",
    "media": "deleniti",
    "post_visibility": 10
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT post/{post}`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `text` | string |  required  | The NEW content of the post
        `media_uuid` | string |  optional  | the uuid if the user wants to keep the image. leave it out if the image has to be deleted
        `media` | file |  optional  | The media-file of the post, if the image has to be changed
        `post_visibility` | integer |  optional  | 0->private  1 -> friends(default)  2->all (Not implemented jet)
    
<!-- END_377e2fce65bf74705cfad3cc0c4ce6b4 -->

#User


APIs for managing user
<!-- START_3bcedda78ae45ef5c0f4c97a4963b7a1 -->
## Show all user with posts
ADMIN ONLY

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/user" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/user"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET user`


<!-- END_3bcedda78ae45ef5c0f4c97a4963b7a1 -->

<!-- START_8de0eef03624ee766aa467538721f96b -->
## Update Geo Position

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://localhost:8000/updateGeo" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"lat":"non","lng":"iste"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/updateGeo"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "lat": "non",
    "lng": "iste"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST updateGeo`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `lat` | string |  required  | the Latitude
        `lng` | string |  required  | the Longitude
    
<!-- END_8de0eef03624ee766aa467538721f96b -->

<!-- START_7918d9f1ab4b0bdb25a75473dca51c27 -->
## Get user Info
returns the specified user

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/user/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/user/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET user/{user}`


<!-- END_7918d9f1ab4b0bdb25a75473dca51c27 -->

<!-- START_1cde2a12e7c3177af48fd9c0bfb79684 -->
## Update a User

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X PUT \
    "http://localhost:8000/user/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"sapiente","email":"voluptas","post_visibility":3,"show_location":false,"profile_image":"quis"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/user/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "sapiente",
    "email": "voluptas",
    "post_visibility": 3,
    "show_location": false,
    "profile_image": "quis"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT user/{user}`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | name of the user
        `email` | string |  required  | email of the user
        `post_visibility` | integer |  required  | 0->private  1 -> friends  2->all (Not implemented jet)
        `show_location` | boolean |  required  | show or don't show location on map
        `profile_image` | file |  optional  | the profile picture
    
<!-- END_1cde2a12e7c3177af48fd9c0bfb79684 -->

<!-- START_c3f689a804341d95e136d0131312e64f -->
## Deletion
deletes a user by id

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE \
    "http://localhost:8000/user/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/user/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE user/{user}`


<!-- END_c3f689a804341d95e136d0131312e64f -->

<!-- START_5c5bb7a3528795d09ae9c636f86415fb -->
## Suggestions
user suggestions given a part of the name

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/suggestions" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"quia"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/suggestions"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "quia"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET suggestions`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | the name to search for
    
<!-- END_5c5bb7a3528795d09ae9c636f86415fb -->

#general


<!-- START_5cddd097958a13a153b478c5c73a07a3 -->
## doc
> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/doc" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/doc"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET doc`


<!-- END_5cddd097958a13a153b478c5c73a07a3 -->

<!-- START_b85049f3742ca2add2aa92b16da03cd7 -->
## apidoc.json
> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/apidoc.json" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/apidoc.json"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET apidoc.json`


<!-- END_b85049f3742ca2add2aa92b16da03cd7 -->

#password reset


endpoints for resetting a password
<!-- START_8941301529a1500064a684640e775ed1 -->
## Perform a Password reset

> Example request:

```bash
curl -X POST \
    "http://localhost:8000/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"Token":"aut","password":"deserunt","email":"est"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "Token": "aut",
    "password": "deserunt",
    "email": "est"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST reset`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `Token` | string |  required  | The token that was sent via email
        `password` | string |  required  | The NEW password for the user
        `email` | string |  required  | The email that token was sent to
    
<!-- END_8941301529a1500064a684640e775ed1 -->

<!-- START_ed196951a5070020a6573ab016ae2808 -->
## Issue a reset Request

> Example request:

```bash
curl -X POST \
    "http://localhost:8000/reset/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"adipisci"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/reset/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "adipisci"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST reset/create`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  required  | The email of the user to reset
    
<!-- END_ed196951a5070020a6573ab016ae2808 -->


